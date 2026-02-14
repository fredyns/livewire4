<section>
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight">{{ $item->string }}</h1>
                <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                    {{ $item->email ?? __('No email') }}
                </p>
            </div>
            <div class="flex gap-2">
                <flux:button href="{{ route('sample.item.index') }}" variant="ghost" icon="arrow-left">
                    {{ __('Back') }}
                </flux:button>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid gap-6 lg:grid-cols-3">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <flux:card>
                    <flux:heading size="lg" level="2">{{ __('Item Information') }}</flux:heading>

                    <div class="mt-6 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                    {{ __('String') }}
                                </p>
                                <p class="mt-1 text-sm font-medium">
                                    {{ $item->string }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                    {{ __('Enumerate') }}
                                </p>
                                <p class="mt-1 text-sm font-medium">
                                    {{ $item->enumerate?->value ?? '-' }}
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                    {{ __('Email') }}
                                </p>
                                <p class="mt-1 text-sm font-medium">
                                    {{ $item->email ?? '-' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                    {{ __('NPWP') }}
                                </p>
                                <p class="mt-1 text-sm font-medium">
                                    {{ $item->npwp ?? '-' }}
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                    {{ __('Integer') }}
                                </p>
                                <p class="mt-1 text-sm font-medium">
                                    {{ $item->integer ?? '-' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                    {{ __('Decimal') }}
                                </p>
                                <p class="mt-1 text-sm font-medium">
                                    {{ $item->decimal ?? '-' }}
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                    {{ __('Date') }}
                                </p>
                                <p class="mt-1 text-sm font-medium">
                                    {{ $item->date?->format('M d, Y') ?? '-' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                    {{ __('Time') }}
                                </p>
                                <p class="mt-1 text-sm font-medium">
                                    {{ $item->time?->format('H:i:s') ?? '-' }}
                                </p>
                            </div>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                {{ __('Text') }}
                            </p>
                            <p class="mt-1 text-sm font-medium whitespace-pre-line">
                                {{ $item->text ?? '-' }}
                            </p>
                        </div>
                    </div>
                </flux:card>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <flux:card>
                    <flux:heading size="lg" level="2">{{ __('Meta') }}</flux:heading>

                    <div class="mt-6 space-y-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                {{ __('User') }}
                            </p>
                            <p class="mt-1 text-sm font-medium">
                                {{ $item->user?->name ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                {{ __('Created') }}
                            </p>
                            <p class="mt-1 text-sm font-medium">
                                {{ $item->created_at?->format('M d, Y H:i') ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                {{ __('Updated') }}
                            </p>
                            <p class="mt-1 text-sm font-medium">
                                {{ $item->updated_at?->format('M d, Y H:i') ?? '-' }}
                            </p>
                        </div>
                    </div>
                </flux:card>

                <flux:card>
                    <flux:heading size="lg" level="2">{{ __('Actions') }}</flux:heading>

                    <div class="mt-6 space-y-2">
                        <flux:button href="{{-- route('sample.item.edit', $item) --}}" variant="primary" class="w-full">
                            {{ __('Edit Item') }}
                        </flux:button>
                    </div>
                </flux:card>
            </div>
        </div>
    </div>
</section>
