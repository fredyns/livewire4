# Calendar - PRO

Source: https://fluxui.dev/components/calendar

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:calendar</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span>
```


## Introduction

```blade
<flux:calendar />
```

## Basic Usage

```blade
<flux:calendar value="2026-01-27" />
```

```blade
<flux:calendar wire:model="date" />
```

```php
<?php

use Illuminate\Support\Carbon;
use Livewire\Component;

class BookAppointment extends Component
{
    public Carbon $date;

    public function mount()
    {
        $this->date = now();
    }
}
```

## Multiple dates

```blade
<flux:calendar multiple />
```

```blade
<flux:calendar
    multiple
    value="2026-01-02,2026-01-05,2026-01-15"
/>
```

```blade
<flux:calendar multiple wire:model="dates" />
```

```php
<?php

use Illuminate\Support\Carbon;
use Livewire\Component;

class RequestTimeOff extends Component
{
    public array $dates = [];

    public function mount()
    {
        $this->dates = [
            now()->format('Y-m-d'),
            now()->addDays(1)->format('Y-m-d'),
        ];
    }
}
```

## Date range

```blade
<flux:calendar mode="range" />
```

```blade
<flux:calendar mode="range" value="2026-01-02/2026-01-06" />
```

```blade
<flux:calendar mode="range" wire:model="range" />
```

```php
<?php

use Livewire\Component;

class BookFlight extends Component
{
    public ?array $range;

    public function book()
    {
        // ...
        $flight->depart_on = $this->range['start'];
        $flight->return_on = $this->range['end'];
        // ...
    }
}
```

```php
<?php

use Livewire\Component;
use Flux\DateRange;

class BookFlight extends Component
{
    public ?DateRange $range;

    public function book()
    {
        // ...
        $flight->depart_on = $this->range->start();
        $flight->return_on = $this->range->end();
        // ...
    }
}
```

## Range Configuration

```blade
<!-- Set minimum and maximum range limits -->
<flux:calendar mode="range" min-range="3" max-range="10" />

<!-- Control number of months shown -->
<flux:calendar mode="range" months="2" />
```

## Size

```blade
<flux:calendar size="xl" />
```

## Static

```blade
<flux:calendar
    static
    value="2026-01-27"
    size="xs"
    :navigation="false"
/>
```

## Min/max dates

```blade
<flux:calendar max="2026-01-27" />
```

```blade
<!-- Prevent selection before today... -->
<flux:calendar min="today" />

<!-- Prevent selection after today... -->
<flux:calendar max="today" />
```

## Unavailable dates

```blade
<flux:calendar unavailable="2026-01-26,2026-01-28" />
```

## With today shortcut

```blade
<flux:calendar with-today />
```

## Selectable header

```blade
<flux:calendar selectable-header />
```

## Fixed weeks

```blade
<flux:calendar fixed-weeks />
```

## Start day

```blade
<flux:calendar start-day="1" />
```

## Open to

```blade
<flux:calendar open-to="2027-02-01" />
```

```blade
<flux:calendar open-to="2027-02-01" force-open-to />
```

## Week numbers

```blade
<flux:calendar week-numbers />
```

## Localization

```blade
<flux:calendar locale="ja-JP" />
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

// Get the start and end dates as Carbon instances...
$start = $range->start();
$end = $range->end();

// Check if the range contains a date...
$range->contains(now());

// Get the number of days in the range...
$range->length();

// Loop over the range by day...
foreach ($range as $date) {
    // $date is a Carbon instance...
}

// Get the range as an array of Carbon instances representing each day in the range...
$range->toArray();
```

```php
$orders = Order::whereBetween('created_at', $range)->get();
```

## Reference

### `flux:calendar`

| Prop | Description |
| --- | --- |
| `wire:model` | Binds the calendar to a Livewire property. |
| `value` | Selected date(s). Format depends on mode: single date (`Y-m-d`), multiple dates (comma-separated `Y-m-d`), or range (`Y-m-d/Y-m-d`). |
| `mode` | Selection mode. Options: `single` (default), `multiple`, `range`. |
| `min` | Earliest selectable date. Can be a date string or `today`. |
| `max` | Latest selectable date. Can be a date string or `today`. |
| `size` | Calendar size. Options: `base` (default), `xs`, `sm`, `lg`, `xl`, `2xl`. |
| `start-day` | Day of week to start on. Options: `0` (Sunday) to `6` (Saturday). Default: based on locale. |
| `months` | Number of months to display. Default: `1` for single/multiple, `2` for range mode. |
| `min-range` | Minimum number of days selectable in range mode. |
| `max-range` | Maximum number of days selectable in range mode. |
| `open-to` | Date that the calendar opens to if there is no selected date. |
| `force-open-to` | If `true`, forces open to `open-to` regardless of selected date. Default: `false`. |
| `navigation` | If `false`, hides month navigation controls. Default: `true`. |
| `static` | If `true`, makes the calendar non-interactive. Default: `false`. |
| `multiple` | If `true`, enables multiple date selection. Default: `false`. |
| `week-numbers` | If `true`, displays week numbers. Default: `false`. |
| `selectable-header` | If `true`, displays month/year dropdowns. Default: `false`. |
| `with-today` | If `true`, displays a shortcut to today. Default: `false`. |
| `with-inputs` | If `true`, displays date inputs for manual entry. Default: `false`. |
| `locale` | Locale for the calendar (e.g. `fr`, `en-US`, `ja-JP`). |
