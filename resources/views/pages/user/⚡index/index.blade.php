<section>
    <style>
        .flex.items-center.justify-between > div > nav {
            margin-left: 1rem;
        }
    </style>
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight">{{ __('Users') }}</h1>
                <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">
                    {{ __('Manage and view all users in the system') }}
                </p>
            </div>
            <flux:button href="{{-- route('user.create') --}}" icon="plus">
                {{ __('Add User') }}
            </flux:button>
        </div>

        <!-- Search Bar -->
        <div class="flex gap-2">
            <flux:input
                wire:model.live.debounce.500ms="search"
                type="text"
                placeholder="{{ __('Search users...') }}"
                icon="magnifying-glass"
                class="flex-1"
            />
            @if ($this->search)
                <flux:button
                    wire:click="resetSearch"
                    variant="ghost"
                    icon="x-mark"
                >
                    {{ __('Clear') }}
                </flux:button>
            @endif
        </div>

        <!-- Users Table -->
        <div class="overflow-hidden rounded-lg border border-neutral-200 dark:border-neutral-700">
            <flux:table>
                <flux:table.columns>
                    <flux:table.column style="padding-left: 12px !important;">{{ __('Name') }}</flux:table.column>
                    <flux:table.column>{{ __('Email') }}</flux:table.column>
                    <flux:table.column>{{ __('Roles') }}</flux:table.column>
                    <flux:table.column>{{ __('Created') }}</flux:table.column>
                    <flux:table.column align="end" style="padding-right: 12px !important;">{{ __('Actions') }}</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @forelse ($users as $user)
                        <flux:table.row>
                            <flux:table.cell style="padding-left: 12px !important;">
                                <div class="flex items-center gap-3">
                                    @if ($user->hasProfilePicture())
                                        <img
                                            src="{{ $user->profilePictureThumbnailUrl() }}"
                                            alt="{{ $user->name }}"
                                            class="size-8 rounded-full object-cover"
                                        />
                                    @else
                                        <div
                                            class="flex size-8 items-center justify-center rounded-full bg-gradient-to-br from-blue-400 to-blue-600">
                                            <span class="text-xs font-semibold text-white">
                                                {{ $user->initials() }}
                                            </span>
                                        </div>
                                    @endif
                                    <div class="flex flex-col">
                                        <span class="font-medium">{{ $user->name }}</span>
                                    </div>
                                </div>
                            </flux:table.cell>
                            <flux:table.cell>
                                <span class="text-sm text-neutral-600 dark:text-neutral-400">
                                    {{ $user->email }}
                                </span>
                            </flux:table.cell>
                            <flux:table.cell>
                                <div class="flex flex-wrap gap-1">
                                    @forelse ($user->webRoles as $role)
                                        <flux:badge size="sm" color="blue">
                                            {{ $role->name }}
                                        </flux:badge>
                                    @empty
                                        <span class="text-xs text-neutral-500 dark:text-neutral-400">
                                            {{ __('No roles') }}
                                        </span>
                                    @endforelse
                                </div>
                            </flux:table.cell>
                            <flux:table.cell>
                                <span class="text-sm text-neutral-600 dark:text-neutral-400">
                                    {{ $user->created_at?->format('M d, Y') ?? '-' }}
                                </span>
                            </flux:table.cell>
                            <flux:table.cell align="end" style="padding-right: 12px !important;">
                                <div class="flex items-center justify-end gap-2">
                                    <flux:button
                                        href="{{-- route('user.show', $user) --}}"
                                        variant="ghost"
                                        size="sm"
                                        icon="eye"
                                    >
                                        {{ __('View') }}
                                    </flux:button>
                                    <flux:button
                                        href="{{-- route('user.edit', $user) --}}"
                                        variant="ghost"
                                        size="sm"
                                        icon="pencil"
                                    >
                                        {{ __('Edit') }}
                                    </flux:button>
                                    <flux:dropdown>
                                        <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal"/>

                                        <flux:menu>
                                            <flux:menu.item
                                                wire:click="delete({{ $user->id }})"
                                                wire:confirm="{{ __('Are you sure you want to delete this user?') }}"
                                                variant="danger"
                                            >
                                                {{ __('Delete') }}
                                            </flux:menu.item>
                                        </flux:menu>
                                    </flux:dropdown>
                                </div>
                            </flux:table.cell>
                        </flux:table.row>
                    @empty
                        <flux:table.row>
                            <flux:table.cell colspan="5" class="py-8 text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <flux:icon.inbox-stack class="size-8 text-neutral-400"/>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-400">
                                        {{ __('No users found') }}
                                    </p>
                                </div>
                            </flux:table.cell>
                        </flux:table.row>
                    @endforelse
                </flux:table.rows>
            </flux:table>
        </div>

        <!-- Pagination -->
        {{ $users->links() }}

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
