<section>
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight">{{ __('Sample Items') }}</h1>
                <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">
                    {{ __('Manage and view sample items') }}
                </p>
            </div>
            <flux:button href="{{ route('sample.item.create') }}" icon="plus" wire:navigate>
                {{ __('Add Item') }}
            </flux:button>
        </div>

        <!-- Search Bar -->
        <div class="flex gap-2">
            <flux:input
                wire:model.live.debounce.500ms="search"
                type="text"
                placeholder="{{ __('Search items...') }}"
                icon="magnifying-glass"
                class="flex-1"
                clearable
                @clear="resetSearch"
            />
        </div>

        <!-- Items Table -->
        <div class="relative overflow-hidden rounded-lg border border-neutral-200 dark:border-neutral-700">
            <!-- Loading Spinner -->
            <div wire:loading.delay.shortest wire:target="gotoPage,nextPage,previousPage,search,updateSort" style="min-height: 400px;" class="absolute inset-0 z-10 flex items-center justify-center bg-white/50 dark:bg-neutral-900/50 backdrop-blur-sm rounded-lg">
                <div class="flex flex-col items-center justify-center gap-3 mt-3">
                    <div class="size-10 animate-spin rounded-full border-4 border-neutral-200 border-t-blue-500 dark:border-neutral-700 dark:border-t-blue-400"></div>
                    <span class="text-sm font-medium text-neutral-700 dark:text-neutral-300">{{ __('Loading...') }}</span>
                </div>
            </div>

            <flux:table>
                <flux:table.columns>
                    <flux:table.column sortable :sorted="$sortField === 'id'" :direction="$sortDirection" wire:click="updateSort('id')" style="padding-left: 12px !important;">{{ __('#') }}</flux:table.column>
                    <flux:table.column sortable :sorted="$sortField === 'string'" :direction="$sortDirection" wire:click="updateSort('string')">{{ __('String') }}</flux:table.column>
                    <flux:table.column sortable :sorted="$sortField === 'email'" :direction="$sortDirection" wire:click="updateSort('email')">{{ __('Email') }}</flux:table.column>
                    <flux:table.column>{{ __('User') }}</flux:table.column>
                    <flux:table.column sortable :sorted="$sortField === 'created_at'" :direction="$sortDirection" wire:click="updateSort('created_at')">{{ __('Created') }}</flux:table.column>
                    <flux:table.column align="end" style="padding-right: 12px !important;">{{ __('Actions') }}</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @forelse ($items as $item)
                        <flux:table.row>
                            <flux:table.cell style="padding-left: 12px !important;">
                                {{ $items->firstItem() + $loop->index }}
                            </flux:table.cell>
                            <flux:table.cell>
                                <span class="font-medium">{{ $item->string }}</span>
                            </flux:table.cell>
                            <flux:table.cell>
                                <span class="text-sm text-neutral-600 dark:text-neutral-400">
                                    {{ $item->email ?? '-' }}
                                </span>
                            </flux:table.cell>
                            <flux:table.cell>
                                <span class="text-sm text-neutral-600 dark:text-neutral-400">
                                    {{ $item->user?->name ?? '-' }}
                                </span>
                            </flux:table.cell>
                            <flux:table.cell>
                                <span class="text-sm text-neutral-600 dark:text-neutral-400">
                                    {{ $item->created_at?->format('M d, Y') ?? '-' }}
                                </span>
                            </flux:table.cell>
                            <flux:table.cell align="end" style="padding-right: 12px !important;">
                                <div class="flex items-center justify-end gap-2">
                                    <flux:dropdown>
                                        <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal"/>

                                        <flux:menu>
                                            <flux:menu.item
                                                href="{{ route('sample.item.show', $item) }}"
                                                icon="eye"
                                                wire:navigate
                                            >
                                                {{ __('View') }}
                                            </flux:menu.item>
                                            <flux:menu.item
                                                href="{{ route('sample.item.edit', $item) }}"
                                                icon="pencil"
                                                wire:navigate
                                            >
                                                {{ __('Edit') }}
                                            </flux:menu.item>
                                            <flux:menu.item
                                                wire:click="delete('{{ $item->id }}')"
                                                wire:confirm="{{ __('Are you sure you want to delete this item?') }}"
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
                            <flux:table.cell colspan="6" class="py-8 text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <flux:icon.inbox-stack class="size-8 text-neutral-400"/>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-400">
                                        {{ __('No items found') }}
                                    </p>
                                </div>
                            </flux:table.cell>
                        </flux:table.row>
                    @endforelse
                </flux:table.rows>
            </flux:table>
        </div>

        <!-- Pagination -->
        {{ $items->links() }}

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
