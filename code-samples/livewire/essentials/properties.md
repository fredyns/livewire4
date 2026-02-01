# Properties

source: https://livewire.laravel.com/docs/4.x/propertiesProperties store and manage state inside your Livewire components. They are defined as public properties on component classes and can be accessed and modified on both the server and client-side.

#

# Initializing propertiesYou can set initial values for properties within your component's `mount()` method.

```

php<?php// resources/views/components/⚡todos.blade.phpuse Livewire\Component;new class extends Component{    public $todos = [];    public $todo = '';    public function mount()    {        $this->todos = ['Buy groceries', 'Walk the dog', 'Write code'];    }    // ...};

```

#

# Bulk assignmentSometimes initializing many properties in `mount()` can feel verbose. Livewire provides `fill()` to assign multiple properties at once.

```

php<?php// resources/views/components/post/⚡edit.blade.phpuse App\Models\Post;use Livewire\Component;new class extends Component{    public $post;    public $title;    public $description;    public function mount(Post $post)    {        $this->post = $post;        $this->fill(            $post->only('title', 'description'),        );    }    // ...};

```

#

# Data bindingLivewire supports two-way data binding through the `wire:model` HTML attribute. This allows you to easily synchronize data between component properties and HTML inputs.Example binding a `$todo` property:

```

php<?php// resources/views/components/⚡todos.blade.phpuse Livewire\Component;new class extends Component{    public $todos = [];    public $todo = '';    public function add()    {        $this->todos[] = $this->todo;        $this->todo = '';    }    // ...};

```

```

blade<div>    <input type="text" wire:model="todo" placeholder="Todo...">    <button wire:click="add">Add Todo</button>    <ul>        @foreach ($todos as $todo)            <li wire:key="{{ $loop->index }}">{{ $todo }}</li>        @endforeach    </ul></div>

```

#

# Resetting propertiesTo reset one or more properties back to their initial state (before `mount()`), use `reset()`.

```

php<?php// resources/views/components/⚡todos.blade.phpuse Livewire\Component;new class extends Component{    public $todos = [];    public $todo = '';    public function addTodo()    {        $this->todos[] = $this->todo;        $this->reset('todo');    }    // ...};

```

`reset()` will reset a property to its state before the `mount()` method was called.

#

# Pulling propertiesUse `pull()` to both retrieve and reset a value in one operation:

```

phppublic function addTodo(){    $this->todos[] = $this->pull('todo');}

```

Pull multiple properties:

```

php$this->pull();$this->pull(['title', 'content']);

```

#

# Supported property typesLivewire properties are dehydrated (serialized) to JSON between requests, and hydrated back to PHP on the next request.

#

#

# Primitive typesLivewire supports:- Array- String- Integer- Float- Boolean- Null

```

phpnew class extends Component{    public array $todos = [];    public string $todo = '';    public int $maxTodos = 10;    public bool $showTodos = false;    public ?string $todoFilter = null;};

```

#

#

# Common PHP typesLivewire also supports common Laravel/PHP types, including:- `BackedEnum`- `Illuminate\Support\Collection`- `Illuminate\Database\Eloquent\Collection`- `Illuminate\Database\Eloquent\Model`- `DateTime`- `Carbon\Carbon`- `Illuminate\Support\Stringable`Example:

```

phppublic function mount(){    $this->todos = collect([]); // Collection    $this->todos = Todos::all(); // Eloquent Collection    $this->todo = Todos::first(); // Model    $this->date = new DateTime('now'); // DateTime    $this->date = new Carbon('now'); // Carbon    $this->todo = str(''); // Stringable}

```

#

# Supporting custom types (Wireables)Wireables are any class in your application that implements the `Wireable` interface.Example unsupported type:

```

phpclass Customer{    protected $name;    protected $age;    public function __construct($name, $age)    {        $this->name = $name;        $this->age = $age;    }}

```

Implement `Wireable` to teach Livewire how to serialize/deserialize:

```

phpuse Livewire\Wireable;class Customer implements Wireable{    protected $name;    protected $age;    public function __construct($name, $age)    {        $this->name = $name;        $this->age = $age;    }    public function toLivewire()    {        return [            'name' => $this->name,            'age' => $this->age,        ];    }    public static function fromLivewire($value)    {        $name = $value['name'];        $age = $value['age'];        return new static($name, $age);    }}

```

#

# Accessing properties from JavaScript

#

#

# Accessing propertiesLivewire exposes a magic `$wire` object to Alpine.Example showing a character count:

```

blade<div>    <input type="text" wire:model="todo">    Todo character length:    <h2 x-text="$wire.todo.length"></h2></div>

```

#

#

# Manipulating propertiesUpdate without sending a request:

```

blade<div>    <input type="text" wire:model="todo">    <button x-on:click="$wire.todo = ''">Clear</button></div>

```

Or use `$wire.set()` (by default triggers a request):

```

blade<button x-on:click="$wire.set('todo', '')">Clear</button>

```

To set without a request, pass `false` as the third argument:

```

blade<button x-on:click="$wire.set('todo', '', false)">Clear</button>

```

#

# Security concernsAlways treat public properties as user input. Validate and authorize before persisting.

#

#

# Don't trust property valuesA malicious user can add inputs in the browser and bind to properties you didn’t intend.To mitigate:- Authorize the input- Lock the property from updatesYou can lock a property using `#[Locked]`:

```

phpuse Livewire\Attributes\Locked;use Livewire\Component;new class extends Component{    #[Locked]    public $id;    // ...};

```

#

#

# Properties expose system information to the browserDehydrated model properties may include class names.You can use Laravel morph maps to alias model class names:

```

php<?phpnamespace App\Providers;use Illuminate\Database\Eloquent\Relations\Relation;use Illuminate\Support\ServiceProvider;class AppServiceProvider extends ServiceProvider{    public function boot()    {        Relation::morphMap([            'post' => 'App\\Models\\Post',        ]);    }}

```

#

#

# Eloquent constraints aren't preserved between requestsEloquent query constraints like `select(...)` won't be preserved on subsequent requests if you store Eloquent collections as properties.Prefer computed properties for Eloquent queries:

```

php<?phpuse Illuminate\Support\Facades\Auth;use Livewire\Attributes\Computed;use Livewire\Component;new class extends Component{    #[Computed]    public function todos()    {        return Auth::user()            ->todos()            ->select(['title', 'content'])            ->get();    }    public function markAllComplete()    {        $this->todos->each->complete();    }};

```

Access computed properties from Blade via `$this->todos`.

#

# See also- [Forms](forms.md) — Bind properties to form inputs with wire:model- [Computed Properties](../features/computed-properties.md) — Create derived values with automatic memoization- [Validation](../features/validation.md) — Validate property values before persisting- [Locked Attribute](../php-attributes/locked.md) — Prevent properties from being manipulated client-side- [Alpine](../features/alpine.md) — Access and manipulate properties from JavaScript
