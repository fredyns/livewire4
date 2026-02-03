<section>
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-4">
                @if ($user->hasProfilePicture())
                    <img
                        src="{{ $user->profilePictureUrl() }}"
                        alt="{{ $user->name }}"
                        class="size-16 rounded-full object-cover"
                    />
                @else
                    <div
                        class="flex size-16 items-center justify-center rounded-full bg-gradient-to-br from-blue-400 to-blue-600">
                        <span class="text-lg font-semibold text-white">
                            {{ $user->initials() }}
                        </span>
                    </div>
                @endif
                <div>
                    <h1 class="text-3xl font-bold tracking-tight">{{ $user->name }}</h1>
                    <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                        {{ $user->email }}
                    </p>
                </div>
            </div>
            <div class="flex gap-2">
                <flux:button href="{{ route('user.edit', $user) }}" variant="primary" icon="pencil">
                    {{ __('Edit') }}
                </flux:button>
                <flux:button href="{{ route('user.index') }}" variant="ghost" icon="arrow-left">
                    {{ __('Back') }}
                </flux:button>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid gap-6 lg:grid-cols-3">
            <!-- Main Content -->
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

                <!-- Roles & Permissions -->
                <flux:card>
                    <flux:heading size="lg" level="2">{{ __('Web Roles') }}</flux:heading>

                    <div class="mt-6">
                        @if ($this->webRoles->count() > 0)
                            <div class="flex flex-wrap gap-2">
                                @foreach ($this->webRoles as $role)
                                    <flux:badge size="lg" color="blue">
                                        {{ $role->name }}
                                    </flux:badge>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-neutral-600 dark:text-neutral-400">
                                {{ __('No roles assigned') }}
                            </p>
                        @endif
                    </div>
                </flux:card>

                <flux:card>
                    <flux:heading size="lg" level="2">{{ __('API Roles') }}</flux:heading>

                    <div class="mt-6">
                        @if ($this->apiRoles->count() > 0)
                            <div class="flex flex-wrap gap-2">
                                @foreach ($this->apiRoles as $role)
                                    <flux:badge size="lg" color="blue">
                                        {{ $role->name }}
                                    </flux:badge>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-neutral-600 dark:text-neutral-400">
                                {{ __('No roles assigned') }}
                            </p>
                        @endif
                    </div>
                </flux:card>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Account Status -->
                <flux:card>
                    <flux:heading size="lg" level="2">{{ __('Account Status') }}</flux:heading>

                    <div class="mt-6 space-y-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                {{ __('Status') }}
                            </p>
                            <p class="mt-2 flex items-center gap-2">
                                <span class="inline-flex size-2 rounded-full bg-green-600"></span>
                                <span class="text-sm font-medium">{{ __('Active') }}</span>
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                {{ __('Member Since') }}
                            </p>
                            <p class="mt-1 text-sm font-medium">
                                {{ $user->created_at?->format('M d, Y') ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-neutral-600 dark:text-neutral-400">
                                {{ __('Last Updated') }}
                            </p>
                            <p class="mt-1 text-sm font-medium">
                                {{ $user->updated_at?->format('M d, Y H:i') ?? '-' }}
                            </p>
                        </div>
                    </div>
                </flux:card>

                <!-- Actions -->
                <flux:card>
                    <flux:heading size="lg" level="2">{{ __('Actions') }}</flux:heading>

                    <div class="mt-6 space-y-2">
                        <flux:button href="{{ route('user.assign', $user) }}" variant="ghost" class="w-full">
                            {{ __('Assign Roles') }}
                        </flux:button>
                        <flux:button href="{{ route('user.edit', $user) }}" variant="primary" class="w-full">
                            {{ __('Edit User') }}
                        </flux:button>
                        <flux:button href="{{ route('user.change-password', $user) }}" variant="ghost" class="w-full">
                            {{ __('Change Password') }}
                        </flux:button>
                    </div>
                </flux:card>
            </div>
        </div>
    </div>
</section>
