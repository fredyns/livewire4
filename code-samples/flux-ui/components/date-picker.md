# Date picker - PRO

Source: https://fluxui.dev/components/date-picker

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:date-picker</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span>
```


## Introduction

```blade
<flux:date-picker />
```

## Basic usage

```blade
<flux:date-picker value="2026-01-27" />
```

```blade
<flux:date-picker wire:model="date" />
```

```php
<?php

use Illuminate\Support\Carbon;
use Livewire\Component;
use App\Models\Post;

class CreatePost extends Component
{
    public ?Carbon $date;

    public function save()
    {
        Post::create([
            // ...
            'published_at' => $this->date,
        ]);

        // ...
    }
}
```

## Input trigger

```blade
<flux:date-picker wire:model="date">
    <x-slot name="trigger">
        <flux:date-picker.input />
    </x-slot>
</flux:date-picker>
```

## Range picker

```blade
<flux:date-picker mode="range" />
```

```blade
<flux:date-picker mode="range" value="2026-01-02/2026-01-06" />
```

```blade
<flux:date-picker mode="range" wire:model="range" />
```

```php
<?php

use Illuminate\Support\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public array $range;

    public function mount()
    {
        $this->range = [
            'start' => now()->subMonth()->format('Y-m-d'),
            'end' => now()->format('Y-m-d'),
        ];
    }
}
```

```php
<?php

use Livewire\Component;
use Flux\DateRange;

class Dashboard extends Component
{
    public DateRange $range;

    public function mount()
    {
        $this->range = new DateRange(now()->subMonth(), now());
    }
}
```

## Range limits

```blade
<flux:date-picker mode="range" min-range="3" />
<flux:date-picker mode="range" max-range="10" />
```

## Range with inputs

```blade
<flux:date-picker mode="range">
    <x-slot name="trigger">
        <div class="flex flex-col sm:flex-row gap-6 sm:gap-4">
            <flux:date-picker.input label="Start" />
            <flux:date-picker.input label="End" />
        </div>
    </x-slot>
</flux:date-picker>
```

## Presets

```blade
<flux:date-picker mode="range" with-presets />
```

```blade
<flux:date-picker
    mode="range"
    presets="today yesterday thisWeek last7Days thisMonth yearToDate allTime"
/>
```

## All time

```blade
<flux:date-picker
    mode="range"
    presets="... allTime"
    :min="auth()->user()->created_at->format('Y-m-d')"
/>
```

```php
use Flux\DateRange;

$this->range = DateRange::allTime(start: auth()->user()->created_at);
```

```php
$orders = Order::when($this->range->isNotAllTime(), function ($query) => {
    $query->whereBetween('created_at', $this->range);
})->get();
```

## Custom range preset

```blade
<flux:date-picker mode="range" presets="... custom" />
```

## Unavailable dates

```blade
<flux:date-picker unavailable="2026-01-26,2026-01-28" />
```

## With today shortcut

```blade
<flux:date-picker with-today />
```

## Selectable header

```blade
<flux:date-picker selectable-header />
```

## Fixed weeks

```blade
<flux:date-picker fixed-weeks />
```

## Start day

```blade
<flux:date-picker start-day="1" />
```

## Open to

```blade
<flux:date-picker open-to="2027-02-01" />
<flux:date-picker open-to="2027-02-01" force-open-to />
```

## Week numbers

```blade
<flux:date-picker week-numbers />
```

## Localization

```blade
<flux:date-picker locale="ja-JP" />
```

## The DateRange object

```blade
<flux:calendar wire:model.live="range" />
```

```php
<?php

use Livewire\Component;
use Flux\DateRange;

class Dashboard extends Component
{
    public DateRange $range;
}
```

## Instantiation

```php
<?php

use Livewire\Component;
use Flux\DateRange;

class Dashboard extends Component
{
    public DateRange $range;

    public function mount()
    {
        $this->range = new DateRange(now(), now()->addDays(7));
    }
}
```

## Persisting to the session

```php
<?php

use Livewire\Attributes\Session;
use Livewire\Component;
use Flux\DateRange;

class Dashboard extends Component
{
    #[Session]
    public DateRange $range;
}
```

## Using with Eloquent

```php
<?php

use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Order;
use Flux\DateRange;

class Dashboard extends Component
{
    public ?DateRange $range;

    #[Computed]
    public function orders()
    {
        return $this->range
            ? Order::whereBetween('created_at', $this->range)->get()
            : Order::all();
    }
}
```

## Available methods

```php
$range = new Flux\DateRange(
    now()->subDays(1),
    now()->addDays(1),
);

$start = $range->start();
$end = $range->end();

$range->contains(now());
$range->length();

foreach ($range as $date) {
    // $date is a Carbon instance...
}

$range->toArray();
```

```php
$orders = Order::whereBetween('created_at', $range)->get();
```

## Range presets

```blade
[
    'start' => null,
    'end' => null,
    'preset' => 'lastMonth',
]
```

```php
<?php

use Livewire\Component;

class Dashboard extends Component
{
    public array $range;

    public function mount()
    {
        $this->range = [
            'start' => null,
            'end' => null,
            'preset' => 'lastMonth',
        ];
    }
}
```

```php
<?php

use Livewire\Component;
use Flux\DateRange;

class Dashboard extends Component
{
    public DateRange $range;

    public function mount()
    {
        $this->range = DateRange::lastMonth();
    }
}
```

```php
$this->range->preset();
```

## Reference

### `flux:date-picker`

| Prop | Description |
| --- | --- |
| `wire:model` | Binds the date picker to a Livewire property. |
| `value` | Selected date(s): single (`Y-m-d`) or range (`Y-m-d/Y-m-d`). |
| `mode` | Options: `single` (default), `range`. |
| `min-range` | Min selectable days in range mode. |
| `max-range` | Max selectable days in range mode. |
| `min` | Earliest selectable date (date string or `today`). |
| `max` | Latest selectable date (date string or `today`). |
| `open-to` | Date to open to when no selected date. |
| `force-open-to` | Force opening to `open-to`. Default: `false`. |
| `months` | Months shown. Default: `1` (single), `2` (range). |
| `label` | Label text above picker. |
| `description` | Help text near picker. |
| `description:trailing` | Description below picker instead of above. |
| `badge` | Badge text at end of label. |
| `placeholder` | Placeholder when no date selected. |
| `size` | Day cell size. Options: `sm`, default, `lg`, `xl`, `2xl`. |
| `start-day` | Day of week to start on (`0`..`6`). |
| `week-numbers` | Show week numbers. |
| `selectable-header` | Month/year dropdowns. |
| `with-today` | Today shortcut. |
| `with-inputs` | Shows inputs for manual entry. |
| `with-confirmation` | Requires confirmation before applying selection. |
| `with-presets` | Shows preset ranges. |
| `presets` | Space-separated list of presets. |
| `clearable` | Shows clear button when selected. |
| `disabled` | Disables interaction. |
| `invalid` | Error styling. |
| `locale` | Locale (e.g. `fr`, `en-US`, `ja-JP`). |

### `flux:date-picker.input`

| Prop | Description |
| --- | --- |
| `label` | Label text above the input. |
| `description` | Help text near the input. |
| `placeholder` | Placeholder when no date selected. |
| `clearable` | Shows clear button when selected. |
| `disabled` | Disables interaction. |
| `invalid` | Error styling. |

### `flux:date-picker.button`

| Prop | Description |
| --- | --- |
| `placeholder` | Text shown when no date selected. |
| `size` | Button size. Options: `sm`, `xs`. |
| `clearable` | Shows clear button when selected. |
| `disabled` | Disables interaction. |
| `invalid` | Error styling. |
