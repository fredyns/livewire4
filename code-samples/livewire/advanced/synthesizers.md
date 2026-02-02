# Synthesizerssource: https://livewire.laravel.com/docs/4.x/synthesizers

Because Livewire components are dehydrated (serialized) into JSON and hydrated back into PHP between requests, component properties must be JSON-serializable.PHP serializes primitive values easily, but more sophisticated property types (models, collections, Carbon instances, Stringables, etc.) require a more robust system.Livewire provides an extension point called ÃƒÂ¢Ã¢â€šÂ¬Ã…â€œSynthesizersÃƒÂ¢Ã¢â€šÂ¬Ã‚Â so you can support custom property types.Before using Synthesizers, itÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢s helpful to understand hydration:

source: https://livewire.laravel.com/docs/4.x/hydratio

n

#

# Understanding Synthesizers

Livewire uses internal Synthesizers to support built-in types. For example, it supports Laravel Stringables.Example component:



```php
class CreatePost extends Component{    public $title = '';}

```



This serializes as:



```js
state: { title: '' },

```



If `$title` is a Stringable:



```php
class CreatePost extends Component{    public $title = '';    public function mount()    {        $this->title = str($this->title);    }}

```



The dehydrated state becomes a metadata tuple:



```js
state: { title: ['', { s: 'str' }] },

```



Livewire uses the tuple to hydrate `$title` back into a Stringable.Example internal stringable synth:



```php
use Illuminate\Support\Stringable;class StringableSynth extends Synth{    public static $key = 'str';    public static function match($target)    {        return $target instanceof Stringable;    }    public function dehydrate($target)    {        return [$target->__toString(), []];    }    public function hydrate($value)    {        return str($value);    }}

```



#

# Registering a custom Synthesizer

Example component using a custom Address DTO:



```php
class UpdateProperty extends Component{    public Address $address;    public function mount()    {        $this->address = new Address();    }}

```



Address class:



```php
namespace App\Dtos\Address;class Address{    public $street = '';    public $city = '';    public $state = '';    public $zip = '';}

```



Synthesizer:



```php
use App\Dtos\Address;class AddressSynth extends Synth{    public static $key = 'address';    public static function match($target)    {        return $target instanceof Address;    }    public function dehydrate($target)    {        return [[            'street' => $target->street,            'city' => $target->city,            'state' => $target->state,            'zip' => $target->zip,        ], []];    }    public function hydrate($value)    {        $instance = new Address;        $instance->street = $value['street'];        $instance->city = $value['city'];        $instance->state = $value['state'];        $instance->zip = $value['zip'];        return $instance;    }}

```



Register globally in a service provider:



```php
class AppServiceProvider extends ServiceProvider{    public function boot(): void    {        Livewire::propertySynthesizer(AddressSynth::class);    }}

```



#

# Supporting data binding

To support `wire:model` binding to nested properties of the custom object, implement `get()` and `set()`:



```php
use App\Dtos\Address;class AddressSynth extends Synth{    public static $key = 'address';    public static function match($target)    {        return $target instanceof Address;    }    public function dehydrate($target)    {        return [[            'street' => $target->street,            'city' => $target->city,            'state' => $target->state,            'zip' => $target->zip,        ], []];    }    public function hydrate($value)    {        $instance = new Address;        $instance->street = $value['street'];        $instance->city = $value['city'];        $instance->state = $value['state'];        $instance->zip = $value['zip'];        return $instance;    }    public function get(&$target, $key)    {        return $target->{$key};    }    public function set(&$target, $key, $value)    {        $target->{$key} = $value;    }}

```
