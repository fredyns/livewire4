# Morphing

source: https://livewire.laravel.com/docs/4.x/morphing

When a Livewire component updates the browser's DOM, it does so in an intelligent way we call ÃƒÂ¢Ã¢â€šÂ¬Ã…â€œmorphingÃƒÂ¢Ã¢â€šÂ¬Ã‚Â. Instead of replacing a component's HTML with newly rendered HTML every time a component is updated, Livewire compares the current HTML with the new HTML, identifies differences, and makes surgical changes only where needed.This preserves existing, unchanged elements (event listeners, focus state, input values) and improves performance compared to wiping and re-rendering the DOM on every update.

#

# How morphing works

To understand how Livewire determines which elements to update between requests, consider this simple Todos component:



```php
class Todos extends Component{    public $todo = '';    public $todos = [        'first',        'second',    ];    public function add()    {        $this->todos[] = $this->todo;    }}

```





```blade
<form wire:submit="add">    <ul>        @foreach ($todos as $item)            <li wire:key="{{ $loop->index }}">{{ $item }}</li>        @endforeach    </ul>    <input wire:model="todo"></form>

```



The initial render outputs:



```html
<form wire:submit="add">    <ul>        <li>first</li>        <li>second</li>    </ul>    <input wire:model="todo"></form>

```



After typing ÃƒÂ¢Ã¢â€šÂ¬Ã…â€œthirdÃƒÂ¢Ã¢â€šÂ¬Ã‚Â and pressing Enter, the newly rendered HTML would be:



```diff
<form wire:submit="add">    <ul>        <li>first</li>        <li>second</li>+       <li>third</li>    </ul>    <input wire:model="todo"></form>

```



Livewire walks both HTML trees simultaneously, comparing nodes and applying minimal changes.

#

# Morphing shortcomings

Morphing algorithms can fail to correctly identify whether an intermediate element is an insertion or a mutation.

#

#

# Inserting intermediate elements

Consider this Blade template:



```blade
<form wire:submit="save">    <div>        <input wire:model="title">    </div>    @if ($errors->has('title'))        <div>{{ $errors->first('title') }}</div>    @endif    <div>        <button>Save</button>    </div></form>

```



On validation error, Livewire can incorrectly treat the newly inserted `<div>` as an existing `<div>` and mutate the wrong element (e.g. turning the `<button>` into the error message), then append a new element afterward.This scenario is at the root of many morph-related bugs:- Event listeners and element state are lost between updates- State/listeners can be misplaced across the wrong elements- Entire Livewire components can be reset or duplicated- Alpine components/state can be lost or misplaced

#

#

# Internal look-ahead

Livewire includes a look-ahead step that checks subsequent elements and contents before changing an element, preventing many of these issues.

#

#

# Injecting morph markers

Livewire also automatically detects Blade conditionals and wraps them in HTML comment markers to guide morphing:



```blade
<form wire:submit="save">    <div>        <input wire:model="title">    </div>    <!--[if BLOCK]><![endif]-->    @if ($errors->has('title'))        <div>Error: {{ $errors->first('title') }}</div>    @endif    <!--[if ENDBLOCK]><![endif]-->    <div>        <button>Save</button>    </div></form>

```



If this feature causes problems, you can disable it in `config/livewire.php`:



```php
'inject_morph_markers' => false,

```



#

#

# Wrapping conditionals

If the above doesnÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢t cover your situation, the most reliable approach is to wrap conditionals and loops in their own always-present elements:



```blade
<form wire:submit="save">    <div>        <input wire:model="title">    </div>    <div>        @if ($errors->has('title'))            <div>{{ $errors->first('title') }}</div>        @endif    </div>    <div>        <button>Save</button>    </div></form>

```



#

# Bypassing morphing

If you need to bypass morphing for an element, use `wire:replace` to replace children instead of morphing:

source: https://livewire.laravel.com/docs/4.x/wire-replac

e

#

# See also
- -
-
