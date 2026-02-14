<section>
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight">{{ __('Create Sample Item') }}</h1>
                <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">
                    {{ __('Add a new sample item') }}
                </p>
            </div>
            <flux:button href="{{ route('sample.item.index') }}" variant="ghost" icon="arrow-left">
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
                                {{ __('Create Item') }}
                            </flux:button>
                            <flux:button href="{{ route('sample.item.index') }}" variant="ghost">
                                {{ __('Cancel') }}
                            </flux:button>
                        </div>
                    </form>
                </flux:card>
            </div>

            <!-- Sidebar Info -->
            <div>
                <flux:card>
                    <flux:heading size="lg" level="2">{{ __('Notes') }}</flux:heading>

                    <div class="mt-6 space-y-4 text-sm">
                        <div>
                            <p class="font-semibold text-neutral-900 dark:text-neutral-100">Searchable</p>
                            <p class="mt-1 text-neutral-600 dark:text-neutral-400">
                                {{ __('String, email, color and text are searchable fields.') }}
                            </p>
                        </div>

                        <div>
                            <p class="font-semibold text-neutral-900 dark:text-neutral-100">Validation</p>
                            <p class="mt-1 text-neutral-600 dark:text-neutral-400">
                                {{ __('Some fields require specific formats (email, ip, time).') }}
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
