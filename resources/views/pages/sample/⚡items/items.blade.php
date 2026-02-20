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

            <flux:dropdown position="bottom" align="end">
                <flux:button icon="view-columns" icon:trailing="chevron-down">
                    {{ __('Columns') }}
                </flux:button>

                <flux:menu keep-open>
                    @foreach ($columns as $key => $enabled)
                        <flux:menu.checkbox
                            wire:model.live="columns.{{ $key }}"
                            :checked="$enabled"
                            keep-open
                        >
                            {{ __($columnLabels[$key] ?? $key) }}
                        </flux:menu.checkbox>
                    @endforeach
                </flux:menu>
            </flux:dropdown>
        </div>

        <!-- Items Table -->
        <div class="relative overflow-hidden rounded-lg border border-neutral-200 dark:border-neutral-700">
            <!-- Loading Spinner -->
            <div wire:loading.delay.shortest wire:target="gotoPage,nextPage,previousPage,search,columns" style="min-height: 400px;" class="absolute inset-0 z-10 flex items-center justify-center bg-white/50 dark:bg-neutral-900/50 backdrop-blur-sm rounded-lg">
                <div class="flex flex-col items-center justify-center gap-3 mt-3">
                    <div class="size-10 animate-spin rounded-full border-4 border-neutral-200 border-t-blue-500 dark:border-neutral-700 dark:border-t-blue-400"></div>
                    <span class="text-sm font-medium text-neutral-700 dark:text-neutral-300">{{ __('Loading...') }}</span>
                </div>
            </div>

            <flux:table>
                <flux:table.columns>
                    <flux:table.column sortable :sorted="$sortField === 'id'" :direction="$sortDirection" wire:click="updateSort('id')" style="padding-left: 12px !important;">{{ __('#') }}</flux:table.column>

                    @foreach ($columns as $key => $enabled)
                        @if ($enabled)
                            @if ($key === 'user_id')
                                <flux:table.column>{{ __($columnLabels[$key] ?? 'User') }}</flux:table.column>
                            @else
                                <flux:table.column sortable :sorted="$sortField === $key" :direction="$sortDirection" wire:click="updateSort('{{ $key }}')">
                                    {{ __($columnLabels[$key] ?? $key) }}
                                </flux:table.column>
                            @endif
                        @endif
                    @endforeach
                    <flux:table.column align="end" style="padding-right: 12px !important;">{{ __('Actions') }}</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @forelse ($items as $item)
                        <flux:table.row>
                            <flux:table.cell style="padding-left: 12px !important;">
                                {{ $items->firstItem() + $loop->index }}
                            </flux:table.cell>

                            @foreach ($columns as $key => $enabled)
                                @if ($enabled)
                                    @if ($key === 'user_id')
                                        <flux:table.cell>
                                            <span class="text-sm text-neutral-600 dark:text-neutral-400">
                                                {{ $item->user?->name ?? '-' }}
                                            </span>
                                        </flux:table.cell>
                                    @elseif ($key === 'boolean')
                                        <flux:table.cell>
                                            <span class="text-sm text-neutral-600 dark:text-neutral-400">
                                                {{ is_null($item->boolean) ? '-' : ($item->boolean ? __('Yes') : __('No')) }}
                                            </span>
                                        </flux:table.cell>
                                    @elseif ($key === 'file')
                                        <flux:table.cell>
                                            <span class="text-sm text-neutral-600 dark:text-neutral-400">
                                                {{ $item->file ? basename($item->file) : '-' }}
                                            </span>
                                        </flux:table.cell>
                                    @elseif ($key === 'image')
                                        <flux:table.cell>
                                            <span class="text-sm text-neutral-600 dark:text-neutral-400">
                                                {{ $item->image ? basename($item->image) : '-' }}
                                            </span>
                                        </flux:table.cell>
                                    @elseif ($key === 'datetime')
                                        <flux:table.cell>
                                            <span class="text-sm text-neutral-600 dark:text-neutral-400">
                                                {{ $item->datetime?->format('M d, Y H:i') ?? '-' }}
                                            </span>
                                        </flux:table.cell>
                                    @elseif ($key === 'date')
                                        <flux:table.cell>
                                            <span class="text-sm text-neutral-600 dark:text-neutral-400">
                                                {{ $item->date?->format('M d, Y') ?? '-' }}
                                            </span>
                                        </flux:table.cell>
                                    @elseif ($key === 'time')
                                        <flux:table.cell>
                                            <span class="text-sm text-neutral-600 dark:text-neutral-400">
                                                {{ $item->time?->format('H:i') ?? '-' }}
                                            </span>
                                        </flux:table.cell>
                                    @elseif ($key === 'created_at')
                                        <flux:table.cell>
                                            <span class="text-sm text-neutral-600 dark:text-neutral-400">
                                                {{ $item->created_at?->format('M d, Y') ?? '-' }}
                                            </span>
                                        </flux:table.cell>
                                    @else
                                        <flux:table.cell>
                                            <span class="text-sm text-neutral-600 dark:text-neutral-400">
                                                {{ $item->{$key} ?? '-' }}
                                            </span>
                                        </flux:table.cell>
                                    @endif
                                @endif
                            @endforeach
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
                            <flux:table.cell colspan="{{ 2 + count(array_filter($columns)) }}" class="py-8 text-center">
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
