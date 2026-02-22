<x-modal wire:model="showingModalForm" :closable="false" class="{{ $this->modalDialogClass }}">
    <form
        wire:submit.prevent="save"
        class="space-y-6"
        x-data="{
            modalWidth: @js($this->modalWidth),
            wasOpen: false,
            applyWidth() {
                const dialog = this.$el.closest('dialog');

                if (! dialog) {
                    return;
                }

                [...dialog.classList]
                    .filter((c) => c.startsWith('[:where(&)]:max-w-'))
                    .forEach((c) => dialog.classList.remove(c));

                [...dialog.classList]
                    .filter((c) => c === 'w-auto' || c === 'w-fit' || c === 'w-full' || c.startsWith('w-'))
                    .forEach((c) => dialog.classList.remove(c));

                dialog.classList.add('w-full');

                const map = {
                    '3xl': '[:where(&)]:max-w-3xl',
                    '5xl': '[:where(&)]:max-w-5xl',
                    '7xl': '[:where(&)]:max-w-7xl',
                    'max': '[:where(&)]:max-w-[calc(100vw-2rem)]',
                };

                dialog.classList.add(map[this.modalWidth] ?? '[:where(&)]:max-w-3xl');
            },
        }"
        x-init="$nextTick(() => applyWidth())"
        x-effect="
            applyWidth()

            if ($wire.showingModalForm && ! wasOpen) {
                wasOpen = true
                Livewire.dispatch('progress-done')
            }

            if (! $wire.showingModalForm && wasOpen) {
                wasOpen = false
            }
        "
        x-on:sample-modal-width-change.window="modalWidth = $event.detail.width; $nextTick(() => applyWidth())"
    >
        <div class="flex items-start justify-between gap-4">
            <div class="min-w-0">
                <flux:heading size="lg" level="2" class="truncate">
                    Item Form
                </flux:heading>
            </div>

            <div class="shrink-0 flex items-center gap-2">
                <flux:dropdown position="bottom" align="end">
                    <flux:button variant="outline" size="sm" icon="unfold-horizontal" icon:trailing="chevron-down">
                        <span x-text="modalWidth.toUpperCase()"></span>
                    </flux:button>

                    <flux:menu>
                        <flux:menu.item x-on:click.prevent.stop="window.dispatchEvent(new CustomEvent('sample-modal-width-change', { detail: { width: '3xl' } }))">3XL</flux:menu.item>
                        <flux:menu.item x-on:click.prevent.stop="window.dispatchEvent(new CustomEvent('sample-modal-width-change', { detail: { width: '5xl' } }))">5XL</flux:menu.item>
                        <flux:menu.item x-on:click.prevent.stop="window.dispatchEvent(new CustomEvent('sample-modal-width-change', { detail: { width: '7xl' } }))">7XL</flux:menu.item>
                        <flux:menu.item x-on:click.prevent.stop="window.dispatchEvent(new CustomEvent('sample-modal-width-change', { detail: { width: 'max' } }))">MAX</flux:menu.item>
                    </flux:menu>
                </flux:dropdown>

                <flux:button
                    variant="outline"
                    size="sm"
                    icon="x-mark"
                    x-data
                    x-on:click="$wire.showingModalForm = false"
                >
                    {{ __('Close') }}
                </flux:button>
            </div>
        </div>

        <flux:card>
            <flux:heading size="md" level="3" class="mb-4">{{ __('Main Information') }}</flux:heading>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div class="md:col-span-2">
                    <flux:input
                        wire:model="model.string"
                        label="{{ __('String') }}"
                        type="text"
                        placeholder="{{ __('Enter string') }}"
                        required
                    />
                    @error('model.string')
                        <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <flux:input
                        wire:model="model.email"
                        label="{{ __('Email') }}"
                        type="email"
                        placeholder="{{ __('Enter email') }}"
                    />
                    @error('model.email')
                        <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <flux:input
                        wire:model="model.user_id"
                        label="{{ __('User ID') }}"
                        type="text"
                        placeholder="{{ __('(optional)') }}"
                    />
                    @error('model.user_id')
                        <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <flux:select wire:model="model.enumerate" label="{{ __('Status') }}" placeholder="{{ __('Select value') }}">
                        <flux:select.option value="">{{ __('None') }}</flux:select.option>
                        @foreach (\App\Enums\Sample\SampleItemEnumerate::cases() as $enum)
                            <flux:select.option value="{{ $enum->value }}">{{ $enum->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    @error('model.enumerate')
                        <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <flux:textarea
                        wire:model="model.text"
                        label="{{ __('Text') }}"
                        placeholder="{{ __('Enter text') }}"
                        rows="4"
                    />
                    @error('model.text')
                        <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </flux:card>

        <flux:card>
            <div
                x-data="{
                    maxH: 0,
                    observer: null,
                    measure() {
                        const panel = this.$el.querySelector('[role=tabpanel]');

                        if (! panel) {
                            return;
                        }

                        const h = panel.scrollHeight || 0;

                        if (h > this.maxH) {
                            this.maxH = h;
                        }
                    },
                    start() {
                        this.measure();

                        this.observer = new MutationObserver(() => {
                            this.$nextTick(() => this.measure());
                        });

                        this.observer.observe(this.$el, {
                            childList: true,
                            subtree: true,
                            attributes: true,
                            characterData: true,
                        });

                        window.addEventListener('resize', () => {
                            this.$nextTick(() => this.measure());
                        });
                    }
                }"
                x-init="$nextTick(() => start())"
                :style="maxH ? `min-height: ${maxH}px` : null"
            >
                <flux:tab.group>
                    <flux:tabs>
                        <flux:tab name="basic">{{ __('Basic') }}</flux:tab>
                        <flux:tab name="datetime">{{ __('Date & Time') }}</flux:tab>
                        <flux:tab name="other">{{ __('Other') }}</flux:tab>
                        <flux:tab name="location">{{ __('Location') }}</flux:tab>
                        <flux:tab name="files">{{ __('Files') }}</flux:tab>
                        <flux:tab name="content">{{ __('Content') }}</flux:tab>
                    </flux:tabs>

                    <flux:tab.panel name="basic">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <flux:input
                                    wire:model="model.color"
                                    label="{{ __('Color') }}"
                                    type="text"
                                    placeholder="{{ __('e.g. #ff0000') }}"
                                />
                                @error('model.color')
                                    <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <flux:input
                                    wire:model="model.ip_address"
                                    label="{{ __('IP Address') }}"
                                    type="text"
                                    placeholder="{{ __('e.g. 127.0.0.1') }}"
                                />
                                @error('model.ip_address')
                                    <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <flux:input
                                    wire:model="model.integer"
                                    label="{{ __('Integer') }}"
                                    type="number"
                                    placeholder="{{ __('Enter integer') }}"
                                />
                                @error('model.integer')
                                    <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <flux:input
                                    wire:model="model.decimal"
                                    label="{{ __('Decimal') }}"
                                    type="number"
                                    step="0.01"
                                    placeholder="{{ __('Enter decimal') }}"
                                />
                                @error('model.decimal')
                                    <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <flux:input
                                    wire:model="model.npwp"
                                    label="{{ __('NPWP') }}"
                                    type="text"
                                    placeholder="{{ __('Enter NPWP') }}"
                                />
                                @error('model.npwp')
                                    <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </flux:tab.panel>

                    <flux:tab.panel name="datetime">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <flux:input
                                    wire:model="modelDate"
                                    label="{{ __('Date') }}"
                                    type="date"
                                />
                                @error('modelDate')
                                    <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <flux:input
                                    wire:model="modelTime"
                                    label="{{ __('Time') }}"
                                    type="time"
                                    step="1"
                                />
                                @error('modelTime')
                                    <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <flux:input
                                    wire:model="modelDatetime"
                                    label="{{ __('Datetime') }}"
                                    type="datetime-local"
                                />
                                @error('modelDatetime')
                                    <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </flux:tab.panel>

                    <flux:tab.panel name="other">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="md:col-span-2">
                                <flux:checkbox wire:model="model.boolean" label="{{ __('Boolean') }}" />
                                @error('model.boolean')
                                    <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </flux:tab.panel>

                    <flux:tab.panel name="location">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <flux:input
                                    wire:model="model.latitude"
                                    label="{{ __('Latitude') }}"
                                    type="number"
                                    step="0.00000001"
                                />
                                @error('model.latitude')
                                    <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <flux:input
                                    wire:model="model.longitude"
                                    label="{{ __('Longitude') }}"
                                    type="number"
                                    step="0.00000001"
                                />
                                @error('model.longitude')
                                    <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>

                            @if (($model?->latitude && $model?->longitude))
                                <div class="md:col-span-2">
                                    <flux:button
                                        href="{{ 'https://www.google.com/maps?q=' . $model->latitude . ',' . $model->longitude }}"
                                        target="_blank"
                                        variant="outline"
                                        size="sm"
                                        icon="map"
                                    >
                                        {{ __('Open in Maps') }}
                                    </flux:button>
                                </div>
                            @endif
                        </div>
                    </flux:tab.panel>

                    <flux:tab.panel name="files">
                        <div class="space-y-6">
                            <div>
                                <flux:input
                                    wire:model="modelImage"
                                    label="{{ __('Image') }}"
                                    type="file"
                                    accept="image/*"
                                />
                                @error('modelImage')
                                    <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror

                                @if ($model?->image)
                                    <div class="mt-3">
                                        <img
                                            src="{{ \Illuminate\Support\Facades\Storage::url($model->image) }}"
                                            alt="{{ $model?->string ?? 'image' }}"
                                            class="max-h-64 rounded-lg border border-neutral-200 dark:border-neutral-700"
                                        >
                                    </div>
                                @endif
                            </div>

                            <div>
                                <flux:input
                                    wire:model="modelFile"
                                    label="{{ __('File') }}"
                                    type="file"
                                />
                                @error('modelFile')
                                    <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror

                                @if ($model?->file)
                                    <div class="mt-3 flex items-center gap-2">
                                        <flux:button
                                            href="{{ \Illuminate\Support\Facades\Storage::url($model->file) }}"
                                            target="_blank"
                                            variant="outline"
                                            size="sm"
                                            icon="arrow-down-tray"
                                        >
                                            {{ __('Open / Download') }}
                                        </flux:button>
                                        <span class="text-xs text-neutral-600 dark:text-neutral-400">{{ basename($model->file) }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </flux:tab.panel>

                    <flux:tab.panel name="content">
                        <div class="space-y-4">
                            <flux:textarea
                                wire:model="model.wysiwyg"
                                label="{{ __('WYSIWYG Content') }}"
                                placeholder="{{ __('Enter content') }}"
                                rows="6"
                            />
                            @error('model.wysiwyg')
                                <span class="mt-2 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </flux:tab.panel>
                </flux:tab.group>
            </div>
        </flux:card>

        <div class="flex items-center justify-end gap-2">
            <flux:button
                variant="outline"
                type="button"
                x-data
                x-on:click="$wire.showingModalForm = false"
            >
                {{ __('Cancel') }}
            </flux:button>
            <flux:button variant="primary" type="submit">
                {{ __('Save') }}
            </flux:button>
        </div>
    </form>
</x-modal>
