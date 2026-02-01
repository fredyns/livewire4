# Events

source: https://livewire.laravel.com/docs/4.x/eventsLivewire offers a robust event system that you can use to communicate between different components on the page. Because it uses browser events under the hood, you can also use Livewire's event system to communicate with Alpine components or even plain, vanilla JavaScript.To trigger an event, you may use the `dispatch()` method from anywhere inside your component and listen for that event from any other component on the page.

#

# Dispatching eventsTo dispatch an event from a Livewire component, call `dispatch()`, passing the event name and any additional data you want to send along with the event.

```

php<?php// resources/views/components/post/⚡create.blade.phpuse Livewire\Component;new class extends Component{    public function save()    {        // ...        $this->dispatch('post-created');    }};

```

Pass additional data:

```

php$this->dispatch('post-created', title: $post->title);

```

#

# Listening for eventsTo listen for an event in a Livewire component, add the `#[On]` attribute above the method you want to be called when a given event is dispatched.

```

php<?php// resources/views/components/⚡dashboard.blade.phpuse Livewire\Attributes\On;use Livewire\Component;new class extends Component{    #[On('post-created')]    public function updatePostList($title)    {        // ...    }};

```

#

# Listening for dynamic event namesYou can dynamically generate event listener names at run-time.Dispatching with an ID:

```

php$this->dispatch("post-updated.{$post->id}");

```

Listening for the specific model:

```

php#[On('post-updated.{post.id}')]public function refreshPost(){    // ...}

```

#

# Listening for events from specific child componentsYou can listen for events directly on individual child components in your Blade template:

```

blade<div>    <livewire:edit-post @saved="$refresh">        <!-- ... -->    </livewire:edit-post></div>

```

Instead of `$refresh`, you can pass any method:

```

blade<livewire:edit-post @saved="close">

```

If the child dispatched parameters (e.g. `$this->dispatch('saved', postId: 1)`), you can forward those values:

```

blade<livewire:edit-post @saved="close($event.detail.postId)">

```

#

# Using JavaScript to interact with events

#

#

# Listening for events inside component scripts

```

html<script>    this.$on('post-created', () => {        // ...    })</script>

```

#

#

# Dispatching events from component scripts

```

html<script>    this.$dispatch('post-created')</script>

```

To dispatch only to the component where the script resides (no bubbling), use `dispatchSelf()`:

```

jsthis.$dispatchSelf('post-created')

```

Pass parameters via an object:

```

html<script>    this.$dispatch('post-created', { refreshPosts: true })</script>

```

Receive the parameter in Livewire:

```

php#[On('post-created')]public function handleNewPost($refreshPosts = false){    // ...}

```

Or in JavaScript via `event.detail`:

```

html<script>    this.$on('post-created', (event) => {        let refreshPosts = event.detail.refreshPosts        // ...    })</script>

```

#

#

# Listening for Livewire events from global JavaScriptListen globally using `Livewire.on`:

```

html<script>    document.addEventListener('livewire:init', () => {        let cleanup = Livewire.on('post-created', (event) => {            // ...        })        // cleanup() will un-register the above event listener...        cleanup()    })</script>

```

#

# Events in AlpineListen for a Livewire event in Alpine:

```

html<div x-on:post-created="..."></div>

```

Listen globally:

```

html<div x-on:post-created.window="..."></div>

```

Access data with `$event.detail`:

```

html<div x-on:post-created="notify('New post: ' + $event.detail.title)"></div>

```

Dispatch from Alpine:

```

html<button x-on:click="$dispatch('post-created')">...</button>

```

With data:

```

html<button x-on:click="$dispatch('post-created', { title: 'Post Title' })">...</button>

```

If you are using events to call behavior on a parent from a child, you can instead call the action directly from the child using `$parent` in your Blade template:

```

blade<button wire:click="$parent.showCreatePostForm()">Create Post</button>

```

#

# Dispatching directly to another componentIf you want to communicate directly between components, you can use the `dispatch()->to()` modifier:

```

php$this->dispatch('post-created')->to(component: Dashboard::class);

```

#

# Dispatching a component event to itselfUsing the `dispatch()->self()` modifier, you can restrict an event to only being intercepted by the component it was triggered from:

```

php$this->dispatch('post-created')->to(self: true);

```

#

# Dispatching events from Blade templatesDispatch an event using the `$dispatch` JavaScript function:

```

blade<button wire:click="$dispatch('show-post-modal', { id: {{ $post->id }} })">    EditPost</button>

```

Dispatch to another component using `$dispatchTo()`:

```

blade<button wire:click="$dispatchTo('posts', 'show-post-modal', { id: {{ $post->id }} })">    EditPost</button>

```

#

# Testing dispatched eventsAssert an event was dispatched:

```

php<?phpnamespace Tests\Feature;use App\Livewire\CreatePost;use Illuminate\Foundation\Testing\RefreshDatabase;use Livewire\Livewire;class CreatePostTest extends TestCase{    use RefreshDatabase;    public function test_it_dispatches_post_created_event()    {        Livewire::test(CreatePost::class)            ->call('save')            ->assertDispatched('post-created');    }}

```

#

# Testing Event ListenersDispatch and assert the listener updates:

```

php<?phpnamespace Tests\Feature;use App\Livewire\Dashboard;use Illuminate\Foundation\Testing\RefreshDatabase;use Livewire\Livewire;class DashboardTest extends TestCase{    use RefreshDatabase;    public function test_it_updates_post_count_when_a_post_is_created()    {        Livewire::test(Dashboard::class)            ->assertSee('Posts created: 0')            ->dispatch('post-created')            ->assertSee('Posts created: 1');    }}

```

#

# Real-time events using Laravel Echo

#

#

# Listening for Echo eventsExample Laravel event:

```

php<?phpnamespace App\Events;use App\Models\Order;use Illuminate\Broadcasting\Channel;use Illuminate\Broadcasting\InteractsWithSockets;use Illuminate\Contracts\Broadcasting\ShouldBroadcast;use Illuminate\Foundation\Events\Dispatchable;use Illuminate\Queue\SerializesModels;class OrderShipped implements ShouldBroadcast{    use Dispatchable, InteractsWithSockets, SerializesModels;    public Order $order;    public function broadcastOn()    {        return new Channel('orders');    }}

```

Listen via Livewire:

```

php<?phpuse Livewire\Attributes\On;use Livewire\Component;new class extends Component{    public $showNewOrderNotification = false;    #[On('echo:orders,OrderShipped')]    public function notifyNewOrder()    {        $this->showNewOrderNotification = true;    }};

```

If channel names are dynamic, use `getListeners()`:

```

phppublic function getListeners(){    return [        "echo:orders.{$this->order->id},OrderShipped" => 'notifyShipped',    ];}

```

Or dynamic event syntax:

```

php#[On('echo:orders.{order.id},OrderShipped')]public function notifyNewOrder($event){    $order = Order::find($event['orderId']);    // ...}

```

#

#

# Customizing broadcast event names with `broadcastAs()`If you customize the broadcast name, you must prefix it with a dot (`.`) when listening:

```

php#[On('echo:scores,.score.submitted')]public function handleScoreSubmitted($event){    $this->scores[] = $event['score'];}

```

#

#

# Private & presence channelsYou may listen to events broadcast to private and presence channels (ensure authentication callbacks are configured):

```

phppublic function getListeners(){    return [        // Public:        'echo:orders,OrderShipped' => 'notifyNewOrder',        // Private:        'echo-private:orders,OrderShipped' => 'notifyNewOrder',        // Presence:        'echo-presence:orders,OrderShipped' => 'notifyNewOrder',        'echo-presence:orders,here' => 'notifyNewOrder',        'echo-presence:orders,joining' => 'notifyNewOrder',        'echo-presence:orders,leaving' => 'notifyNewOrder',    ];}

```

#

# See also- [Nesting](../advanced/nesting.md) — Communicate between parent and child components- [Actions](actions.md) — Trigger events from component actions- [Alpine](../features/alpine.md) — Dispatch and listen for events with Alpine- [On Attribute](../php-attributes/on.md) — Listen for events using the `#[On]` attribute
