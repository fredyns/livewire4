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
                        wire:model.live="form.string"
                        type="text"
                        label="{{ __('String') }}"
                        placeholder="{{ __('Enter string') }}"
                        required
                    />
                </div>

                <div>
                    <flux:input
                        wire:model="form.email"
                        type="email"
                        label="{{ __('Email') }}"
                        placeholder="{{ __('Enter email') }}"
                    />
                </div>

                <div>
                    <flux:input
                        wire:model="form.user_id"
                        type="text"
                        label="{{ __('User ID') }}"
                        placeholder="{{ __('(optional)') }}"
                    />
                </div>

                <div>
                    <flux:select wire:model="form.enumerate" label="{{ __('Status') }}" placeholder="{{ __('Select value') }}">
                        <flux:select.option value="">{{ __('None') }}</flux:select.option>
                        @foreach (\App\Enums\Sample\SampleItemEnumerate::cases() as $enum)
                            <flux:select.option value="{{ $enum->value }}">{{ $enum->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                </div>

                <div class="md:col-span-2">
                    <flux:textarea
                        wire:model="form.text"
                        placeholder="{{ __('Enter text') }}"
                        label="{{ __('Text') }}"
                        rows="4"
                    />
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
                                    wire:model="form.color"
                                    type="text"
                                    label="{{ __('Color') }}"
                                    placeholder="{{ __('e.g. #ff0000') }}"
                                />
                            </div>

                            <div>
                                <flux:input
                                    wire:model="form.ip_address"
                                    type="text"
                                    label="{{ __('IP Address') }}"
                                    placeholder="{{ __('e.g. 127.0.0.1') }}"
                                />
                            </div>

                            <div>
                                <flux:input
                                    wire:model="form.integer"
                                    type="number"
                                    label="{{ __('Integer') }}"
                                    placeholder="{{ __('Enter integer') }}"
                                />
                            </div>

                            <div>
                                <flux:input
                                    wire:model="form.decimal"
                                    type="number"
                                    step="0.01"
                                    label="{{ __('Decimal') }}"
                                    placeholder="{{ __('Enter decimal') }}"
                                />
                            </div>

                            <div class="md:col-span-2">
                                <flux:input
                                    wire:model="form.npwp"
                                    type="text"
                                    label="{{ __('NPWP') }}"
                                    placeholder="{{ __('Enter NPWP') }}"
                                />
                            </div>
                        </div>
                    </flux:tab.panel>

                    <flux:tab.panel name="datetime">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <flux:date-picker
                                    wire:model="form.date"
                                    label="{{ __('Date') }}"
                                    placeholder="{{ __('Select date') }}"
                                    clearable
                                />
                            </div>

                            <div>
                                <flux:time-picker
                                    wire:model="form.time"
                                    label="{{ __('Time') }}"
                                    placeholder="{{ __('Select time') }}"
                                    clearable
                                    type="input"
                                />
                            </div>

                            <div class="md:col-span-2">
                                <flux:input
                                    wire:model="form.datetime"
                                    type="datetime-local"
                                    label="{{ __('Datetime') }}"
                                />
                            </div>
                        </div>
                    </flux:tab.panel>

                    <flux:tab.panel name="other">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="md:col-span-2">
                                <flux:switch wire:model="form.boolean" label="{{ __('Boolean') }}" />
                            </div>
                        </div>
                    </flux:tab.panel>

                    <flux:tab.panel name="location">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <flux:input
                                    wire:model="form.latitude"
                                    type="number"
                                    step="0.00000001"
                                    label="{{ __('Latitude') }}"
                                />
                            </div>

                            <div>
                                <flux:input
                                    wire:model="form.longitude"
                                    type="number"
                                    step="0.00000001"
                                    label="{{ __('Longitude') }}"
                                />
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
                                <flux:file-upload wire:model="form.image" label="{{ __('Image') }}">
                                    <flux:file-upload.dropzone
                                        heading="{{ __('Drop image here or click to browse') }}"
                                        text="{{ __('JPG, PNG, GIF up to 10MB') }}"
                                    />
                                </flux:file-upload>

                                @if ($form->image)
                                    <div class="mt-3 flex flex-col gap-2">
                                        <flux:file-item :heading="$form->image->getClientOriginalName()" :image="$form->image->temporaryUrl()" :size="$form->image->getSize()">
                                            <x-slot name="actions">
                                                <flux:file-item.remove wire:click="removeImage" aria-label="{{ __('Remove image') }}" />
                                            </x-slot>
                                        </flux:file-item>
                                    </div>
                                @endif

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
                                <flux:file-upload wire:model="form.file" label="{{ __('File') }}">
                                    <flux:file-upload.dropzone
                                        heading="{{ __('Drop file here or click to browse') }}"
                                        text="{{ __('Up to 10MB') }}"
                                        inline
                                    />
                                </flux:file-upload>

                                @if ($form->file)
                                    <div class="mt-3 flex flex-col gap-2">
                                        <flux:file-item :heading="$form->file->getClientOriginalName()" :size="$form->file->getSize()">
                                            <x-slot name="actions">
                                                <flux:file-item.remove wire:click="removeFile" aria-label="{{ __('Remove file') }}" />
                                            </x-slot>
                                        </flux:file-item>
                                    </div>
                                @endif

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
                            <flux:editor
                                wire:model="form.wysiwyg"
                                label="{{ __('WYSIWYG Content') }}"
                            />
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
