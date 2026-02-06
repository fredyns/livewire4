<div class="flex flex-col gap-6">
    <x-auth-header
        :title="__('Login as User')"
        :description="__('Select a user to login with their account (Dev only)')"
    />

    <div class="flex flex-col gap-4">
        <flux:input
            wire:model.live.debounce.500ms="search"
            :label="__('Search users')"
            type="text"
            placeholder="{{ __('Search by email or name...') }}"
            icon="magnifying-glass"
            clearable
            @clear="resetSearch"
        />

        <div class="space-y-2 max-h-96 overflow-y-auto">
            @forelse ($users as $user)
                <button
                    type="button"
                    wire:click="loginAs(@js($user->getKey()))"
                    class="w-full text-left px-4 py-3 rounded-lg border border-zinc-200 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-900 hover:cursor-pointer transition-colors"
                    wire:loading.attr="disabled"
                    wire:target="loginAs"
                >
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex-1">
                            <div class="font-medium text-zinc-900 dark:text-zinc-100">
                                <span>
                                    {{ $user->name }}
                                </span>
                            </div>
                            <div class="text-sm text-zinc-900 dark:text-zinc-100">
                                <span>
                                    &lt;{{ $user->email }}&gt;
                                </span>
                            </div>

                            @if ($user->webRoles->count() > 0)
                                <div class="flex flex-wrap gap-1 mt-2">
                                    @foreach ($user->webRoles as $role)
                                        <flux:badge size="sm" color="blue">{{ $role->name }}</flux:badge>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-xs text-zinc-500 dark:text-zinc-500 mt-2">
                                    {{ __('No roles assigned') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </button>
            @empty
                <div class="text-center py-8 text-zinc-600 dark:text-zinc-400">
                    {{ __('No users found') }}
                </div>
            @endforelse
        </div>

        {{ $users->links() }}
    </div>
</div>
