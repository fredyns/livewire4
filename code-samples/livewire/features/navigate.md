# Navigate

source: https://livewire.laravel.com/docs/4.x/navigateMany modern web applications are built as "single page applications" (SPAs). In these applications, each page rendered by the application no longer requires a full browser page reload, avoiding the overhead of re-downloading JavaScript and CSS assets on every request.The alternative to a single page application is a multi-page application. In these applications, every time a user clicks a link, an entirely new HTML page is requested and rendered in the browser.While most PHP applications have traditionally been multi-page applications, Livewire offers a single page application experience via a simple attribute you can add to links in your application: `wire:navigate`.

#

# Basic usageBelow is a typical Laravel routes file (`routes/web.php`) with three Livewire components defined as routes:

```

phpuse App\Livewire\Dashboard;use App\Livewire\ShowPosts;use App\Livewire\ShowUsers;Route::livewire('/', 'pages::dashboard');Route::livewire('/posts', 'pages::show-posts');Route::livewire('/users', 'pages::show-users');

```

By adding `wire:navigate` to each link in a navigation menu on each page, Livewire will prevent the standard handling of the link click and replace it with its own, faster version:

```

blade<nav>    <a href="/" wire:navigate>Dashboard</a>    <a href="/posts" wire:navigate>Posts</a>    <a href="/users" wire:navigate>Users</a></nav>

```

When a `wire:navigate` link is clicked:- User clicks a link- Livewire prevents the browser from visiting the new page- Livewire requests the page in the background and shows a loading bar at the top of the page- When the HTML for the new page has been received, Livewire replaces the current page's URL, `<title>` tag and `<body>` contents with the elements from the new pageThis technique results in much faster page load times — often twice as fast — and makes the application "feel" like a JavaScript powered single page application.

#

# RedirectsWhen one of your Livewire components redirects users to another URL within your application, you can instruct Livewire to use its `wire:navigate` functionality to load the new page.Provide the `navigate` argument to the `redirect()` method:

```

phpreturn $this->redirect('/posts', navigate: true);

```

Now, instead of a full page request being used to redirect the user to the new URL, Livewire will replace the contents and URL of the current page with the new one.

#

# Prefetching linksBy default, Livewire includes a gentle strategy to prefetch pages before a user clicks on a link:- A user presses down on their mouse button- Livewire starts requesting the page- They lift up on the mouse button to complete the click- Livewire finishes the request and navigates to the new pageIf you want a more aggressive approach to prefetching, you may use the `.hover` modifier:

```

blade<a href="/posts" wire:navigate.hover>Posts</a>

```

The `.hover` modifier will instruct Livewire to prefetch the page after a user has hovered over the link for **60 milliseconds**.

#

# Persisting elements across page visitsSometimes, there are parts of a user interface that you need to persist between page loads, such as audio or video players.You can achieve this in Livewire with the `@persist` directive.By wrapping an element with `@persist` and providing it with a name, when a new page is requested using `wire:navigate`, Livewire will look for an element on the new page that has a matching `@persist`. Instead of replacing the element like normal, Livewire will use the existing DOM element from the previous page in the new page, preserving any state within the element.Example persisting an `<audio>` player:

```

blade@persist('player')    <audio src="{{ $episode->file }}" controls></audio>@endpersist

```

The persisted element must be placed **outside** your Livewire components. A common practice is to position the persisted element in your main layout, such as `resources/views/layouts/app.blade.php`.

```

blade<!-- resources/views/layouts/app.blade.php --><!DOCTYPE html><html lang="{{ str_replace('_', '-', app()->getLocale()) }}">    <head>        <meta charset="utf-8">        <meta name="viewport" content="width=device-width, initial-scale=1.0">        <title>{{ $title ?? config('app.name') }}</title>        @vite(['resources/css/app.css', 'resources/js/app.js'])        @livewireStyles    </head>    <body>        <main>            {{ $slot }}        </main>        @persist('player')            <audio src="{{ $episode->file }}" controls></audio>        @endpersist        @livewireScripts    </body></html>

```

#

#

# Highlighting active linksServer-side Blade highlighting won’t work inside persisted elements (because they are re-used between page loads). Instead, use one of these approaches.

#

#

#

# Using the data-current attributeLivewire automatically adds a `data-current` attribute to any `wire:navigate` link that matches the current page.

```

blade<nav>    <a        href="/dashboard"        wire:navigate        class="data-current:font-bold data-current:text-zinc-800"    >        Dashboard    </a>    <a        href="/posts"        wire:navigate        class="data-current:font-bold data-current:text-zinc-800"    >        Posts    </a>    <a        href="/users"        wire:navigate        class="data-current:font-bold data-current:text-zinc-800"    >        Users    </a></nav>

```

You can also use plain CSS:

```

css[data-current] {    font-weight: bold;    color: #18181b;}

```

To disable this behavior while still using `wire:navigate`, add `wire:current.ignore`:

```

blade<a href="/posts" wire:navigate wire:current.ignore>Posts</a>

```

#

#

#

# Using the wire:current directiveAlternatively, use `wire:current` to add classes to the currently active link:

```

blade<nav>    <a href="/dashboard" wire:navigate wire:current="font-bold text-zinc-800">Dashboard</a>    <a href="/posts" wire:navigate wire:current="font-bold text-zinc-800">Posts</a>    <a href="/users" wire:navigate wire:current="font-bold text-zinc-800">Users</a></nav>

```

Read more in the [wire:current documentation](../html-directives/wire-current.md).

#

#

# Preserving scroll positionBy default, Livewire will preserve the scroll position of a page when navigating back and forth between pages.To preserve the scroll position of an individual element that you are persisting between page loads, add `wire:navigate:scroll` to the element containing a scrollbar:

```

blade@persist('sidebar')    <div class="overflow-y-scroll" wire:navigate:scroll>        <!-- ... -->    </div>@endpersist

```

#

# JavaScript hooksEach page navigation triggers three lifecycle hooks:- `livewire:navigate`- `livewire:navigating`- `livewire:navigated`These hook events are dispatched on navigations of all types (manual `Livewire.navigate()`, redirects with navigation enabled, and back/forward button presses).Example listeners:

```

jsdocument.addEventListener('livewire:navigate', (event) => {    // Triggers when a navigation is triggered.    // Can be "cancelled" (prevent the navigate from actually being performed):    event.preventDefault()    // Contains helpful context about the navigation trigger:    let context = event.detail    // A URL object of the intended destination of the navigation...    context.url    // A boolean [true/false] indicating whether or not this navigation    // was triggered by a back/forward (history state) navigation...    context.history    // A boolean [true/false] indicating whether or not there is    // cached version of this page to be used instead of    // fetching a new one via a network round-trip...    context.cached})document.addEventListener('livewire:navigating', (e) => {    // Triggered when new HTML is about to be swapped onto the page...    // You can register an onSwap callback to run code after the    // new HTML is swapped onto the page but before scripts are loaded.    // This is a good place to apply critical styles such as dark mode    // to prevent flickering...    e.detail.onSwap(() => {        // ...    })})document.addEventListener('livewire:navigated', () => {    // Triggered as the final step of any page navigation...    // Also triggered on page-load instead of "DOMContentLoaded"...})

```

When you attach an event listener to the document it will not be removed when you navigate to a different page. If you need code to run only for a specific page or only once, you can pass `{ once: true }` as the third argument to `addEventListener`:

```

jsdocument.addEventListener('livewire:navigated', () => {    // ...}, { once: true })

```

#

# Manually visiting a new pageIn addition to `wire:navigate`, you can manually call `Livewire.navigate()` to trigger a visit to a new page using JavaScript:

```

html<script>    Livewire.navigate('/new/url')</script>

```

#

# Using with analytics softwareWhen navigating pages using `wire:navigate`, any `<script>` tags in the `<head>` only evaluate when the page is initially loaded.This can be an issue for analytics tools that expect their snippet to be evaluated on every page view.For example, with Fathom Analytics, add `data-spa="auto"` to ensure each page visit is tracked properly:

```

blade<head>    <!-- ... -->    <!-- Fathom Analytics -->    @if (! config('app.debug'))        <script            src="https://cdn.usefathom.com/script.js"            data-site="ABCDEFG"            data-spa="auto"            defer        ></script>    @endif</head>

```

#

# Script evaluationWhen navigating to a new page using `wire:navigate`, it feels like the browser has changed pages; however, from the browser's perspective, you are technically still on the original page.Because of this, styles and scripts are executed normally on the first page, but on subsequent pages, you may have to tweak the way you normally write JavaScript.

#

#

# Don't rely on DOMContentLoadedWhen using `wire:navigate`, `DOMContentLoaded` is only fired on the first page visit, not subsequent visits.To run code on every page visit, swap every instance of `DOMContentLoaded` with `livewire:navigated`:

```

diff-document.addEventListener('DOMContentLoaded', () => {+document.addEventListener('livewire:navigated', () => {     // ... })

```

#

#

# Scripts in <head> are loaded onceIf two pages include the same `<script>` tag in the `<head>`, that script will only be run on the initial page visit and not on subsequent page visits.

```

html<!-- Page one --><head>    <script src="/app.js"></script></head><!-- Page two --><head>    <script src="/app.js"></script></head>

```

#

#

# New <head> scripts are evaluatedIf a subsequent page includes a new `<script>` tag in the `<head>` that was not present in the `<head>` of the initial page visit, Livewire will run the new `<script>` tag.

```

html<!-- Page one --><head>    <script src="/app.js"></script></head><!-- Page two --><head>    <script src="/app.js"></script>    <script src="/third-party.js"></script></head>

```

If you are navigating to a new page that contains an asset like `<script src="...">` in the `<head>`, that asset will be fetched and processed before the navigation is complete and the new page is swapped in.

#

#

# Reloading when assets changeWhen using `wire:navigate`, users may receive stale JavaScript after deployments.To prevent this, add `data-navigate-track` to a `<script>` tag in `<head>`:

```

html<!-- Page one --><head>    <script src="/app.js?id=123" data-navigate-track></script></head><!-- Page two --><head>    <script src="/app.js?id=456" data-navigate-track></script></head>

```

When a user visits page two, Livewire will detect a fresh JavaScript asset and trigger a full browser page reload.If you are using Laravel Vite, Livewire adds `data-navigate-track` to rendered HTML asset tags automatically:

```

blade<head>    @vite(['resources/css/app.css', 'resources/js/app.js'])</head>

```

Livewire will only reload a page if a `[data-navigate-track]` element's query string (`?id="456"`) changes, not the URI itself (`/app.js`).

#

#

# Scripts in the <body> are re-evaluatedBecause Livewire replaces the entire contents of the `<body>` on every new page, all `<script>` tags on the new page will be run:

```

html<!-- Page one --><body>    <script>        console.log('Runs on page one')    </script></body><!-- Page two --><body>    <script>        console.log('Runs on page two')    </script></body>

```

If you have a `<script>` tag in the body that you only want to be run once, add `data-navigate-once`:

```

html<script data-navigate-once>    console.log('Runs only on page one')</script>

```

#

# Customizing the progress barWhen a page takes longer than 150ms to load, Livewire will show a progress bar at the top of the page.You can customize the color of this bar or disable it inside Livewire's config file (`config/livewire.php`):

```

php'navigate' => [    'show_progress_bar' => false,    'progress_bar_color' => '#2299dd',],

```

#

# See also- [Pages](../essentials/pages.md) — Create routable page components- [Redirecting](redirects.md) — Navigate programmatically from actions- [@persist](../blade-directives/persist.md) — Persist elements across page navigations- [wire:navigate](../html-directives/wire-navigate.md) — Add SPA navigation to links
