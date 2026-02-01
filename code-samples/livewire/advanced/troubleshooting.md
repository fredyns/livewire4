# Troubleshooting

source: https://livewire.laravel.com/docs/4.x/troubleshootingHere are some common errors and scenarios you may encounter in your Livewire apps.#

# Component mismatchesYou may encounter issues like:

```

textError: Component already initialized

```

```

textError: Snapshot missing on Livewire component with id: ...

```

The most common reason is forgetting to add `wire:key` to elements and components inside a `@foreach` loop.

##

# Adding wire:keyAny time you have a loop in Blade templates using `@foreach`, add `wire:key` to the opening tag of the first element within the loop:

```

blade@foreach($posts as $post)    <div wire:key="{{ $post->id }}"> ... </div>@endforeach

```

The same applies to Livewire components within a loop:

```

blade@foreach($posts as $post)    <livewire:show-post :$post :wire:key="$post->id" />@endforeach

```

When a Livewire component is deeply nested inside a loop, you still need a key on it:

```

blade@foreach($posts as $post)    <div wire:key="{{ $post->id }}">        ...        <livewire:show-post :$post :wire:key="$post->id" />        ...    </div>@endforeach

```

#

##

# Prefixing keysYou can also run into duplicate keys within the same component (often when using model IDs as keys).Example using prefixes:

```

blade<div>    @foreach($posts as $post)        <div wire:key="post-{{ $post->id }}">...</div>    @endforeach    @foreach($authors as $author)        <div wire:key="author-{{ $author->id }}">...</div>    @endforeach</div>

```

#

# Multiple instances of AlpineYou may see errors like:

```

textError: Detected multiple instances of Alpine running

```

```

textAlpine Expression Error: $wire is not defined

```

This typically means you have two versions of Alpine running. Livewire bundles Alpine by default, so you should remove any extra Alpine.

##

# Removing Laravel Breeze's AlpineIf you installed Livewire inside an existing Laravel Breeze (Blade + Alpine version), remove these lines from `resources/js/app.js`:

```

diffimport './bootstrap';-import Alpine from 'alpinejs';--window.Alpine = Alpine;--Alpine.start();

```

##

# Removing a CDN version of AlpineIf you previously included Alpine via CDN in your layout’s `<head>`, remove it.

```

diff- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs/dist/cdn.min.js"></script>

```

##

# Missing @alpinejs/uiLivewire’s bundled Alpine includes all Alpine plugins except `@alpinejs/ui`.If you rely on Alpine Components that require this plugin, you may see:

```

textUncaught Alpine: no element provided to x-anchor

```

Fix by including `@alpinejs/ui` via CDN:

```

html<script defer src="https://unpkg.com/@alpinejs/ui/dist/cdn.min.js"></script>

```
