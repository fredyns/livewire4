<section>
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight">{{ __('Edit Sample Item') }}</h1>
                <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">
                    {{ __('Update sample item information') }}
                </p>
            </div>
            <flux:button href="{{ route('sample.item.show', $item) }}" variant="ghost" icon="arrow-left">
                {{ __('Back') }}
            </flux:button>
        </div>

        <!-- Form -->
        <div class="grid gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <flux:card>
                    <form wire:submit="save" class="space-y-6">
                        @include('pages.sample.item._form-inputs')

                        <!-- Form Actions -->
                        <div class="flex gap-2 pt-4">
                            <flux:button type="submit" variant="primary">
                                {{ __('Update Item') }}
                            </flux:button>
                            <flux:button href="{{ route('sample.item.show', $item) }}" variant="ghost">
                                {{ __('Cancel') }}
                            </flux:button>
                        </div>
                    </form>
                </flux:card>
            </div>

            <!-- Sidebar Info -->
            <div>
                <flux:card>
                    <flux:heading size="lg" level="2">{{ __('Info') }}</flux:heading>

                    <div class="mt-6 space-y-4 text-sm">
                        <div>
                            <p class="font-semibold text-neutral-900 dark:text-neutral-100">{{ __('ID') }}</p>
                            <p class="mt-1 text-neutral-600 dark:text-neutral-400 break-all">
                                {{ $item->id }}
                            </p>
                        </div>

                        <div>
                            <p class="font-semibold text-neutral-900 dark:text-neutral-100">{{ __('Created') }}</p>
                            <p class="mt-1 text-neutral-600 dark:text-neutral-400">
                                {{ $item->created_at?->format('M d, Y H:i') ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="font-semibold text-neutral-900 dark:text-neutral-100">{{ __('Updated') }}</p>
                            <p class="mt-1 text-neutral-600 dark:text-neutral-400">
                                {{ $item->updated_at?->format('M d, Y H:i') ?? '-' }}
                            </p>
                        </div>
                    </div>
                </flux:card>
            </div>
        </div>

        <!-- Flash Messages -->
        @if (session('message'))
            <flux:toast>
                {{ session('message') }}
            </flux:toast>
        @endif

        @if (session('error'))
            <flux:toast variant="danger">
                {{ session('error') }}
            </flux:toast>
        @endif
    </div>
</section>
