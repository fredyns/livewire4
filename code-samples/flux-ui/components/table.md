# Table

Source: https://fluxui.dev/components/table

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> :paginate</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"$this->orders"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.columns</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.column</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Customer</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.column</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.column</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> sortable</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> :sorted</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"$sortBy === 'date'"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> :direction</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"$sortDirection"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:click</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"sort('date')"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Date</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.column</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.column</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> sortable</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> :sorted</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"$sortBy === 'status'"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> :direction</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"$sortDirection"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:click</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"sort('status')"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Status</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.column</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.column</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> sortable</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> :sorted</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"$sortBy === 'amount'"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> :direction</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"$sortDirection"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:click</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"sort('amount')"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Amount</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.column</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.columns</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.rows</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        @foreach </span><span style="color:#424258;--shiki-dark:#EEFFFF">($this</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">-></span><span style="color:#424258;--shiki-dark:#EEFFFF">orders</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> as </span><span style="color:#424258;--shiki-dark:#EEFFFF">$order)</span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.row</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> :key</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"$order->id"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">                <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.cell</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> class</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"flex items-center gap-3"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">                    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:avatar</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> size</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"xs"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> src</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"</span><span style="color:#D050A3;--shiki-dark:#75FFC7">{{</span><span style="color:#424258;--shiki-dark:#EEFFFF"> $order</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">-></span><span style="color:#424258;--shiki-dark:#EEFFFF">customer_avatar</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> }}</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"></span><span class="line"><span style="color:#D050A3;--shiki-dark:#75FFC7">                    {{</span><span style="color:#424258;--shiki-dark:#EEFFFF"> $order</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">-></span><span style="color:#424258;--shiki-dark:#EEFFFF">customer</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> }}</span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">                </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.cell</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">                <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.cell</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> class</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"whitespace-nowrap"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#D050A3;--shiki-dark:#75FFC7">{{</span><span style="color:#424258;--shiki-dark:#EEFFFF"> $order</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">-></span><span style="color:#424258;--shiki-dark:#EEFFFF">date</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> }}</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.cell</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">                <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.cell</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">                    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:badge</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> size</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"sm"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> :color</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"$order->status_color"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> inset</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"top bottom"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#D050A3;--shiki-dark:#75FFC7">{{</span><span style="color:#424258;--shiki-dark:#EEFFFF"> $order</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">-></span><span style="color:#424258;--shiki-dark:#EEFFFF">status</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> }}</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:badge</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">                </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.cell</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">                <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.cell</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> variant</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"strong"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#D050A3;--shiki-dark:#75FFC7">{{</span><span style="color:#424258;--shiki-dark:#EEFFFF"> $order</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">-></span><span style="color:#424258;--shiki-dark:#EEFFFF">amount</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> }}</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.cell</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">                <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.cell</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">                    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:button</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> variant</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"ghost"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> size</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"sm"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> icon</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"ellipsis-horizontal"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> inset</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"top bottom"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:button</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">                </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.cell</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.row</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        @endforeach</span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table.rows</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:table</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"></span><span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic"><!-- Livewire component example code...</span></span><span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic">    use \Livewire\WithPagination;</span></span><span class="line"></span><span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic">    public $sortBy = 'date';</span></span><span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic">    public $sortDirection = 'desc';</span></span><span class="line"></span><span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic">    public function sort($column) {</span></span><span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic">        if ($this->sortBy === $column) {</span></span><span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic">            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';</span></span><span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic">        } else {</span></span><span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic">            $this->sortBy = $column;</span></span><span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic">            $this->sortDirection = 'asc';</span></span><span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic">        }</span></span><span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic">    }</span></span><span class="line"></span><span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic">    #[\Livewire\Attributes\Computed]</span></span><span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic">    public function orders()</span></span><span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic">    {</span></span><span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic">        return \App\Models\Order::query()</span></span><span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic">            ->tap(fn ($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)</span></span><span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic">            ->paginate(5);</span></span><span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic">    }</span></span><span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic">--></span></span>
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
            <flux:table.cell>
                <flux:badge color="green" size="sm" inset="top bottom">Paid</flux:badge>
            </flux:table.cell>
            <flux:table.cell variant="strong">$49.00</flux:table.cell>
        </flux:table.row>

        <flux:table.row>
            <flux:table.cell>Hanna Lubin</flux:table.cell>
            <flux:table.cell>Jul 28, 2:15 PM</flux:table.cell>
            <flux:table.cell>
                <flux:badge color="green" size="sm" inset="top bottom">Paid</flux:badge>
            </flux:table.cell>
            <flux:table.cell variant="strong">$312.00</flux:table.cell>
        </flux:table.row>

        <flux:table.row>
            <flux:table.cell>Kianna Bushevi</flux:table.cell>
            <flux:table.cell>Jul 30, 4:05 PM</flux:table.cell>
            <flux:table.cell>
                <flux:badge color="zinc" size="sm" inset="top bottom">Refunded</flux:badge>
            </flux:table.cell>
            <flux:table.cell variant="strong">$132.00</flux:table.cell>
        </flux:table.row>

        <flux:table.row>
            <flux:table.cell>Gustavo Geidt</flux:table.cell>
            <flux:table.cell>Jul 27, 9:30 AM</flux:table.cell>
            <flux:table.cell>
                <flux:badge color="green" size="sm" inset="top bottom">Paid</flux:badge>
            </flux:table.cell>
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
| `paginate` | Laravel paginator instance to enable pagination. |
| `container:class` | Classes applied to the container (useful for height constraints like `max-h-80`). |

### `flux:table.columns`

| Prop | Description |
| --- | --- |
| `sticky` | Sticky header row when scrolling. |

### `flux:table.column`

| Prop | Description |
| --- | --- |
| `align` | Options: `start`, `center`, `end`. |
| `sortable` | Enables sorting for the column. |
| `sorted` | Marks this column as currently sorted. |
| `direction` | Options: `asc`, `desc`. |
| `sticky` | Sticky column when scrolling. |

### `flux:table.rows`

| Slot | Description |
| --- | --- |
| `default` | The table rows. |

### `flux:table.row`

| Slot | Description |
| --- | --- |
| `default` | The cells for this row. |

### `flux:table.cell`

| Prop | Description |
| --- | --- |
| `align` | Options: `start`, `center`, `end`. |
| `variant` | Options: `default`, `strong`. |
| `sticky` | Sticky cell when scrolling. |
