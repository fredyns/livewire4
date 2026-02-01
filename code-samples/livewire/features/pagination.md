# Pagination

source: https://livewire.laravel.com/docs/4.x/paginationLaravel's pagination feature allows you to query a subset of data and provides your users with the ability to navigate between pages of those results.Because Laravel's paginator was designed for static applications, in a non-Livewire app, each page navigation triggers a full browser visit to a new URL containing the desired page (`?page=2`).However, when you use pagination inside a Livewire component, users can navigate between pages while remaining on the same page. Livewire will handle everything behind the scenes, including updating the URL query string with the current page.

#

# Basic usageBelow is the most basic example of using pagination inside a `show-posts` component to only show ten posts at a time.To take advantage of Livewire's pagination features, each component containing pagination must use the `Livewire\WithPagination` trait.

```

php<?php// resources/views/components/⚡show-posts.blade.phpuse App\Models\Post;use Livewire\Attributes\Computed;use Livewire\Component;use Livewire\WithPagination;new class extends Component{    use WithPagination;    #[Computed]    public function posts()    {        return Post::paginate(10);    }};

```

```

blade<div>    <div>        @foreach ($this->posts as $post)            <!-- ... -->        @endforeach    </div>    {{ $this->posts->links() }}</div>

```

As you can see, in addition to limiting the number of posts shown via the `Post::paginate()` method, we also use `$this->posts->links()` to render page navigation links.For more information on pagination using Laravel, check out Laravel's comprehensive pagination documentation.

#

# Disabling URL query string trackingBy default, Livewire's paginator tracks the current page in the browser URL's query string like so: `?page=2`.If you wish to still use Livewire's pagination utility, but disable query string tracking, you can do so using the `WithoutUrlPagination` trait:

```

phpuse Livewire\Component;use Livewire\WithoutUrlPagination;use Livewire\WithPagination;class ShowPosts extends Component{    use WithPagination, WithoutUrlPagination;    // ...}

```

Now, pagination will work as expected, but the current page won't show up in the query string. This also means the current page won't be persisted across page changes.

#

# Customizing scroll behaviorBy default, Livewire's paginator scrolls to the top of the page after every page change.You can disable this behavior by passing `false` to the `scrollTo` parameter of the `links()` method:

```

blade{{ $posts->links(data: ['scrollTo' => false]) }}

```

Alternatively, you can provide any CSS selector to the `scrollTo` parameter, and Livewire will find the nearest element matching that selector and scroll to it after each navigation:

```

blade{{ $posts->links(data: ['scrollTo' => '#paginated-posts']) }}

```

#

# Resetting the pageWhen sorting or filtering results, it is common to want to reset the page number back to `1`.Livewire provides the `$this->resetPage()` method, allowing you to reset the page number from anywhere in your component.Example resetting the page after a search form is submitted:

```

php<?php// resources/views/components/⚡search-posts.blade.phpuse App\Models\Post;use Livewire\Attributes\Computed;use Livewire\Component;use Livewire\WithPagination;new class extends Component{    use WithPagination;    public $query = '';    public function search()    {        $this->resetPage();    }    #[Computed]    public function posts()    {        return Post::where('title', 'like', '%'.$this->query.'%')->paginate(10);    }};

```

```

blade<div>    <form wire:submit="search">        <input type="text" wire:model="query">        <button type="submit">Search posts</button>    </form>    <div>        @foreach ($this->posts as $post)            <!-- ... -->        @endforeach    </div>    {{ $this->posts->links() }}</div>

```

#

#

# Available page navigation methodsIn addition to `$this->resetPage()`, Livewire provides other useful methods for navigating between pages programmatically:- `$this->setPage($page)`- `$this->resetPage()`- `$this->nextPage()`- `$this->previousPage()`

#

# Multiple paginatorsBecause both Laravel and Livewire use URL query string parameters to store and track the current page number, if a single page contains multiple paginators, it's important to assign them different names.Example using `pageName` to customize the query string key for a second paginator:

```

php<?php// resources/views/components/⚡show-invoices.blade.phpuse App\Models\Invoice;use Livewire\Attributes\Computed;use Livewire\Component;use Livewire\WithPagination;new class extends Component{    use WithPagination;    #[Computed]    public function invoices()    {        return Invoice::paginate(10, pageName: 'invoices-page');    }};

```

The URL might look like:

```

texthttps://application.test/customers?page=2&invoices-page=2

```

When using Livewire's page navigation methods on a named paginator, you must provide the page name as an additional parameter:

```

php$this->setPage(2, pageName: 'invoices-page');$this->resetPage(pageName: 'invoices-page');$this->nextPage(pageName: 'invoices-page');$this->previousPage(pageName: 'invoices-page');

```

#

# Hooking into page updatesLivewire allows you to execute code before and after a page is updated by defining either of the following methods inside your component:

```

php<?php// resources/views/components/⚡show-posts.blade.phpuse App\Models\Post;use Livewire\Attributes\Computed;use Livewire\Component;use Livewire\WithPagination;new class extends Component{    use WithPagination;    public function updatingPage($page)    {        // Runs before the page is updated for this component...    }    public function updatedPage($page)    {        // Runs after the page is updated for this component...    }    #[Computed]    public function posts()    {        return Post::paginate(10);    }};

```

#

#

# Named paginator hooksThe previous hooks only apply to the default paginator.If you are using a named paginator, you must define the methods using the paginator's name.Example for a paginator named `invoices-page`:

```

phppublic function updatingInvoicesPage($page){    // ...}

```

#

#

# General paginator hooksIf you prefer to not reference the paginator name in the hook method name, you can use the more generic alternatives and receive the `$pageName` as a second argument:

```

phppublic function updatingPaginators($page, $pageName){    // Runs before the page is updated for this component...}public function updatedPaginators($page, $pageName){    // Runs after the page is updated for this component...}

```

#

# Using the simple themeYou can use Laravel's `simplePaginate()` method instead of `paginate()` for added speed and simplicity.When paginating results using this method, only next and previous navigation links will be shown to the user instead of individual links for each page number:

```

phppublic function render(){    return view('show-posts', [        'posts' => Post::simplePaginate(10),    ]);}

```

For more information on simple pagination, check out Laravel's "simplePaginator" documentation.

#

# Using cursor paginationLivewire also supports using Laravel's cursor pagination — a faster pagination method useful in large datasets:

```

phppublic function render(){    return view('show-posts', [        'posts' => Post::cursorPaginate(10),    ]);}

```

When using `cursorPaginate()` instead of `paginate()` or `simplePaginate()`, the URL will store an encoded cursor instead of a standard page number.Example:

```

texthttps://example.com/posts?cursor=eyJpZCI6MTUsIl9wb2ludHNUb05leHRJdGVtcyI6dHJ1ZX0

```

For more information on cursor pagination, check out Laravel's cursor pagination documentation.

#

# Using Bootstrap instead of TailwindIf you are using Bootstrap instead of Tailwind as your application's CSS framework, you can configure Livewire to use Bootstrap styled pagination views.Set the `pagination_theme` configuration value in your application's `config/livewire.php` file:

```

php'pagination_theme' => 'bootstrap',

```

Before customizing the pagination theme, you must first publish Livewire's configuration file by running:

```

bashphp artisan livewire:config

```

#

# Modifying the default pagination viewsIf you want to modify Livewire's pagination views, you can publish them using:

```

bashphp artisan livewire:publish --pagination

```

After running this command, these files will be added to `resources/views/vendor/livewire`:- `tailwind.blade.php`- `tailwind-simple.blade.php`- `bootstrap.blade.php`- `bootstrap-simple.blade.php`Once published, Livewire will use these files when you call `->links()`.

#

# Using custom pagination viewsYou can bypass Livewire's pagination views entirely in one of two ways:- Passing a view name into `->links()`- Declaring `paginationView()` or `paginationSimpleView()` in your component

#

#

# Via ->links()Pass a custom pagination Blade view name to `->links()`:

```

blade{{ $posts->links('custom-pagination-links') }}

```

Livewire will look for:

```

textresources/views/custom-pagination-links.blade.php

```

#

#

# Via paginationView() or paginationSimpleView()Declare `paginationView()` / `paginationSimpleView()` to return the name of the view:

```

phppublic function paginationView(){    return 'custom-pagination-links-view';}public function paginationSimpleView(){    return 'custom-simple-pagination-links-view';}

```

#

#

# Sample pagination viewUnstyled example:

```

blade<div>    @if ($paginator->hasPages())        <nav role="navigation" aria-label="Pagination Navigation">            <span>                @if ($paginator->onFirstPage())                    <span>Previous</span>                @else                    <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev">Previous</button>                @endif            </span>            <span>                @if ($paginator->onLastPage())                    <span>Next</span>                @else                    <button wire:click="nextPage" wire:loading.attr="disabled" rel="next">Next</button>                @endif            </span>        </nav>    @endif</div>

```

For visual-only loading states (like opacity changes), you can use Livewire's automatic `data-loading` attribute with Tailwind classes:

```

blade<button wire:click="nextPage" class="data-loading:opacity-50" rel="next">    Next</button>

```

#

# See also- [URL Query Parameters](url.md) — Sync pagination state with URL- [Loading States](loading-states.md) — Show feedback during page changes- [Computed Properties](computed-properties.md) — Efficiently query paginated data
