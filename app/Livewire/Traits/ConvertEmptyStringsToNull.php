<?php

namespace App\Livewire\Traits;


trait ConvertEmptyStringsToNull
{
    /**
     * Run on every property update (BEFORE validation)
     * Automatically converts empty strings and 'null' strings to null
     */
    public function updated(string $propertyName): void
    {
        $value = data_get($this, $propertyName);

        // Skip if not a string value (handles files, integers, booleans, etc.)
        if (! is_string($value)) {
            return;
        }

        if (! $this->isNullablePropertyPath($propertyName)) {
            return;
        }

        // Convert empty strings and 'null' string to null
        if ($value === '' || $value === 'null') {
            data_set($this, $propertyName, null);
        }
    }

    protected function isNullablePropertyPath(string $propertyName): bool
    {
        $segments = explode('.', $propertyName);

        $target = $this;

        foreach (array_slice($segments, 0, -1) as $segment) {
            $target = data_get($target, $segment);

            if (! is_object($target)) {
                return false;
            }
        }

        $property = end($segments);

        if (! is_string($property) || $property === '' || ! is_object($target) || ! property_exists($target, $property)) {
            return false;
        }

        $reflection = new \ReflectionProperty($target, $property);
        $type = $reflection->getType();

        if ($type === null) {
            return false;
        }

        return $type->allowsNull();
    }

    /**
     * Override validate to convert empty strings and 'null' strings to null
     * This acts as a safety net after validation
     * This prevents storing empty strings in nullable database fields
     */
    public function validate($rules = null, $messages = [], $attributes = []): array
    {
        $data = parent::validate($rules, $messages, $attributes);

        // Convert empty strings and 'null' string to null for all fields
        foreach ($data as $key => $value) {
            if (
                is_string($value)
                && ($value === '' || $value === 'null')
                && is_string($key)
                && $this->isNullablePropertyPath($key)
            ) {
                $data[$key] = null;
            }
        }

        return $data;
    }
}
