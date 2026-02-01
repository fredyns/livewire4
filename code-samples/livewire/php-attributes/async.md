# Async

source: https://livewire.laravel.com/docs/4.x/attribute-asyncThe `#[Async]` attribute allows actions to run in parallel without being queued, making them execute immediately even if other requests are in-flight.#

# Basic usageApply the `#[Async]` attribute to any action method that should run in parallel:

```

php<?php// resources/views/components/post/⚡show.blade.phpuse Livewire\Attributes\Async;use Livewire\Component;use App\Models\Post;new class extends Component {    public Post $post;    #[Async]    public function logActivity()    {        Activity::log('post-viewed', $this->post);    }};

```

```

blade<div wire:intersect="logActivity">    <!-- Logs activity asynchronously when element enters viewport --></div>

```

When `logActivity()` is called, it executes immediately without blocking other requests or being blocked by them.#

# When to useUse `#[Async]` for fire-and-forget operations where the result doesn't affect what's displayed on the page:- Analytics and logging
- Tracking user behavior, page views, or interactions- Background operations
- Triggering jobs, sending notifications, or updating external services- JavaScript-only results
- Fetching data via `await $wire.getData()` that will be consumed purely by JavaScriptExample tracking external link clicks:

```

php<?php// resources/views/components/⚡external-link.blade.phpuse Livewire\Attributes\Async;use Livewire\Component;new class extends Component {    public $url;    #[Async]    public function trackClick()    {        Analytics::track('external-link-clicked', [            'url' => $this->url,            'user_id' => auth()->id(),        ]);    }};

```

```

blade<a href="{{ $url }}" target="_blank" wire:click="trackClick">    Visit External Site</a>

```

Because tracking happens asynchronously, the user's click isn't delayed by the network request.#

# When NOT to useNever use async actions if they modify component state that's reflected in your UI.Because async actions run in parallel, you can end up with unpredictable race conditions where your component's state diverges across multiple simultaneous requests.Dangerous example:

```

php// Warning: This snippet demonstrates what NOT to do...<?php// resources/views/components/⚡counter.blade.phpuse Livewire\Attributes\Async;use Livewire\Component;new class extends Component {    public $count = 0;    #[Async] // Don't do this!    public function increment()    {        $this->count++; // State mutation in an async action    }};

```

If a user rapidly clicks the increment button, multiple async requests fire simultaneously. Each request starts with the same initial `$count` value, leading to lost updates.The rule of thumb: only use async for actions that perform pure side effects — operations that don't change any properties that affect your component's view.#

# Alternative approachInstead of using the attribute, you can make specific action calls async with the `.async` modifier:

```

blade<button wire:click.async="logActivity">Track Event</button>

```

This approach is useful when you want the action to be async in some places but synchronous in others.For more information about async actions, race conditions, and advanced use cases, see the Actions documentation.
