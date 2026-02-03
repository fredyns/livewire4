<section>
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight">{{ __('Edit User') }}</h1>
                <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">
                    {{ __('Update user information') }}
                </p>
            </div>
            <flux:button href="{{ route('user.show', $user) }}" variant="ghost" icon="arrow-left">
                {{ __('Back') }}
            </flux:button>
        </div>

        <!-- Form -->
        <div class="grid gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <flux:card>
                    <form wire:submit="save" class="space-y-6">
                        <!-- Name Field -->
                        <div>
                            <flux:input
                                wire:model="name"
                                label="{{ __('Name') }}"
                                type="text"
                                placeholder="{{ __('Enter user name') }}"
                                required
                            />
                            @error('name')
                                <span class="mt-2 block text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div>
                            <flux:input
                                wire:model="email"
                                label="{{ __('Email') }}"
                                type="email"
                                placeholder="{{ __('Enter email address') }}"
                                required
                            />
                            @error('email')
                                <span class="mt-2 block text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="flex gap-2 pt-4">
                            <flux:button type="submit" variant="primary">
                                {{ __('Update User') }}
                            </flux:button>
                            <flux:button href="{{ route('user.show', $user) }}" variant="ghost">
                                {{ __('Cancel') }}
                            </flux:button>
                        </div>
                    </form>
                </flux:card>
            </div>

            <!-- Sidebar Info -->
            <div>
                <flux:card>
                    <flux:heading size="lg" level="2">{{ __('Requirements') }}</flux:heading>

                    <div class="mt-6 space-y-4 text-sm">
                        <div>
                            <p class="font-semibold text-neutral-900 dark:text-neutral-100">{{ __('Name') }}</p>
                            <p class="mt-1 text-neutral-600 dark:text-neutral-400">
                                {{ __('Minimum 3 characters, maximum 255') }}
                            </p>
                        </div>

                        <div>
                            <p class="font-semibold text-neutral-900 dark:text-neutral-100">{{ __('Email') }}</p>
                            <p class="mt-1 text-neutral-600 dark:text-neutral-400">
                                {{ __('Must be a valid email address and unique in the system') }}
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