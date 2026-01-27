# Pagination

Source: https://fluxui.dev/components/pagination

## Main

```blade
<span class="line"><span style="color:#8E908C;--shiki-light-font-style:italic;--shiki-dark:#8E908C;--shiki-dark-font-style:italic"><!-- $orders = Order::paginate() --></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:pagination</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> :paginator</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"$orders"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span>
```


## Simple paginator

```blade
<!-- $orders = Order::simplePaginate() -->
<flux:pagination :paginator="$orders" />
```

## Large result set

```blade
<!-- $orders = Order::paginate(5) -->
<flux:pagination :paginator="$orders" />
```

## Reference

### `flux:pagination`

| Prop | Description |
| --- | --- |
| `paginator` | The paginator instance to display. |
