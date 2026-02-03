<section>
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight">{{ __('Change Password') }}</h1>
                <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">
                    {{ __('Update Password for :name', ['name' => $user->name]) }}
                </p>
            </div>
            <flux:button href="{{ route('user.show', $user) }}" variant="ghost" icon="arrow-left">
                {{ __('Back') }}
            </flux:button>
        </div>

        <!-- Form -->
        <div class="grid gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2 space-y-6">
                <!-- User Information -->
                <flux:card>
                    <flux:heading size="lg" level="2">{{ __('User Information') }}</flux:heading>

                    <div class="mt-6 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                    {{ __('First Name') }}
                                </p>
                                <p class="mt-1 text-sm font-medium">
                                    {{ $user->first_name ?? '-' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                    {{ __('Last Name') }}
                                </p>
                                <p class="mt-1 text-sm font-medium">
                                    {{ $user->last_name ?? '-' }}
                                </p>
                            </div>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                {{ __('Email') }}
                            </p>
                            <p class="mt-1 text-sm font-medium">
                                {{ $user->email }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                {{ __('Email Verified') }}
                            </p>
                            <p class="mt-1 flex items-center gap-2">
                                @if ($user->email_verified_at)
                                    <flux:icon.check-circle class="size-4 text-green-600 dark:text-green-400"/>
                                    <span class="text-sm font-medium">
                                        {{ $user->email_verified_at->format('M d, Y H:i') }}
                                    </span>
                                @else
                                    <flux:icon.x-circle class="size-4 text-neutral-400"/>
                                    <span class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                                        {{ __('Not verified') }}
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div>
                </flux:card>

                <flux:card>
                    <form wire:submit="save" class="space-y-6">
                        <!-- Password Field -->
                        <div>
                            <flux:input
                                wire:model="password"
                                label="{{ __('New Password') }}"
                                type="password"
                                placeholder="{{ __('Enter new password (min 8 characters)') }}"
                                required
                            />
                            @error('password')
                                <span class="mt-2 block text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Password Confirmation Field -->
                        <div>
                            <flux:input
                                wire:model="password_confirmation"
                                label="{{ __('Confirm Password') }}"
                                type="password"
                                placeholder="{{ __('Confirm new password') }}"
                                required
                            />
                            @error('password_confirmation')
                                <span class="mt-2 block text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="flex gap-2 pt-4">
                            <flux:button type="submit" variant="primary">
                                {{ __('Update Password') }}
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
                            <p class="font-semibold text-neutral-900 dark:text-neutral-100">{{ __('Password') }}</p>
                            <p class="mt-1 text-neutral-600 dark:text-neutral-400">
                                {{ __('Minimum 8 characters, must match confirmation') }}
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
