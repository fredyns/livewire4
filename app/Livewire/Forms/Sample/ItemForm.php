<?php

namespace App\Livewire\Forms\Sample;

use App\Models\Sample\SampleItem;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Form;

/**
 * Livewire Form object for SampleItem create/update.
 */
class ItemForm extends Form
{
    public ?SampleItem $model = null;

    #[Validate(['nullable', 'date'])]
    public ?string $date = null;

    #[Validate(['nullable', 'date_format:H:i'])]
    public ?string $time = null;

    #[Validate(['nullable', 'date'])]
    public ?string $datetime = null;

    #[Validate('nullable|file|extensions:pdf,docx,xlsx,pptx,zip,rar|max:10240')]
    public $file = null;

    #[Validate('nullable|image|extensions:jpeg,png,jpg,gif,svg,webm,heic|max:5120')]
    public $image = null;

    #[Validate(['required', 'string', 'max:255'])]
    public string $string = '';

    #[Validate(['nullable', 'email', 'max:255'])]
    public ?string $email = null;

    #[Validate(['nullable', 'string'])]
    public ?string $user_id = null;

    #[Validate(['nullable', 'string'])]
    public ?string $enumerate = null;

    #[Validate(['nullable', 'string'])]
    public ?string $text = null;

    #[Validate(['nullable', 'string', 'max:50'])]
    public ?string $color = null;

    #[Validate(['nullable', 'string', 'max:255'])]
    public ?string $ip_address = null;

    #[Validate(['nullable', 'integer'])]
    public ?int $integer = null;

    #[Validate(['nullable', 'numeric'])]
    public $decimal = null;

    #[Validate(['nullable', 'string', 'max:255'])]
    public ?string $npwp = null;

    #[Validate(['nullable', 'boolean'])]
    public ?bool $boolean = null;

    #[Validate(['nullable', 'numeric'])]
    public $latitude = null;

    #[Validate(['nullable', 'numeric'])]
    public $longitude = null;

    #[Validate(['nullable', 'string'])]
    public ?string $wysiwyg = null;

    protected function normalizeForDatabase(): void
    {
        if ($this->decimal === '') {
            $this->decimal = null;
        }

        if ($this->latitude === '') {
            $this->latitude = null;
        }

        if ($this->longitude === '') {
            $this->longitude = null;
        }
    }

    /**
     * Fill the form from an existing model.
     */
    public function setModel(SampleItem $model): void
    {
        $this->model = $model;

        $this->datetime = optional($model->datetime)->format('Y-m-d H:i:s');
        $this->date = optional($model->date)->format('Y-m-d');
        $this->time = optional($model->time)->format('H:i');

        $this->string = $model->string;
        $this->email = $model->email;
        $this->user_id = $model->user_id;
        $this->enumerate = $model->enumerate?->value ?? $model->enumerate;
        $this->text = $model->text;
        $this->color = $model->color;
        $this->ip_address = $model->ip_address;
        $this->integer = $model->integer;
        $this->decimal = $model->decimal;
        $this->npwp = $model->npwp;
        $this->boolean = $model->boolean;
        $this->latitude = $model->latitude;
        $this->longitude = $model->longitude;
        $this->wysiwyg = $model->wysiwyg;
    }

    /**
     * Persist a new model.
     */
    public function store(): SampleItem
    {
        $this->normalizeForDatabase();
        $this->validate();

        $model = SampleItem::create($this->only([
            'string',
            'email',
            'user_id',
            'enumerate',
            'text',
            'color',
            'ip_address',
            'integer',
            'decimal',
            'npwp',
            'boolean',
            'latitude',
            'longitude',
            'wysiwyg',
        ]));

        $model->id = (string) Str::uuid();
        $model->datetime = Carbon::make($this->datetime);
        $model->date = Carbon::make($this->date);
        $model->time = $this->time ? Carbon::createFromFormat('H:i', $this->time)->format('H:i:s') : null;

        if ($this->file) {
            $model->file = $this->file->store('public');
        }

        if ($this->image) {
            $model->image = $this->image->store('public');
        }

        $model->save();

        return $model;
    }

    /**
     * Update an existing model.
     */
    public function update(): SampleItem
    {
        $this->normalizeForDatabase();
        $this->validate();

        $this->model?->update($this->only([
            'string',
            'email',
            'user_id',
            'enumerate',
            'text',
            'color',
            'ip_address',
            'integer',
            'decimal',
            'npwp',
            'boolean',
            'latitude',
            'longitude',
            'wysiwyg',
        ]));

        if ($this->model) {
            $this->model->datetime = Carbon::make($this->datetime);
            $this->model->date = Carbon::make($this->date);
            $this->model->time = $this->time ? Carbon::createFromFormat('H:i', $this->time)->format('H:i:s') : null;

            if ($this->file) {
                $this->model->file = $this->file->store('public');
            }

            if ($this->image) {
                $this->model->image = $this->image->store('public');
            }

            $this->model->save();
        }

        return $this->model;
    }
}
