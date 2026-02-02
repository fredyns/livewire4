<section>
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight">{{ __('Assign Roles') }}</h1>
                <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">
                    {{ __('Manage roles for :name', ['name' => $user->name]) }}
                </p>
            </div>
            <div class="flex gap-2">
                <flux:button href="{{ route('user.show', $user) }}" variant="ghost" icon="arrow-left">
                    {{ __('Back') }}
                </flux:button>
            </div>
        </div>

        <div class="flex gap-2">
            <flux:input
                wire:model.live.debounce.300ms="search"
                type="text"
                placeholder="{{ __('Search roles...') }}"
                icon="magnifying-glass"
                class="flex-1"
                clearable
            />
        </div>

        <div class="relative overflow-hidden rounded-lg border border-neutral-200 dark:border-neutral-700">
            <flux:table>
                <flux:table.columns>
                    <flux:table.column style="padding-left: 12px !important;">{{ __('Role') }}</flux:table.column>
                    <flux:table.column>{{ __('Guard') }}</flux:table.column>
                    <flux:table.column align="end" style="padding-right: 12px !important;">{{ __('Action') }}</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @forelse ($this->availableRoles as $role)
                        @php($isAssigned = in_array($role->id, $this->assignedRoleIds, true))

                        <flux:table.row>
                            <flux:table.cell style="padding-left: 12px !important;">
                                <div class="flex items-center gap-2">
                                    <span class="font-medium">{{ $role->name }}</span>
                                    @if ($isAssigned)
                                        <flux:badge size="sm" color="green">{{ __('Assigned') }}</flux:badge>
                                    @endif
                                </div>
                            </flux:table.cell>

                            <flux:table.cell>
                                <span class="text-sm text-neutral-600 dark:text-neutral-400">
                                    {{ $role->guard_name }}
                                </span>
                            </flux:table.cell>

                            <flux:table.cell align="end" style="padding-right: 12px !important;">
                                @if ($isAssigned)
                                    <flux:button
                                        wire:click="revokeRole('{{ $role->id }}')"
                                        variant="danger"
                                        size="sm"
                                    >
                                        {{ __('Revoke') }}
                                    </flux:button>
                                @else
                                    <flux:button
                                        wire:click="assignRole('{{ $role->id }}')"
                                        variant="primary"
                                        size="sm"
                                    >
                                        {{ __('Assign') }}
                                    </flux:button>
                                @endif
                            </flux:table.cell>
                        </flux:table.row>
                    @empty
                        <flux:table.row>
                            <flux:table.cell colspan="3" class="py-8 text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <flux:icon.inbox-stack class="size-8 text-neutral-400"/>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-400">
                                        {{ __('No roles found') }}
                                    </p>
                                </div>
                            </flux:table.cell>
                        </flux:table.row>
                    @endforelse
                </flux:table.rows>
            </flux:table>
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
