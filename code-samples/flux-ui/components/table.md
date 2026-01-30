# Table

Source: https://fluxui.dev/components/table

Display structured data in a condensed, searchable format.

## Basic Example

```blade
<flux:table :paginate="$this->orders">
    <flux:table.columns>
        <flux:table.column>Customer</flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'date'" :direction="$sortDirection" wire:click="sort('date')">Date</flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'status'" :direction="$sortDirection" wire:click="sort('status')">Status</flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'amount'" :direction="$sortDirection" wire:click="sort('amount')">Amount</flux:table.column>
    </flux:table.columns>
    <flux:table.rows>
        @foreach ($this->orders as $order)
            <flux:table.row :key="$order->id">
                <flux:table.cell class="flex items-center gap-3">
                    <flux:avatar size="xs" src="{{ $order->customer_avatar }}" />
                    {{ $order->customer }}
                </flux:table.cell>
                <flux:table.cell class="whitespace-nowrap">{{ $order->date }}</flux:table.cell>
                <flux:table.cell>
                    <flux:badge size="sm" :color="$order->status_color" inset="top bottom">{{ $order->status }}</flux:badge>
                </flux:table.cell>
                <flux:table.cell variant="strong">{{ $order->amount }}</flux:table.cell>
                <flux:table.cell>
                    <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" inset="top bottom"></flux:button>
                </flux:table.cell>
            </flux:table.row>
        @endforeach
    </flux:table.rows>
</flux:table>
```

## Simple

```blade
<flux:table>
    <flux:table.columns>
        <flux:table.column>Customer</flux:table.column>
        <flux:table.column>Date</flux:table.column>
        <flux:table.column>Status</flux:table.column>
        <flux:table.column>Amount</flux:table.column>
    </flux:table.columns>
    <flux:table.rows>
        <flux:table.row>
            <flux:table.cell>Lindsey Aminoff</flux:table.cell>
            <flux:table.cell>Jul 29, 10:45 AM</flux:table.cell>
            <flux:table.cell><flux:badge color="green" size="sm" inset="top bottom">Paid</flux:badge></flux:table.cell>
            <flux:table.cell variant="strong">$49.00</flux:table.cell>
        </flux:table.row>
        <flux:table.row>
            <flux:table.cell>Hanna Lubin</flux:table.cell>
            <flux:table.cell>Jul 28, 2:15 PM</flux:table.cell>
            <flux:table.cell><flux:badge color="green" size="sm" inset="top bottom">Paid</flux:badge></flux:table.cell>
            <flux:table.cell variant="strong">$312.00</flux:table.cell>
        </flux:table.row>
        <flux:table.row>
            <flux:table.cell>Kianna Bushevi</flux:table.cell>
            <flux:table.cell>Jul 30, 4:05 PM</flux:table.cell>
            <flux:table.cell><flux:badge color="zinc" size="sm" inset="top bottom">Refunded</flux:badge></flux:table.cell>
            <flux:table.cell variant="strong">$132.00</flux:table.cell>
        </flux:table.row>
        <flux:table.row>
            <flux:table.cell>Gustavo Geidt</flux:table.cell>
            <flux:table.cell>Jul 27, 9:30 AM</flux:table.cell>
            <flux:table.cell><flux:badge color="green" size="sm" inset="top bottom">Paid</flux:badge></flux:table.cell>
            <flux:table.cell variant="strong">$31.00</flux:table.cell>
        </flux:table.row>
    </flux:table.rows>
</flux:table>
```

## Pagination

```blade
<!-- $orders = \App\Models\Order::paginate(5) -->
<flux:table :paginate="$orders">
    <!-- ... -->
</flux:table>
```

## Sortable

```blade
<flux:table>
    <flux:table.columns>
        <flux:table.column>Customer</flux:table.column>
        <flux:table.column sortable sorted direction="desc">Date</flux:table.column>
        <flux:table.column sortable>Amount</flux:table.column>
    </flux:table.columns>
    <!-- ... -->
</flux:table>
```

## Sticky header

```blade
<!-- Set the height of the table container... -->
<flux:table container:class="max-h-80">
    <flux:table.columns sticky class="bg-white dark:bg-zinc-900">
        <!-- ... -->
    </flux:table.columns>
    <!-- ... -->
</flux:table>
```

## Sticky columns

```blade
<flux:table container:class="max-h-80">
    <flux:table.columns sticky class="bg-white dark:bg-zinc-900">
        <flux:table.column sticky class="bg-white dark:bg-zinc-900">ID</flux:table.column>
        <!-- ... -->
    </flux:table.columns>
    <flux:table.rows>
        @foreach ($this->orders as $order)
            <flux:table.row :key="$order->id">
                <flux:table.cell sticky class="bg-white dark:bg-zinc-900">{{ $order->id }}</flux:table.cell>
                <!-- ... -->
            </flux:table.row>
        @endforeach
    </flux:table.rows>
</flux:table>
```

## Reference

### `flux:table`

| Prop | Description |
| --- | --- |
| paginate | A Laravel paginator instance to enable pagination. |
| container:class | Additional CSS classes applied to the container. Useful for setting height constraints like max-h-80. |

| Slot | Description |
| --- | --- |
| default | The table columns and rows. |

### `flux:table.columns`

| Prop | Description |
| --- | --- |
| sticky | When present, makes the header row sticky when scrolling. |

| Slot | Description |
| --- | --- |
| default | The table column headers. |

### `flux:table.column`

| Prop | Description |
| --- | --- |
| align | Alignment of the column content. Options: start, center, end. |
| sortable | Enables sorting functionality for the column. |
| sorted | Indicates this column is currently being sorted. |
| direction | Sort direction when column is sorted. Options: asc, desc. |
| sticky | When present, makes the column sticky when scrolling. |

| Slot | Description |
| --- | --- |
| default | The column header content. |

### `flux:table.rows`

| Slot | Description |
| --- | --- |
| default | The table rows. |

### `flux:table.row`

| Slot | Description |
| --- | --- |
| default | The table cells for this row. |

### `flux:table.cell`

| Prop | Description |
| --- | --- |
| align | Alignment of the cell content. Options: start, center, end. |
| variant | Visual style of the cell. Options: default, strong. |
| sticky | When present, makes the cell sticky when scrolling. |
