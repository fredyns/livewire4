# Defer

source: https://livewire.laravel.com/docs/4.x/attribute-deferThe `#[Defer]` attribute makes a component load immediately after the initial page load is complete, preventing slow components from blocking the page render.#

# Basic usageApply the `#[Defer]` attribute to any component that should be deferred:

```

php<?php// resources/views/components/⚡revenue.blade.phpuse Livewire\Attributes\Defer;use Livewire\Component;use App\Models\Transaction;new #[Defer] class extends Component {    public $amount;    public function mount()    {        // Slow database query...        $this->amount = Transaction::monthToDate()->sum('amount');    }};?><div>    Revenue this month: {{ $amount }}</div>

```

With `#[Defer]`, the component initially renders as an empty `<div></div>`, then loads immediately after the page finishes loading — without waiting for it to enter the viewport.#

# Lazy vs DeferLivewire provides two ways to delay component loading:- Lazy loading (`#[Lazy]`)
- Components load when they become visible in the viewport (when the user scrolls to them)- Deferred loading (`#[Defer]`)
- Components load immediately after the initial page load is completeBoth prevent slow components from blocking your initial page render, but differ in when the component actually loads.#

# Rendering placeholdersBy default, Livewire renders an empty `<div></div>` before the component loads.You can provide a custom placeholder using the `placeholder()` method:

```

php<?php// resources/views/components/⚡revenue.blade.phpuse Livewire\Attributes\Defer;use Livewire\Component;use App\Models\Transaction;new #[Defer] class extends Component {    public $amount;    public function mount()    {        $this->amount = Transaction::monthToDate()->sum('amount');    }    public function placeholder()    {        return <<<'HTML'            <div>                <svg><!-- Loading spinner... --></svg>            </div>        HTML;    }};?><div>    Revenue this month: {{ $amount }}</div>

```

Users will see the loading spinner until the component fully loads.If your placeholder's root element is a `<div>`, your component must also use a `<div>` element.#

# Bundling requestsBy default, deferred components load in parallel with independent network requests.To bundle multiple deferred components into a single request, use the `bundle` parameter:

```

php<?php// resources/views/components/⚡revenue.blade.phpuse Livewire\Attributes\Defer;use Livewire\Component;new #[Defer(bundle: true)] class extends Component {    // ...};

```

Now, if there are ten revenue components on the page, all ten will load via a single bundled network request instead of ten parallel requests.#

# Alternative approachInstead of the attribute, you can defer specific component instances using the `defer` parameter:

```

blade<livewire:revenue defer />

```

This is useful when you only want certain instances of a component to be deferred.

##

# Overriding the attributeIf a component has `#[Defer]` but you want to load it immediately in certain cases, you can override it:

```

blade<livewire:revenue :defer="false" />

```

#

# When to useUse `#[Defer]` when:- Components contain slow operations (database queries, API calls) that would delay page load- The component is always visible on initial page load (if it's below the fold, use `#[Lazy]` instead)- You want to improve perceived performance by showing the page faster#

# Learn moreFor complete documentation on lazy and deferred loading (including placeholders and bundling strategies), see the Lazy Loading documentation.#

# Reference

```

text#[Defer(    bool|null $bundle = null,)]

```
