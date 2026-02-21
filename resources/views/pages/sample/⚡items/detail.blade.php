<x-modal wire:model="showingModalView" :closable="false" class="{{ $this->modalDialogClass }}">
    <div
        class="space-y-6"
        x-data="{
            modalWidth: @js($this->modalWidth),
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
        x-effect="applyWidth()"
        x-on:sample-modal-width-change.window="modalWidth = $event.detail.width; $nextTick(() => applyWidth())"
    >
        <div class="flex items-start justify-between gap-4">
            <div class="min-w-0">
                <flux:heading size="lg" level="2" class="truncate">
                    {{ $model?->string ?? __('Item Details') }}
                </flux:heading>
                <flux:text class="mt-1">
                    {{ __('Item details and information') }}
                </flux:text>
            </div>

            <div class="shrink-0 flex items-center gap-2">
                <flux:dropdown position="bottom" align="end">
                    <flux:button variant="outline" size="sm" icon="arrows-right-left" icon:trailing="chevron-down">
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
                    x-on:click="$wire.showingModalView = false"
                >
                    {{ __('Close') }}
                </flux:button>
            </div>
        </div>

        <flux:card>
            <flux:heading size="md" level="3" class="mb-4">{{ __('Main Information') }}</flux:heading>

            <div class="space-y-4">
                <div class="flex flex-col gap-4 md:flex-row">
                    <div class="flex-1 md:w-1/3">
                        <flux:label>{{ __('String') }}</flux:label>
                        <p class="mt-1 text-sm">{{ $model?->string ?? '-' }}</p>
                    </div>

                    <div class="flex-1 md:w-1/3">
                        <flux:label>{{ __('Email') }}</flux:label>
                        <p class="mt-1 text-sm">{{ $model?->email ?? '-' }}</p>
                    </div>

                    <div class="flex-1 md:w-1/3">
                        <flux:label>{{ __('Status') }}</flux:label>
                        <div class="mt-1">
                            @if ($model?->enumerate)
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium bg-neutral-100 text-neutral-800 dark:bg-neutral-800 dark:text-neutral-100">
                                    {{ $model->enumerate?->label() ?? (string) $model->enumerate }}
                                </span>
                            @else
                                <span class="text-sm text-neutral-600 dark:text-neutral-400">-</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="w-full">
                    <flux:label>{{ __('Text') }}</flux:label>
                    <p class="mt-1 text-sm whitespace-pre-wrap">{{ $model?->text ?? '-' }}</p>
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
                        <div class="space-y-4">
                        <div>
                            <flux:label>{{ __('Color') }}</flux:label>
                            <div class="mt-2 flex items-center gap-2">
                                @if ($model?->color)
                                    <div class="h-8 w-8 rounded border border-neutral-200 dark:border-neutral-700" style="background-color: {{ $model->color }};"></div>
                                    <span class="text-sm">{{ $model->color }}</span>
                                @else
                                    <span class="text-sm text-neutral-600 dark:text-neutral-400">-</span>
                                @endif
                            </div>
                        </div>

                        <div>
                            <flux:label>{{ __('Integer') }}</flux:label>
                            <p class="mt-1 text-sm">{{ $model?->integer ?? '-' }}</p>
                        </div>

                        <div>
                            <flux:label>{{ __('Decimal') }}</flux:label>
                            <p class="mt-1 text-sm">{{ $model?->decimal ?? '-' }}</p>
                        </div>

                        <div>
                            <flux:label>{{ __('NPWP') }}</flux:label>
                            <p class="mt-1 text-sm">{{ $model?->npwp ?? '-' }}</p>
                        </div>

                            <div>
                                <flux:label>{{ __('User') }}</flux:label>
                                <p class="mt-1 text-sm">{{ $model?->user?->name ?? '-' }}</p>
                            </div>
                        </div>
                    </flux:tab.panel>

                    <flux:tab.panel name="datetime">
                        <div class="space-y-4">
                        <div>
                            <flux:label>{{ __('Date') }}</flux:label>
                            <p class="mt-1 text-sm">{{ $model?->date?->format('l, d F Y') ?? '-' }}</p>
                        </div>

                        <div>
                            <flux:label>{{ __('Time') }}</flux:label>
                            <p class="mt-1 text-sm">{{ $model?->time?->format('H:i') ?? '-' }}</p>
                        </div>

                            <div>
                                <flux:label>{{ __('Datetime') }}</flux:label>
                                <p class="mt-1 text-sm">{{ $model?->datetime?->format('l, d F Y H:i') ?? '-' }}</p>
                            </div>
                        </div>
                    </flux:tab.panel>

                    <flux:tab.panel name="other">
                        <div class="space-y-4">
                        <div>
                            <flux:label>{{ __('IP Address') }}</flux:label>
                            <p class="mt-1 text-sm">{{ $model?->ip_address ?? '-' }}</p>
                        </div>

                            <div>
                                <flux:label>{{ __('Boolean') }}</flux:label>
                                <p class="mt-1 text-sm">
                                    {{ is_null($model?->boolean) ? '-' : ($model->boolean ? __('Yes') : __('No')) }}
                                </p>
                            </div>
                        </div>
                    </flux:tab.panel>

                    <flux:tab.panel name="location">
                        <div class="space-y-4">
                        @if ($model?->latitude && $model?->longitude)
                            <div>
                                <flux:label>{{ __('Coordinates') }}</flux:label>
                                <p class="mt-1 text-sm">{{ $model->latitude }}, {{ $model->longitude }}</p>
                            </div>
                            <div>
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
                        @else
                            <p class="text-sm text-neutral-600 dark:text-neutral-400">{{ __('No location data available') }}</p>
                        @endif
                        </div>
                    </flux:tab.panel>

                    <flux:tab.panel name="files">
                        <div class="space-y-4">
                        <div>
                            <flux:label>{{ __('Image') }}</flux:label>
                            @if ($model?->image)
                                <div class="mt-2">
                                    <img
                                        src="{{ \Illuminate\Support\Facades\Storage::url($model->image) }}"
                                        alt="{{ $model?->string ?? 'image' }}"
                                        class="max-h-64 rounded-lg border border-neutral-200 dark:border-neutral-700"
                                    >
                                </div>
                            @else
                                <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">-</p>
                            @endif
                        </div>

                            <div>
                                <flux:label>{{ __('File') }}</flux:label>
                                @if ($model?->file)
                                    <div class="mt-2 flex items-center gap-2">
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
                                @else
                                    <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">-</p>
                                @endif
                            </div>
                        </div>
                    </flux:tab.panel>

                    <flux:tab.panel name="content">
                        <div class="space-y-4">
                        <div>
                            <flux:label>{{ __('WYSIWYG Content') }}</flux:label>
                            @if ($model?->wysiwyg)
                                <div class="mt-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-900 p-4 text-sm prose prose-sm max-w-none dark:prose-invert">
                                    {!! $model->wysiwyg !!}
                                </div>
                            @else
                                <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">-</p>
                            @endif
                        </div>
                        </div>
                    </flux:tab.panel>
                </flux:tab.group>
            </div>
        </flux:card>
    </div>
</x-modal>
