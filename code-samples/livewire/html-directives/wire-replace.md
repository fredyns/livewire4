# wire:replace

source: https://livewire.laravel.com/docs/4.x/wire-replace

Livewire

'

s DOM diffing is useful for updating existing elements on your page, but occasionally you may need to force some elements to render from scratch to reset internal state.In these cases, you can use the `wire:replace` directive to instruct Livewire to skip DOM diffing on the children of an element, and instead completely replace the content with the new elements from the server.This is most useful in the context of working with third-party JavaScript libraries and custom web components, or when element re-use could cause problems when keeping state.

#

# Basic usage

Example wrapping a web component with a shadow DOM in `wire:replace` so that Livewire completely replaces the element, allowing the custom element to handle its own life-cycle:



```blade
<form>    <!-- ... -->    <div wire:replace>        <!-- This custom element would have its own internal state -->        <json-viewer>@json($someProperty)</json-viewer>    </div>    <!-- ... --></form>

```



#

# Replacing self

You can also instruct Livewire to replace the target element as well as all children with `wire:replace.self`.



```blade
<div x-data="{open: false}" wire:replace.self>    <!-- Ensure that the "open" state is reset to false on each render --></div>

```



#

# Reference



```text
wire:replace

```





```text
wire:replace.self

```



#

#

# Modifiers
- `.self`
