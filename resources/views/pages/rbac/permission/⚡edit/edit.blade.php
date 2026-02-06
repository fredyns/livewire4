<section>
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight">{{ __('Edit Permission') }}</h1>
                <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">
                    {{ __('Update permission information') }}
                </p>
            </div>
            <flux:button href="{{ route('rbac.permission.show', $permission) }}" variant="ghost" icon="arrow-left" wire:navigate>
                {{ __('Back') }}
            </flux:button>
        </div>

        <!-- Form -->
        <div class="grid gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <flux:card>
                    <form wire:submit="save" class="space-y-6">
                        <div>
                            <flux:input
                                wire:model="name"
                                label="{{ __('Name') }}"
                                type="text"
                                placeholder="{{ __('Enter permission name') }}"
                                required
                            />
                            @error('name')
                                <span class="mt-2 block text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div>
                            <flux:input
                                :label="__('Guard')"
                                type="text"
                                :value="$permission->guard_name"
                                disabled
                            />
                        </div>

                        <div class="flex gap-2 pt-4">
                            <flux:button type="submit" variant="primary">
                                {{ __('Update Permission') }}
                            </flux:button>
                            <flux:button href="{{ route('rbac.permission.show', $permission) }}" variant="ghost" wire:navigate>
                                {{ __('Cancel') }}
                            </flux:button>
                        </div>
                    </form>
                </flux:card>
            </div>

            <div>
                <flux:card>
                    <flux:heading size="lg" level="2">{{ __('Notes') }}</flux:heading>

                    <div class="mt-6 space-y-4 text-sm">
                        <div>
                            <p class="font-semibold text-neutral-900 dark:text-neutral-100">{{ __('Guard') }}</p>
                            <p class="mt-1 text-neutral-600 dark:text-neutral-400">
                                {{ __('Guard cannot be changed after creation.') }}
                            </p>
                        </div>
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
