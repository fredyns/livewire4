<section>
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight">{{ $permission->name }}</h1>
                <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">
                    {{ __('Guard') }}: {{ $permission->guard_name }}
                </p>
            </div>
            <div class="flex gap-2">
                <flux:button href="{{ route('rbac.permission.edit', $permission) }}" variant="primary" icon="pencil" wire:navigate>
                    {{ __('Edit') }}
                </flux:button>
                <flux:button
                    wire:click="delete"
                    wire:confirm="{{ __('Are you sure you want to delete this permission?') }}"
                    variant="danger"
                    icon="trash"
                >
                    {{ __('Delete') }}
                </flux:button>
                <flux:button href="{{ route('rbac.permission.index') }}" variant="ghost" icon="arrow-left" wire:navigate>
                    {{ __('Back') }}
                </flux:button>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2 space-y-6">
                <flux:card>
                    <flux:heading size="lg" level="2">{{ __('Permission Information') }}</flux:heading>

                    <div class="mt-6 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                    {{ __('Name') }}
                                </p>
                                <p class="mt-2 text-sm font-medium">{{ $permission->name }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                    {{ __('Guard') }}
                                </p>
                                <p class="mt-2 text-sm font-medium">{{ $permission->guard_name }}</p>
                            </div>
                        </div>
                    </div>
                </flux:card>

                <flux:card>
                    <flux:heading size="lg" level="2">{{ __('Usage') }}</flux:heading>

                    <div class="mt-6 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                    {{ __('Roles') }}
                                </p>
                                <p class="mt-2 text-sm font-medium">{{ $this->rolesCount }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                    {{ __('Users') }}
                                </p>
                                <p class="mt-2 text-sm font-medium">{{ $this->usersCount }}</p>
                            </div>
                        </div>
                    </div>
                </flux:card>
            </div>

            <div class="space-y-6">
                <flux:card>
                    <flux:heading size="lg" level="2">{{ __('Actions') }}</flux:heading>

                    <div class="mt-6 space-y-2">
                        <flux:button href="{{ route('rbac.permission.edit', $permission) }}" variant="primary" class="w-full" wire:navigate>
                            {{ __('Edit Permission') }}
                        </flux:button>
                        <flux:button
                            wire:click="delete"
                            wire:confirm="{{ __('Are you sure you want to delete this permission?') }}"
                            variant="danger"
                            class="w-full"
                            icon="trash"
                        >
                            {{ __('Delete Permission') }}
                        </flux:button>
                    </div>
                </flux:card>
            </div>
        </div>

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
