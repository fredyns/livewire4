<div class="grid grid-cols-1 gap-6 md:grid-cols-2">
    <div class="md:col-span-2">
        <flux:input
            wire:model="string"
            label="{{ __('String') }}"
            type="text"
            placeholder="{{ __('Enter string') }}"
            required
        />
        @error('string')
            <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <flux:input
            wire:model="email"
            label="{{ __('Email') }}"
            type="email"
            placeholder="{{ __('Enter email') }}"
        />
        @error('email')
            <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <flux:select wire:model="user_id" label="{{ __('User') }}" placeholder="{{ __('Select user') }}">
            <flux:select.option value="">{{ __('No user') }}</flux:select.option>
            @foreach ($this->users as $user)
                <flux:select.option value="{{ $user->id }}">{{ $user->name }}</flux:select.option>
            @endforeach
        </flux:select>
        @error('user_id')
            <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <flux:select wire:model="enumerate" label="{{ __('Enumerate') }}" placeholder="{{ __('Select value') }}">
            <flux:select.option value="">{{ __('None') }}</flux:select.option>
            @foreach ($this->enumerates as $enum)
                <flux:select.option value="{{ $enum->value }}">{{ $enum->name }}</flux:select.option>
            @endforeach
        </flux:select>
        @error('enumerate')
            <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <flux:input
            wire:model="color"
            label="{{ __('Color') }}"
            type="text"
            placeholder="{{ __('e.g. #ff0000') }}"
        />
        @error('color')
            <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <flux:input
            wire:model="ip_address"
            label="{{ __('IP Address') }}"
            type="text"
            placeholder="{{ __('e.g. 127.0.0.1') }}"
        />
        @error('ip_address')
            <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <flux:input
            wire:model="integer"
            label="{{ __('Integer') }}"
            type="number"
            placeholder="{{ __('Enter integer') }}"
        />
        @error('integer')
            <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <flux:input
            wire:model="decimal"
            label="{{ __('Decimal') }}"
            type="number"
            step="0.01"
            placeholder="{{ __('Enter decimal') }}"
        />
        @error('decimal')
            <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <flux:input
            wire:model="date"
            label="{{ __('Date') }}"
            type="date"
        />
        @error('date')
            <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <flux:input
            wire:model="time"
            label="{{ __('Time') }}"
            type="time"
            step="1"
        />
        @error('time')
            <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
        @enderror
    </div>

    <div class="md:col-span-2">
        <flux:input
            wire:model="datetime"
            label="{{ __('Datetime') }}"
            type="datetime-local"
        />
        @error('datetime')
            <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
        @enderror
    </div>

    <div class="md:col-span-2">
        <flux:textarea
            wire:model="text"
            label="{{ __('Text') }}"
            placeholder="{{ __('Enter text') }}"
            rows="4"
        />
        @error('text')
            <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
        @enderror
    </div>

    <div class="md:col-span-2">
        <flux:textarea
            wire:model="wysiwyg"
            label="{{ __('WYSIWYG') }}"
            placeholder="{{ __('Enter wysiwyg content') }}"
            rows="4"
        />
        @error('wysiwyg')
            <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <flux:input
            wire:model="latitude"
            label="{{ __('Latitude') }}"
            type="number"
            step="0.00000001"
        />
        @error('latitude')
            <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <flux:input
            wire:model="longitude"
            label="{{ __('Longitude') }}"
            type="number"
            step="0.00000001"
        />
        @error('longitude')
            <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
        @enderror
    </div>

    <div class="md:col-span-2">
        <flux:checkbox wire:model="boolean" label="{{ __('Boolean') }}" />
        @error('boolean')
            <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
        @enderror
    </div>
</div>
