<section>
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight">{{ __('Roles') }}</h1>
                <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">
                    {{ __('Manage system roles and permissions') }}
                </p>
            </div>
            <flux:button href="{{-- route('role.create') --}}" icon="plus">
                {{ __('Create Role') }}
            </flux:button>
        </div>

        <!-- Search Bar and Filters -->
        <div class="flex gap-2">
            <flux:input
                wire:model.live.debounce.500ms="search"
                type="text"
                placeholder="{{ __('Search roles...') }}"
                icon="magnifying-glass"
                class="flex-1"
                clearable
                @clear="resetSearch"
            />
            <flux:select
                wire:model.live="guardName"
                placeholder="{{ __('All Guards') }}"
                class="w-48"
            >
                <flux:select.option value="">{{ __('All Guards') }}</flux:select.option>
                @foreach($this->guards as $guard)
                    <flux:select.option value="{{ $guard->value }}">{{ $guard->label() }}</flux:select.option>
                @endforeach
            </flux:select>
        </div>

        <!-- Roles Table -->
        <div class="relative overflow-hidden rounded-lg border border-neutral-200 dark:border-neutral-700">
            <!-- Loading Spinner -->
            <div wire:loading.delay.shortest wire:target="gotoPage,nextPage,previousPage,search,guardName,updateSort" style="min-height: 400px;"
                 class="absolute inset-0 z-10 flex items-center justify-center bg-white/50 dark:bg-neutral-900/50 backdrop-blur-sm rounded-lg">
                <div class="flex flex-col items-center justify-center gap-3 mt-3">
                    <div class="size-10 animate-spin rounded-full border-4 border-neutral-200 border-t-blue-500 dark:border-neutral-700 dark:border-t-blue-400"></div>
                    <span class="text-sm font-medium text-neutral-700 dark:text-neutral-300">{{ __('Loading...') }}</span>
                </div>
            </div>
            <flux:table>
                <flux:table.columns>
                    <flux:table.column sortable :sorted="$sortField === 'id'" :direction="$sortDirection" wire:click="updateSort('id')" style="padding-left: 12px !important;">{{ __('#') }}</flux:table.column>
                    <flux:table.column sortable :sorted="$sortField === 'name'" :direction="$sortDirection" wire:click="updateSort('name')">{{ __('Name') }}</flux:table.column>
                    <flux:table.column sortable :sorted="$sortField === 'guard_name'" :direction="$sortDirection" wire:click="updateSort('guard_name')">{{ __('Guard') }}</flux:table.column>
                    <flux:table.column sortable :sorted="$sortField === 'created_at'" :direction="$sortDirection" wire:click="updateSort('created_at')">{{ __('Created') }}</flux:table.column>
                    <flux:table.column align="end"
                                       style="padding-right: 12px !important;">{{ __('Actions') }}</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @forelse ($roles as $role)
                        <flux:table.row>
                            <flux:table.cell style="padding-left: 12px !important;">
                                {{ $roles->firstItem() + $loop->index }}
                            </flux:table.cell>
                            <flux:table.cell>
                                <span class="font-medium">{{ $role->name }}</span>
                            </flux:table.cell>
                            <flux:table.cell>
                                <span class="text-sm text-neutral-600 dark:text-neutral-400">
                                    {{ $role->guard_name }}
                                </span>
                            </flux:table.cell>
                            <flux:table.cell>
                                <span class="text-sm text-neutral-600 dark:text-neutral-400">
                                    {{ $role->created_at?->format('M d, Y') ?? '-' }}
                                </span>
                            </flux:table.cell>
                            <flux:table.cell align="end" style="padding-right: 12px !important;">
                                <div class="flex items-center justify-end gap-2">
                                    <flux:dropdown>
                                        <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal"/>

                                        <flux:menu>
                                            <flux:menu.item
                                                href="{{ route('rbac.role.show', $role) }}"
                                                icon="eye"
                                                wire:navigate
                                            >
                                                {{ __('View') }}
                                            </flux:menu.item>
                                            <flux:menu.item
                                                href="{{-- route('rbac.role.edit', $role) --}}"
                                                icon="pencil"
                                            >
                                                {{ __('Edit') }}
                                            </flux:menu.item>
                                            <flux:menu.item
                                                wire:click="delete({{ $role->id }})"
                                                wire:confirm="{{ __('Are you sure you want to delete this role?') }}"
                                                variant="danger"
                                                icon="trash"
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
                                        {{ __('No roles found') }}
                                    </p>
                                </div>
                            </flux:table.cell>
                        </flux:table.row>
                    @endforelse
                </flux:table.rows>
            </flux:table>
        </div>

        <!-- Pagination -->
        {{ $roles->links() }}

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
