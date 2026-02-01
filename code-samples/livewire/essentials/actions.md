# Actions

source: https://livewire.laravel.com/docs/4.x/actionsLivewire actions are methods on your component that can be triggered by frontend interactions like clicking a button or submitting a form.

#

# Basic example

```

php<?php// resources/views/components/post/⚡create.blade.phpuse App\Models\Post;use Livewire\Component;new class extends Component{    public $title = '';    public $content = '';    public function save()    {        Post::create([            'title' => $this->title,            'content' => $this->content,        ]);        return redirect()->to('/posts');    }};?><form wire:submit="save">    <input type="text" wire:model="title">    <textarea wire:model="content"></textarea>    <button type="submit">Save</button></form>

```

#

# Passing parametersYou can pass parameters from your Blade template to actions.Example deleting posts:

```

php<?php// resources/views/components/post/⚡index.blade.phpuse App\Models\Post;use Illuminate\Support\Facades\Auth;use Livewire\Attributes\Computed;use Livewire\Component;new class extends Component{    #[Computed]    public function posts()    {        return Auth::user()->posts;    }    public function delete($id)    {        $post = Post::findOrFail($id);        $this->authorize('delete', $post);        $post->delete();    }};

```

```

blade<div>    @foreach ($this->posts as $post)        <div wire:key="{{ $post->id }}">            <h1>{{ $post->title }}</h1>            <span>{{ $post->content }}</span>            <button wire:click="delete({{ $post->id }})">Delete</button>        </div>    @endforeach</div>

```

You can also type-hint a parameter with an Eloquent model and Livewire will resolve it.

```

phppublic function delete(Post $post){    $this->authorize('delete', $post);    $post->delete();}

```

#

# Dependency injectionYou can use Laravel dependency injection by type-hinting parameters in your action signature.

```

phppublic function delete(PostRepository $posts, $postId){    $posts->deletePost($postId);}

```

#

# Event listenersLivewire supports a variety of event listeners, allowing you to respond to many browser events:- `wire:click`- `wire:submit`- `wire:keydown`- `wire:keyup`- `wire:mouseenter`

#

#

# Listening for specific keysUse key aliases like `wire:keydown.enter`:

```

blade<input wire:model="query" wire:keydown.enter="searchPosts">

```

Key modifiers include:- `.shift`- `.enter`- `.space`- `.ctrl`- `.cmd`- `.meta`- `.alt`- `.up` / `.down` / `.left` / `.right`- `.escape`- `.tab`- `.caps-lock`- `.equal`- `.period`- `.slash`

#

#

# Event handler modifiersBecause `wire:` uses Alpine's `x-on` directive under the hood, you can use Alpine modifiers.Common modifiers:- `.prevent`- `.stop`- `.window`- `.outside`- `.document`- `.once`- `.debounce` / `.debounce.100ms`- `.throttle` / `.throttle.100ms`- `.self`- `.camel`- `.dot`- `.passive`- `.capture`Example:

```

blade<input wire:keydown.prevent="...">

```

#

#

# Handling third-party eventsExample listening for `trix-change`:

```

blade<trix-editor wire:trix-change="setPostContent($event.target.value)"></trix-editor>

```

A more performant approach is to update client-side with Alpine:

```

blade<trix-editor x-on:trix-change="$wire.content = $event.target.value"></trix-editor>

```

#

#

# Listening for dispatched custom events

```

blade<div wire:custom-event="...">    <button x-on:click="$dispatch('custom-event')">...</button></div>

```

Listen for events dispatched outside the component using `.window`:

```

blade<div wire:custom-event.window="...">...</div>

```

#

# Disabling inputs while a form is being submittedLivewire automatically disables inputs while a `wire:submit` action is processing.Use `wire:loading` to show feedback:

```

blade<form wire:submit="save">    <textarea wire:model="content"></textarea>    <button type="submit">Save</button>    <span wire:loading>Saving...</span></form>

```

Or use Tailwind with `data-loading`:

```

blade<form wire:submit="save">    <textarea wire:model="content"></textarea>    <button type="submit" class="data-loading:opacity-50">Save</button>    <span class="not-data-loading:hidden">Saving...</span></form>

```

#

# Refreshing a componentUse the `$refresh` magic action:

```

blade<button type="button" wire:click="$refresh">...</button>

```

From Alpine:

```

blade<button type="button" x-on:click="$wire.$refresh()">...</button>

```

#

# Confirming an actionUse `wire:confirm`:

```

blade<button    type="button"    wire:click="delete"    wire:confirm="Are you sure you want to delete this post?">    Delete post</button>

```

#

# Calling actions from AlpineLivewire exposes `$wire` to Alpine, and you can invoke actions:

```

blade<button x-on:click="$wire.save()">Save Post</button>

```

Pass parameters:

```

blade<div x-data="{ todo: '' }">    <input type="text" x-model="todo">    <button x-on:click="$wire.addTodo(todo)">Add Todo</button></div>

```

#

# Receiving return valuesInvoked `$wire` actions return a promise that resolves with the value returned by the backend action.

```

blade<span x-init="$el.innerHTML = await $wire.getPostCount()"></span>

```

For actions primarily consumed by JavaScript, consider `#[Json]`.

#

# JavaScript actionsYou can define JavaScript actions that run client-side (useful for optimistic UI updates).Example bookmark (optimistic):

```

blade<div>    <button wire:click="$js.bookmark" class="flex items-center gap-1">        {{-- Outlined bookmark icon... --}}        <svg wire:show="!bookmarked" wire:cloak>...</svg>        {{-- Solid bookmark icon... --}}        <svg wire:show="bookmarked" wire:cloak>...</svg>    </button></div><script>    this.$js.bookmark = () => {        $wire.bookmarked = ! $wire.bookmarked        $wire.bookmarkPost()    }</script>

```

For class-based components, wrap scripts with `@script`/`@endscript`.

#

#

# Calling from Alpine

```

blade<button x-on:click="$wire.$js.bookmark()">Bookmark</button>

```

#

#

# Calling from PHP

```

php$this->js('onPostSaved');

```

#

# Magic actionsLivewire provides magic actions for common tasks:- `$parent`- `$set`- `$refresh`- `$toggle`- `$dispatch`- `$event`Examples:

```

blade<button wire:click="$parent.removePost({{ $post->id }})">Remove</button><button wire:click="$set('query', '')">Reset Search</button><button wire:click="$refresh">Refresh</button><button wire:click="$toggle('sortAsc')">Toggle Sort</button><button wire:click="$dispatch('post-deleted')">Delete Post</button>

```

`$event` gives you access to the underlying JavaScript event:

```

blade<input type="text" wire:keydown.enter="search($event.target.value)">

```

#

# Skipping re-rendersMark an action `#[Renderless]` to skip re-rendering after the action runs:

```

php#[Renderless]public function incrementViewCount(){    $this->post->incrementViewCount();}

```

Or call `skipRender()`:

```

phppublic function incrementViewCount(){    $this->post->incrementViewCount();    $this->skipRender();}

```

You can also use `.renderless` on an element:

```

blade<button type="button" wire:click.renderless="incrementViewCount">

```

#

# Parallel execution with asyncBy default, Livewire serializes actions within the same component. Use async when you want an action to run in parallel.

#

#

# Using the async modifier

```

blade<button wire:click.async="logActivity">Track Event</button>

```

#

#

# Using the Async attribute

```

phpuse Livewire\Attributes\Async;#[Async]public function logActivity(){    Activity::log('post-viewed', $this->post);}

```

#

#

# When to use async actionsUse async for fire-and-forget side effects (analytics/logging, background jobs, JS-only results).

#

#

# When NOT to use async actionsDon’t use async actions for UI state mutation (race conditions / lost updates).

#

# Preserving scroll positionUse `.preserve-scroll`:

```

blade<button wire:click.preserve-scroll="loadMore">Load More</button><select wire:model.live.preserve-scroll="category">...</select>

```

#

# Security concernsActions are callable by users even if there is no UI affordance for them. Always authorize.- **Always authorize action parameters**- **Always authorize server-side**- **Keep dangerous methods protected or private**Example: don’t leave internal destructive helpers as public methods.

#

# See also- [Events](events.md) — Communicate between components using events- [Forms](forms.md) — Handle form submissions with actions- [Loading States](../features/loading-states.md) — Show feedback while actions are processing- [wire:click](../html-directives/wire-click.md) — Trigger actions from button clicks- [Validation](../features/validation.md) — Validate data before processing actions
