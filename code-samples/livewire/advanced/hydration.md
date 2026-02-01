# Hydration

source: https://livewire.laravel.com/docs/4.x/hydrationUsing Livewire can feel like attaching a server-side PHP class directly to the browser. In reality, Livewire renders static HTML, listens for browser events, and makes stateless AJAX requests to invoke server-side code.Because each request is stateless, Livewire must re-create the last-known state of a component before making updates. It does this by taking “snapshots” of component state after each update (“dehydration”), and re-creating the component from snapshots (“hydration”).#

# DehydratingWhen Livewire dehydrates a component, it:- Renders the component template to HTML- Creates a JSON snapshot of the component

##

# Rendering HTMLAfter mount or update, Livewire calls `render()` to convert a Blade template to raw HTML.Example counter component:

```

php<?phpuse Livewire\Component;new class extends Component {    public $count = 1;    public function increment()    {        $this->count++;    }    public function render()    {        return <<<'HTML'            <div>                Count: {{ $count }}                <button wire:click="increment">+</button>            </div>        HTML;    }};

```

Rendered HTML:

```

html<div>    Count: 1    <button wire:click="increment">+</button></div>

```

##

# The snapshotA JSON snapshot is created attempting to capture component state:

```

js{  state: {    count: 1,  },  memo: {    name: 'counter',    id: '1526456',  },}

```

The `memo` portion identifies and re-creates the component. The `state` portion stores public property values.

##

# Embedding the snapshot in the HTMLOn first render, Livewire embeds the snapshot as JSON inside `wire:snapshot`:

```

html<div wire:id="..." wire:snapshot="{ state: {...}, memo: {...} }">    Count: 1    <button wire:click="increment">+</button></div>

```

#

# HydratingWhen a component update is triggered (e.g. clicking “+”), a payload like this is sent:

```

js{  calls: [    { method: 'increment', params: [] },  ],  snapshot: {    state: { count: 1 },    memo: { name: 'counter', id: '1526456' },  },}

```

Before invoking `increment`, Livewire creates a new instance and seeds it with snapshot state.Pseudo-code:

```

php$state = request('snapshot.state');$memo = request('snapshot.memo');$instance = Livewire::new($memo['name'], $memo['id']);foreach ($state as $property => $value) {    $instance[$property] = $value;}

```

#

# Advanced hydrationLivewire supports sophisticated property types (collections, models, carbon instances, stringables, etc.) by associating metadata with state using tuples.

##

# Deeply nested tuplesExample: a collection property is dehydrated as a tuple:

```

jsstate: {  todos: [    ['first', 'second', 'third'],    { s: 'clctn', class: 'Illuminate\\Support\\Collection' },  ],}

```

Livewire uses the metadata to re-hydrate the state back to the correct PHP type:

```

php[ $state, $metadata ] = request('snapshot.state.todos');$collection = new $metadata['class']($state);

```

It also supports deeply nested tuples. For example, a Stringable inside a Collection is represented as nested tuples:

```

jstodos: [  [    'first',    'second',    ['third', { s: 'str' }],  ],  { s: 'clctn', class: 'Illuminate\\Support\\Collection' },],

```

##

# Supporting custom property typesIf you need to support types Livewire doesn’t handle natively, you can do so using Synthesizers.

source: https://livewire.laravel.com/docs/4.x/synthesizers#

# See also-
- -
-
