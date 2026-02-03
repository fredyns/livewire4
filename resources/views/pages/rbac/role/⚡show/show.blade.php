<section>
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight">{{ $role->name }}</h1>
                <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">
                    {{ __('Guard') }}: {{ $role->guard_name }}
                </p>
            </div>
            <div class="flex gap-2">
                <flux:button href="{{-- route('rbac.role.edit', $role) --}}" variant="primary" icon="pencil">
                    {{ __('Edit') }}
                </flux:button>
                <flux:button href="{{ route('rbac.role.index') }}" variant="ghost" icon="arrow-left" wire:navigate>
                    {{ __('Back') }}
                </flux:button>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid gap-6 lg:grid-cols-3">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Role Information -->
                <flux:card>
                    <flux:heading size="lg" level="2">{{ __('Role Information') }}</flux:heading>

                    <div class="mt-6 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                    {{ __('Name') }}
                                </p>
                                <p class="mt-2 text-sm font-medium">{{ $role->name }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                    {{ __('Guard') }}
                                </p>
                                <p class="mt-2 text-sm font-medium">{{ $role->guard_name }}</p>
                            </div>
                        </div>
                    </div>
                </flux:card>

                <!-- Timestamps -->
                <flux:card>
                    <flux:heading size="lg" level="2">{{ __('Timestamps') }}</flux:heading>

                    <div class="mt-6 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                    {{ __('Created') }}
                                </p>
                                <p class="mt-2 text-sm font-medium">{{ $role->created_at?->format('M d, Y H:i:s') ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                    {{ __('Updated') }}
                                </p>
                                <p class="mt-2 text-sm font-medium">{{ $role->updated_at?->format('M d, Y H:i:s') ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </flux:card>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <flux:card>
                    <flux:heading size="lg" level="2">{{ __('Actions') }}</flux:heading>

                    <div class="mt-6 space-y-2">
                        <flux:button href="{{-- route('rbac.role.edit', $role) --}}" variant="primary" class="w-full">
                            {{ __('Edit Role') }}
                        </flux:button>
                    </div>
                </flux:card>
            </div>
        </div>
    </div>
</section>
