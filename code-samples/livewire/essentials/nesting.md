# Nesting Components

source: https://livewire.laravel.com/docs/4.x/nestingLivewire allows you to nest additional Livewire components inside of a parent component. This feature is immensely powerful, as it allows you to re-use and encapsulate behavior within Livewire components that are shared across your application.Before you extract a portion of your template into a nested Livewire component, ask yourself: does this content need to be "live"? If not, consider a Blade component instead.If you want to isolate re-rendering to specific regions without creating separate child components, consider using islands instead.

#

# Nesting a componentTo nest a Livewire component within a parent component, include it in the parent component's Blade view.Example:

```

php<?php// resources/views/components/⚡dashboard.blade.phpuse Livewire\Component;new class extends Component{    //};?><div>    <h1>Dashboard</h1>    <livewire:todos /></div>

```

On the initial render, the parent will render `<livewire:todos />` in place. On subsequent requests to the parent, the nested component will skip rendering because it is now its own independent component on the page.

#

# Passing props to childrenPassing data from a parent component to a child component is like passing props to a Blade component.Example passing `$todos` to a `todo-count` child:

```

php<?php// resources/views/components/⚡todos.blade.phpuse Illuminate\Support\Facades\Auth;use Livewire\Attributes\Computed;use Livewire\Component;new class extends Component{    #[Computed]    public function todos()    {        return Auth::user()->todos;    }};?><div>    <livewire:todo-count :todos="$this->todos" /></div>

```

Receive the prop via `mount()`:

```

php<?php// resources/views/components/⚡todo-count.blade.phpuse Livewire\Attributes\Computed;use Livewire\Component;new class extends Component{    public $todos;    public function mount($todos)    {        $this->todos = $todos;    }    #[Computed]    public function count()    {        return $this->todos->count();    }};?><div>    Count: {{ $this->count }}</div>

```

If the `mount()` method feels redundant, it can be omitted as long as the property and parameter names match.

#

#

# Passing static propsFor a static value, omit the colon:

```

blade<livewire:todo-count :todos="$todos" label="Todo Count:" />

```

Boolean values can be passed by only specifying the key:

```

blade<livewire:todo-count :todos="$todos" inline />

```

#

#

# Shortened attribute syntaxTo avoid writing the prop name twice:

```

diff- <livewire:todo-count :todos="$todos" />+ <livewire:todo-count :$todos />

```

#

# Rendering children in a loopWhen rendering a child component within a loop, include a unique key value for each iteration.

```

blade<div>    <h1>Todos</h1>    @foreach ($todos as $todo)        <livewire:todo-item :$todo :wire:key="$todo->id" />    @endforeach</div>

```

#

# Reactive propsLivewire props are not reactive by default because every component is independent.If you need a prop to be reactive, use the `#[Reactive]` attribute.

```

php<?php// resources/views/components/⚡todo-count.blade.phpuse Livewire\Attributes\Computed;use Livewire\Attributes\Reactive;use Livewire\Component;new class extends Component{    #[Reactive]    public $todos;    #[Computed]    public function count()    {        return $this->todos->count();    }};?><div>    Count: {{ $this->count }}</div>

```

#

# Binding to child data using `wire:model` (Modelable)You can bind directly to a child component using `wire:model` via Livewire's Modelable feature.Example parent using a `todo-input` child as if it were a native input:

```

php<?php// resources/views/components/⚡todos.blade.phpuse App\Models\Todo;use Illuminate\Support\Facades\Auth;use Livewire\Attributes\Computed;use Livewire\Component;new class extends Component{    public $todo = '';    public function add()    {        Todo::create([            'content' => $this->pull('todo'),        ]);    }    #[Computed]    public function todos()    {        return Auth::user()->todos;    }};

```

```

blade<div>    <h1>Todos</h1>    <livewire:todo-input wire:model="todo" />    <button wire:click="add">Add Todo</button>    <div>        @foreach ($this->todos as $todo)            <livewire:todo-item :$todo :wire:key="$todo->id" />        @endforeach    </div></div>

```

Child component using `#[Modelable]`:

```

php<?php// resources/views/components/⚡todo-input.blade.phpuse Livewire\Attributes\Modelable;use Livewire\Component;new class extends Component{    #[Modelable]    public $value = '';};?><div>    <input type="text" wire:model="value"></div>

```

#

# SlotsSlots allow you to pass Blade content from a parent into a child.Example parent passing a "Remove" button via the default slot:

```

php<?phpuse App\Models\Post;use Livewire\Attributes\Computed;use Livewire\Component;new class extends Component{    public Post $post;    #[Computed]    public function comments()    {        return $this->post->comments;    }    public function removeComment($id)    {        $this->post->comments()->find($id)->delete();    }};?><div>    @foreach ($this->comments as $comment)        <livewire:comment :$comment :wire:key="$comment->id">            <button wire:click="removeComment({{ $comment->id }})">Remove</button>        </livewire:comment>    @endforeach</div>

```

Child rendering `$slot`:

```

php<?phpuse App\Models\Comment;use Livewire\Component;new class extends Component{    public Comment $comment;};?><div>    <p>{{ $comment->author }}</p>    <p>{{ $comment->body }}</p>    {{ $slot }}</div>

```

Slots are evaluated in the parent context, meaning methods/properties referenced inside the slot belong to the parent, not the child.

#

#

# Named slots

```

blade<div>    @foreach ($this->comments as $comment)        <livewire:comment :$comment :wire:key="$comment->id">            <livewire:slot name="actions">                <button wire:click="removeComment({{ $comment->id }})">Remove</button>            </livewire:slot>            <span>Posted on {{ $comment->created_at }}</span>        </livewire:comment>    @endforeach</div>

```

Child accessing named slots:

```

blade<div>    <div class="actions">{{ $slots['actions'] }}</div>    <div class="metadata">{{ $slot }}</div></div>

```

#

#

# Checking if a slot was provided

```

blade@if ($slots->has('actions'))    <div class="actions">        {{ $slots['actions'] }}    </div>@endif

```

#

# Forwarding HTML attributesParents can forward attributes like `class`, `id`, and `data-*` using `$attributes`.Parent:

```

blade<livewire:comment :$comment class="border-b" />

```

Child:

```

blade<div {{ $attributes->class('bg-white rounded-md') }}>    <p>{{ $comment->author }}</p>    <p>{{ $comment->body }}</p></div>

```

Attributes that match public property names are automatically passed as props and excluded from `$attributes`.

#

# Islands vs nested componentsIslands are ideal when you want performance isolation without architectural complexity.Example island:

```

blade@island    <div>        Revenue: {{ $this->expensiveRevenue }}        <button wire:click="$refresh">Refresh</button>    </div>@endisland

```

Nested components are better when you need true encapsulation and reusability.Quick decision guide:- Does this need to be reusable? → Nested component- Does this need its own lifecycle methods? → Nested component- Am I just trying to optimize performance? → Island- Do I want to defer loading expensive content? → Island (`lazy` / `defer`)

#

# Listening for events from childrenExample using an event to trigger parent behavior:Add listener in parent via `#[On]`:

```

php#[On('remove-todo')]public function remove($todoId){    // ...}

```

Child dispatching:

```

phppublic function remove(){    $this->dispatch('remove-todo', todoId: $this->todo->id);}

```

#

#

# Improving performance by dispatching client-sideYou can avoid a network request by dispatching directly on the client:

```

blade<button wire:click="$dispatch('remove-todo', { todoId: {{ $todo->id }} })">Remove</button>

```

As a rule of thumb, always prefer dispatching client-side when possible.

#

#

# Directly accessing the parent from the childUse the `$parent` magic variable:

```

blade<button wire:click="$parent.remove({{ $todo->id }})">Remove</button>

```

#

# Dynamic child componentsRender a child component at run-time using `<livewire:dynamic-component ...>`:

```

blade<livewire:dynamic-component :is="$current" />

```

Example:

```

php<?php// resources/views/components/⚡steps.blade.phpuse Livewire\Component;new class extends Component{    public $current = 'step-one';    protected $steps = [        'step-one',        'step-two',        'step-three',    ];    public function next()    {        $currentIndex = array_search($this->current, $this->steps);        $this->current = $this->steps[$currentIndex + 1];    }};?><div>    <livewire:dynamic-component :is="$current" :wire:key="$current" />    <button wire:click="next">Next</button></div>

```

Alternative syntax:

```

blade<livewire:is :component="$current" :wire:key="$current" />

```

#

# Recursive componentsLivewire components may be nested recursively. Ensure you prevent infinite recursion.

```

php<?phpuse App\Models\Question;use Livewire\Attributes\Computed;use Livewire\Component;new class extends Component{    public Question $question;    #[Computed]    public function subQuestions()    {        return $this->question->subQuestions;    }};?><div>    Question: {{ $question->content }}    @foreach ($this->subQuestions as $subQuestion)        <livewire:survey-question :question="$subQuestion" :wire:key="$subQuestion->id" />    @endforeach</div>

```

#

# Forcing a child component to re-renderLivewire uses child component keys to track already-rendered children. If you want to force a child to re-render, you can change its key.Example:

```

blade<div>    <livewire:todo-count        :todos="$todos"        :wire:key="$todos->pluck('id')->join('-')"    /></div>

```

#

# See also- [Events](events.md) — Communicate between nested components- [Components](components.md) — Rendering and organizing components- [Islands](../features/islands.md) — Alternative to nesting for isolated updates- [Understanding Nesting](../advanced/nesting.md) — Deep dive into nesting performance and behavior- [Reactive Attribute](../php-attributes/reactive.md) — Make props reactive in nested components
