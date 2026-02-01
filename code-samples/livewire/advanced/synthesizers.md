# Synthesizers

source: https://livewire.laravel.com/docs/4.x/synthesizersBecause Livewire components are dehydrated (serialized) into JSON and hydrated back into PHP between requests, component properties must be JSON-serializable.PHP serializes primitive values easily, but more sophisticated property types (models, collections, Carbon instances, Stringables, etc.) require a more robust system.Livewire provides an extension point called “Synthesizers” so you can support custom property types.Before using Synthesizers, it’s helpful to understand hydration:

source: https://livewire.laravel.com/docs/4.x/hydration#

# Understanding SynthesizersLivewire uses internal Synthesizers to support built-in types. For example, it supports Laravel Stringables.Example component:

```

phpclass CreatePost extends Component{    public $title = '';}

```

This serializes as:

```

jsstate: { title: '' },

```

If `$title` is a Stringable:

```

phpclass CreatePost extends Component{    public $title = '';    public function mount()    {        $this->title = str($this->title);    }}

```

The dehydrated state becomes a metadata tuple:

```

jsstate: { title: ['', { s: 'str' }] },

```

Livewire uses the tuple to hydrate `$title` back into a Stringable.Example internal stringable synth:

```

phpuse Illuminate\Support\Stringable;class StringableSynth extends Synth{    public static $key = 'str';    public static function match($target)    {        return $target instanceof Stringable;    }    public function dehydrate($target)    {        return [$target->__toString(), []];    }    public function hydrate($value)    {        return str($value);    }}

```

#

# Registering a custom SynthesizerExample component using a custom Address DTO:

```

phpclass UpdateProperty extends Component{    public Address $address;    public function mount()    {        $this->address = new Address();    }}

```

Address class:

```

phpnamespace App\Dtos\Address;class Address{    public $street = '';    public $city = '';    public $state = '';    public $zip = '';}

```

Synthesizer:

```

phpuse App\Dtos\Address;class AddressSynth extends Synth{    public static $key = 'address';    public static function match($target)    {        return $target instanceof Address;    }    public function dehydrate($target)    {        return [[            'street' => $target->street,            'city' => $target->city,            'state' => $target->state,            'zip' => $target->zip,        ], []];    }    public function hydrate($value)    {        $instance = new Address;        $instance->street = $value['street'];        $instance->city = $value['city'];        $instance->state = $value['state'];        $instance->zip = $value['zip'];        return $instance;    }}

```

Register globally in a service provider:

```

phpclass AppServiceProvider extends ServiceProvider{    public function boot(): void    {        Livewire::propertySynthesizer(AddressSynth::class);    }}

```

#

# Supporting data bindingTo support `wire:model` binding to nested properties of the custom object, implement `get()` and `set()`:

```

phpuse App\Dtos\Address;class AddressSynth extends Synth{    public static $key = 'address';    public static function match($target)    {        return $target instanceof Address;    }    public function dehydrate($target)    {        return [[            'street' => $target->street,            'city' => $target->city,            'state' => $target->state,            'zip' => $target->zip,        ], []];    }    public function hydrate($value)    {        $instance = new Address;        $instance->street = $value['street'];        $instance->city = $value['city'];        $instance->state = $value['state'];        $instance->zip = $value['zip'];        return $instance;    }    public function get(&$target, $key)    {        return $target->{$key};    }    public function set(&$target, $key, $value)    {        $target->{$key} = $value;    }}

```
