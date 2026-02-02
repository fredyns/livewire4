# Islandssource: https://livewire.laravel.com/docs/4.x/islands

Islands allow you to create isolated regions within a Livewire component that update independently. When an action occurs inside an island, only that island re-renders Ã¢â‚¬â€ not the entire component.This gives you the performance benefits of breaking components into smaller pieces without the overhead of creating separate child components, managing props, or dealing with component communication.

#

# Basic usage

To create an island, wrap any portion of your Blade template with the `@island` directive:



```php
<?php// resources/views/components/Ã¢Å¡Â¡dashboard.blade.phpuse App\Models\Revenue;use Livewire\Attributes\Computed;use Livewire\Component;new class extends Component{    #[Computed]    public function revenue()    {        // Expensive calculation or query...        return Revenue::yearToDate();    }};?><div>    @island        <div>            Revenue: {{ $this->revenue }}            <button type="button" wire:click="$refresh">Refresh</button>        </div>    @endisland    <div>        <!-- Other content... -->    </div></div>

```



When the "Refresh" button is clicked, only the island containing the revenue calculation will re-render. The rest of the component remains untouched.Because the expensive calculation is inside a computed propertyÃ¢â‚¬â€which evaluates on-demandÃ¢â‚¬â€it will only be called when the island re-renders, not when other parts of the page update. However, since islands load with the page by default, the `revenue` property will still be calculated during the initial page load.

#

# Lazy loading

Sometimes you have expensive computations or slow API calls that shouldn't block your initial page load.You can defer an island's initial render until after the page loads using the `lazy` parameter:



```php
<?php// resources/views/components/Ã¢Å¡Â¡dashboard.blade.phpuse App\Models\Revenue;use Livewire\Attributes\Computed;use Livewire\Component;new class extends Component{    #[Computed]    public function revenue()    {        // Expensive calculation or query...        return Revenue::yearToDate();    }};?><div>    @island(lazy: true)        <div>            Revenue: {{ $this->revenue }}            <button type="button" wire:click="$refresh">Refresh</button>        </div>    @endisland    <div>        <!-- Other content... -->    </div></div>

```



The island will display a loading state initially, then fetch and render its content in a separate request.

#

#

# Lazy vs Deferred loading

By default, `lazy` uses an intersection observer to trigger the load when the island becomes visible in the viewport.If you want the island to load immediately after the page loads (regardless of visibility), use `defer` instead:



```blade
{{-- Loads when scrolled into view --}}@island(lazy: true)    <!-- ... -->@endisland{{-- Loads immediately after page load --}}@island(defer: true)    <!-- ... -->@endisland

```



#

#

# Custom loading states

You can customize what displays while a lazy island is loading using the `@placeholder` directive:



```blade
@island(lazy: true)    @placeholder        <!-- Loading indicator -->        <div class="animate-pulse">            <div class="h-32 bg-gray-200 rounded"></div>        </div>    @endplaceholder    <div>        Revenue: {{ $this->revenue }}        <button type="button" wire:click="$refresh">Refresh</button>    </div>@endisland

```



#

# Named islands

To trigger an island from elsewhere in your component, give it a name and reference it using `wire:island`:



```blade
<div>    @island(name: 'revenue')        <div>            Revenue: {{ $this->revenue }}        </div>    @endisland    <button type="button" wire:click="$refresh" wire:island="revenue">        Refresh revenue    </button></div>

```



The `wire:island` directive works alongside action directives like `wire:click`, `wire:submit`, etc. to scope their updates to a specific island.When you have multiple islands with the same name, they're linked together and will always render as a group:



```blade
@island(name: 'revenue')    <div class="sidebar">        Revenue: {{ $this->revenue }}    </div>@endisland@island(name: 'revenue')    <div class="header">        Revenue: {{ $this->revenue }}    </div>@endisland<button type="button" wire:click="$refresh" wire:island="revenue">    Refresh revenue</button>

```



Both islands will update together whenever one is triggered.

#

# Append and prepend modes

Instead of replacing content entirely, islands can append or prepend new content. This is perfect for pagination, infinite scroll, or real-time feeds.



```php
<?php// resources/views/components/Ã¢Å¡Â¡activity-feed.blade.phpuse App\Models\Activity;use Livewire\Attributes\Computed;use Livewire\Component;new class extends Component{    public $page = 1;    public function loadMore()    {        $this->page++;    }    #[Computed]    public function activities()    {        return Activity::latest()            ->forPage($this->page, 10)            ->get();    }};?><div>    @island(name: 'feed')        @foreach ($this->activities as $activity)            <x-activity-item wire:key="{{ $activity->id }}" :activity="$activity" />        @endforeach    @endisland    <button type="button" wire:click="loadMore" wire:island.append="feed">        Load more    </button></div>

```



Available modes:- `wire:island.append`
- Add to the end- `wire:island.prepend`
- Add to the beginning

#

# Nested islands

Islands can be nested inside each other. When an outer island re-renders, inner islands are skipped by default:



```blade
@island(name: 'revenue')    <div>        Total revenue: {{ $this->revenue }}        @island(name: 'breakdown')            <div>                Monthly breakdown: {{ $this->monthlyBreakdown }}                <button type="button" wire:click="$refresh">                    Refresh breakdown                </button>            </div>        @endisland        <button type="button" wire:click="$refresh">            Refresh revenue        </button>    </div>@endisland

```



Clicking "Refresh revenue" updates only the outer island, while "Refresh breakdown" updates only the inner island.

#

# Always render with parent

By default, when a component re-renders, islands are skipped.Use the `always` parameter to force an island to update whenever the parent component updates:



```blade
<div>    @island(always: true)        <div>            Revenue: {{ $this->revenue }}            <button type="button" wire:click="$refresh">Refresh revenue</button>        </div>    @endisland    <button type="button" wire:click="$refresh">Refresh</button></div>

```



With `always: true`, the island will re-render whenever any part of the component updates. This is useful for critical data that should always stay in sync with the component state.This also works for nested islands Ã¢â‚¬â€ an inner island with `always: true` will update whenever its parent island updates.

#

# Skip initial render

The `skip` parameter prevents an island from rendering initially, perfect for on-demand content:



```blade
@island(skip: true)    @placeholder        <button type="button" wire:click="$refresh">            Load revenue details        </button>    @endplaceholder    <div>        Revenue: {{ $this->revenue }}        <button type="button" wire:click="$refresh">Refresh</button>    </div>@endisland

```



The placeholder content will be shown initially. When triggered, the island renders and replaces the placeholder.

#

# Island polling

You can use `wire:poll` within an island to refresh just that island on an interval:



```blade
@island(skip: true)    <div wire:poll.3s>        Revenue: {{ $this->revenue }}        <button type="button" wire:click="$refresh">Refresh</button>    </div>@endisland

```



The polling is scoped to the island Ã¢â‚¬â€ only the island will refresh every 3 seconds, not the entire component.

#

# Considerations

While islands provide powerful isolation, keep in mind:
- **Data scope**: Islands have access to the component's properties and methods, but not to template variables defined outside the island. Any `@php` variables or loop variables from the parent template won't be available inside the island.



```blade
@php    $localVariable = 'This won\'t be available in the island';@endphp@island    {{-- Ã¢ÂÅ’ This will error
- $localVariable is not accessible --}}    {{ $localVariable }}    {{-- Ã¢Å“â€¦ Component properties work fine --}}    {{ $this->revenue }}@endisland

```



- **Islands can't be used in loops or conditionals**: Islands cannot be used inside `@foreach`, `@if`, or other control structures.



```blade
{{-- Ã¢ÂÅ’ This won't work --}}@foreach ($items as $item)    @island        {{ $item->name }}    @endisland@endforeach{{-- Ã¢ÂÅ’ This won't work either --}}@if ($showRevenue)    @island        Revenue: {{ $this->revenue }}    @endisland@endif{{-- Ã¢Å“â€¦ Instead, put the loop/conditional inside the island --}}@island    @if ($this->showRevenue)        Revenue: {{ $this->revenue }}    @endif    @foreach ($this->items as $item)        {{ $item->name }}    @endforeach@endisland

```



- **State synchronization**: Although island requests run in parallel, both islands and the root component can mutate the same component state. If multiple requests are in flight simultaneously, there can be divergent state Ã¢â‚¬â€ the last response to return will win.When to use islands:- Expensive computations that shouldn't block initial page load- Independent regions with their own interactions- Real-time updates affecting only portions of the UI- Performance bottlenecks in large componentsIslands aren't necessary for static content, tightly coupled UI, or simple components that already render quickly.

#

# See also
- [Nesting](../advanced/nesting.md) Ã¢â‚¬â€ Alternative approach using child components- [Lazy Loading](lazy.md) Ã¢â‚¬â€ Defer loading of expensive content- [Computed Properties](computed-properties.md) Ã¢â‚¬â€ Optimize island performance with memoization- [@island](../blade-directives/island.md) Ã¢â‚¬â€ Create isolated update regions
