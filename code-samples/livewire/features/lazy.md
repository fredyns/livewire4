# Lazy Loadingsource: https://livewire.laravel.com/docs/4.x/lazy

Livewire allows you to lazy load components that would otherwise slow down the initial page load.

#

# Lazy vs Defer

Livewire provides two ways to delay component loading:
- Lazy loading (`lazy`): Components load when they become visible in the viewport (when the user scrolls to them)- Deferred loading (`defer`): Components load immediately after the initial page load is completeBoth approaches prevent slow components from blocking your initial page render, but differ in when the component actually loads.

#

# Basic example

Imagine you have a `revenue` component which contains a slow database query in `mount()`:



```php
<?php// resources/views/components/Ã¢Å¡Â¡revenue.blade.phpuse App\Models\Transaction;use Livewire\Component;new class extends Component{    public $amount;    public function mount()    {        // Slow database query...        $this->amount = Transaction::monthToDate()->sum('amount');    }};?><div>    Revenue this month: {{ $amount }}</div>

```



Without lazy loading, this component would delay the loading of the entire page and make your entire application feel slow.To enable lazy loading, pass the `lazy` parameter into the component:



```blade
<livewire:revenue lazy />

```



Now, instead of loading the component right away, Livewire will skip this component, loading the page without it. Then, when the component is visible in the viewport, Livewire will make a network request to fully load this component on the page.Unlike other network requests in Livewire, lazy and deferred component updates are isolated from each other when sent to the server. This keeps loading fast by loading each component in parallel.

#

# Rendering placeholder HTMLBy default, Livewire will insert an empty `<div></div>` for your component before it is fully loaded. As the component will initially be invisible to users, it can be jarring when the component suddenly appears on the page.To signal to your users that the component is being loaded, you can render placeholder HTML like loading spinners and skeleton placeholders.

#

#

# Using the @placeholder directive

For single-file and multi-file components, you can use the `@placeholder` directive directly in your view to specify placeholder content:



```php
<?php// resources/views/components/Ã¢Å¡Â¡revenue.blade.phpuse App\Models\Transaction;use Livewire\Component;new class extends Component{    public $amount;    public function mount()    {        // Slow database query...        $this->amount = Transaction::monthToDate()->sum('amount');    }};?>@placeholder    <div>        <!-- Loading spinner... -->        <svg>...</svg>    </div>@endplaceholder<div>    Revenue this month: {{ $amount }}</div>

```



The content inside `@placeholder` and `@endplaceholder` will be displayed while the component is loading, then replaced with the actual component content once loaded.The `@placeholder` directive is only available for view-based components (single-file and multi-file components). For class-based components, use the `placeholder()` method instead.For instance, if your placeholder's root element type is a `div`, your component must also use a `div` element.

#

#

# Using the placeholder() method

For class-based components, or if you prefer programmatic control, you can define a `placeholder()` method that returns HTML:



```php
<?phpnamespace App\Livewire;use App\Models\Transaction;use Livewire\Component;class Revenue extends Component{    public $amount;    public function mount()    {        // Slow database query...        $this->amount = Transaction::monthToDate()->sum('amount');    }    public function placeholder()    {        return <<<'HTML'        <div>            <!-- Loading spinner... -->            <svg>...</svg>        </div>        HTML;    }    public function render()    {        return view('livewire.revenue');    }}

```



For more complex loaders (such as skeletons) you can return a view from the `placeholder()` method:



```php
public function placeholder(array $params = []){    return view('livewire.placeholders.skeleton', $params);}

```



Any parameters from the component being lazy loaded will be available as a `$params` argument passed to the `placeholder()` method.

#

# Loading immediately after page load

By default, lazy-loaded components aren't fully loaded until they enter the browser's viewport.If you'd rather load components immediately after the page is loaded, without waiting for them to enter the viewport, you can use the `defer` parameter instead:



```blade
<livewire:revenue defer />

```



Now this component will load as soon as the page is ready without waiting for it to be visible in the viewport.You can also use the `#[Defer]` attribute to make a component defer-loaded by default:



```php
<?phpnamespace App\Livewire;use Livewire\Attributes\Defer;use Livewire\Component;#[Defer]class Revenue extends Component{    // ...}

```



You can also use `lazy="on-load"` which behaves the same as `defer`. The `defer` parameter is recommended for new code.

#

# Passing in props

In general, you can treat lazy components the same as normal components, since you can still pass data into them from outside.For example, you might pass a time interval into the Revenue component from a parent component:



```blade
<input type="date" wire:model="start"><input type="date" wire:model="end"><livewire:revenue lazy :$start :$end />

```



You can accept this data in `mount()` just like any other component:



```php
<?php// resources/views/components/Ã¢Å¡Â¡revenue.blade.phpuse App\Models\Transaction;use Livewire\Component;new class extends Component{    public $amount;    public function mount($start, $end)    {        // Expensive database query...        $this->amount = Transactions::between($start, $end)->sum('amount');    }};?>@placeholder    <div>        <!-- Loading spinner... -->        <svg>...</svg>    </div>@endplaceholder<div>    Revenue this month: {{ $amount }}</div>

```



However, unlike a normal component load, a lazy component has to serialize or "dehydrate" any passed-in properties and temporarily store them on the client-side until the component is fully loaded.For example, you might want to pass in an Eloquent model to the revenue component like so:



```blade
<livewire:revenue lazy :$user />

```



In a normal component, the actual PHP in-memory `$user` model would be passed into the `mount()` method of revenue. However, because Livewire won't run `mount()` until the next network request, Livewire will internally serialize `$user` to JSON and then re-query it from the database before the next request is handled.Typically, this serialization should not cause any behavioral differences in your application.

#

# Enforcing lazy or defer by default

If you want to enforce that all usages of a component will be lazy-loaded or deferred, you can add the `#[Lazy]` or `#[Defer]` attribute above the component class:



```php
<?phpnamespace App\Livewire;use Livewire\Attributes\Lazy;use Livewire\Component;#[Lazy]class Revenue extends Component{    // ...}

```



Or for deferred loading:



```php
<?phpnamespace App\Livewire;use Livewire\Attributes\Defer;use Livewire\Component;#[Defer]class Revenue extends Component{    // ...}

```



You can override these defaults when rendering a component:



```blade
{{-- Disable lazy loading --}}<livewire:revenue :lazy="false" />{{-- Disable deferred loading --}}<livewire:revenue :defer="false" />

```



#

# Bundling multiple lazy components

By default, if there are multiple lazy-loaded components on the page, each component will make an independent network request in parallel.If you have many lazy components on a page, you may want to bundle them into a single network request to reduce server overhead.

#

#

# Using the bundle parameter

Enable bundling using the `bundle: true` parameter:



```php
<?phpnamespace App\Livewire;use Livewire\Attributes\Lazy;use Livewire\Component;#[Lazy(bundle: true)]class Revenue extends Component{    // ...}

```



Now, if there are ten Revenue components on the same page, when the page loads, all ten updates will be bundled and sent to the server as a single network request.

#

#

# Using the bundle modifier

You can enable bundling inline when rendering a component using the `bundle` modifier:



```blade
<livewire:revenue lazy.bundle />

```



This also works with deferred components:



```blade
<livewire:revenue defer.bundle />

```



Or using the attribute:



```php
<?phpnamespace App\Livewire;use Livewire\Attributes\Defer;use Livewire\Component;#[Defer(bundle: true)]class Revenue extends Component{    // ...}

```



#

#

# When to use bundling

Use bundling when:
- You have many (5+) lazy or deferred components on a single page- The components are similar in complexity and load time- You want to reduce server overhead and HTTP connection countDon't use bundling when:- Components have vastly different load times (slow components will block fast ones)- You want components to appear as soon as they're individually ready- You only have a few lazy components on the pageYou can also use `isolate: false` which behaves the same as `bundle: true`. The `bundle` parameter is recommended for new code as it's more explicit about the intent.

#

# Full-page lazy loading

You can lazy load or defer full-page Livewire components using route methods.

#

#

# Lazy loading full pages

Use `->lazy()` to load the component when it enters the viewport:



```php
Route::livewire('/dashboard', 'pages::dashboard')->lazy();

```



#

#

# Deferring full pages

Use `->defer()` to load the component immediately after the page loads:



```php
Route::livewire('/dashboard', 'pages::dashboard')->defer();

```



#

#

# Disabling lazy/defer loading

If a component is lazy or deferred by default (via the `#[Lazy]` or `#[Defer]` attribute), you can opt-out using `enabled: false`:



```php
Route::livewire('/dashboard', 'pages::dashboard')->lazy(enabled: false);Route::livewire('/dashboard', 'pages::dashboard')->defer(enabled: false);

```



#

# Default placeholder view

If you want to set a default placeholder view for all your components you can do so by referencing the view in the `config/livewire.php` config file:



```php
'component_placeholder' => 'livewire.placeholder',

```



Now, when a component is lazy-loaded and no `placeholder()` is defined, Livewire will use the configured Blade view (`livewire.placeholder` in this case.)

#

# Disabling lazy loading for tests

When unit testing a lazy component, or a page with nested lazy components, you may want to disable the "lazy" behavior so that you can assert the final rendered behavior.You can disable lazy loading using the `Livewire::withoutLazyLoading()` testing helper:



```php
<?phpnamespace Tests\Feature\Livewire;use App\Livewire\Dashboard;use Livewire\Livewire;use Tests\TestCase;class DashboardTest extends TestCase{    public function test_renders_successfully()    {        Livewire::withoutLazyLoading()            ->test(Dashboard::class)            ->assertSee(...);    }}

```



Now, when the dashboard component is rendered for this test, it will skip rendering the `placeholder()` and instead render the full component as if lazy loading wasn't applied at all.

#

# See also
- [Islands](islands.md) Ã¢â‚¬â€ Isolate updates within a single component- [Loading States](loading-states.md) Ã¢â‚¬â€ Show placeholders while components load- [@placeholder](../blade-directives/placeholder.md) Ã¢â‚¬â€ Define placeholder content- [Lazy Attribute](../php-attributes/lazy.md) Ã¢â‚¬â€ Mark components for lazy loading
