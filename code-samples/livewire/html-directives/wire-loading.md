# wire:loadingsource: https://livewire.laravel.com/docs/4.x/wire-loading

Loading indicators are an important part of crafting good user interfaces. They give users visual feedback when a request is being made to the server, so they know they are waiting for a process to complete.While `wire:loading` is great for simple show/hide scenarios, Livewire v4 introduces automatic `data-loading` attributes on elements that trigger network requests. This approach is often simpler and more flexibleÃ¢â‚¬â€you can style loading states directly with Tailwind without needing `wire:target` directives, and it works seamlessly even when dispatching events to other components.Learn more about data-loading.

#

# Basic usage

Livewire provides a simple yet extremely powerful syntax for controlling loading indicators: `wire:loading`.Adding `wire:loading` to any element will hide it by default (using `display: none` in CSS) and show it when a request is sent to the server.Basic example:



```blade
<form wire:submit="save">    <!-- ... -->    <button type="submit">Save</button>    <div wire:loading>        Saving post...    </div></form>

```



When a user presses "Save", the "Saving post..." message will appear below the button while the `save` action is being executed.

#

#

# Removing elements

You can append `.remove` for the inverse effect (show by default, hide during requests):



```blade
<div wire:loading.remove>...</div>

```



#

# Toggling classes

You can toggle CSS classes on and off during requests.Example using Tailwind's `opacity-50` to make a button fainter while submitting:



```blade
<button wire:loading.class="opacity-50">Save</button>

```



Inverse class operation by appending `.remove`:



```blade
<button class="bg-blue-500" wire:loading.class.remove="bg-blue-500">    Save</button>

```



#

# Toggling attributes

By default, when a form is submitted, Livewire will automatically disable the submit button and add the `readonly` attribute to each input element while the form is being processed.For elements outside of this default behavior, Livewire offers the `.attr` modifier:



```blade
<button type="button" wire:click="remove" wire:loading.attr="disabled">    Remove</button>

```



#

# Targeting specific actions

By default, `wire:loading` will be triggered whenever a component makes a request to the server.In components with multiple elements that can trigger server requests, you should scope your loading indicators down to individual actions using `wire:target`.



```blade
<form wire:submit="save">    <!-- ... -->    <button type="submit">Save</button>    <button type="button" wire:click="remove">Remove</button>    <div wire:loading wire:target="remove">        Removing post...    </div></form>

```



#

#

# Targeting multiple actions

You can pass multiple actions into `wire:target` separated by a comma:



```blade
<form wire:submit="save">    <input type="text" wire:model.live.blur="title">    <!-- ... -->    <button type="submit">Save</button>    <button type="button" wire:click="remove">Remove</button>    <div wire:loading wire:target="save, remove">        Updating post...    </div></form>

```



#

#

# Targeting action parameters

If the same action is triggered with different parameters from multiple places on a page, you can scope `wire:target` to a specific action invocation:



```blade
<div>    @foreach ($posts as $post)        <div wire:key="{{ $post->id }}">            <h2>{{ $post->title }}</h2>            <button wire:click="remove({{ $post->id }})">Remove</button>            <div wire:loading wire:target="remove({{ $post->id }})">                Removing post...            </div>        </div>    @endforeach</div>

```



#

#

# Targeting property updates

You can target specific component property updates by passing the property's name to the `wire:target` directive.Example where a real-time validation input uses `wire:model.live`:



```blade
<form wire:submit="save">    <input type="text" wire:model.live="username">    @error('username')        <span>{{ $message }}</span>    @enderror    <div wire:loading wire:target="username">        Checking availability of username...    </div>    <!-- ... --></form>

```



#

#

# Excluding specific loading targets

To display a loading indicator for every Livewire request except a specific property or action, use the `wire:target.except` modifier:



```blade
<div wire:loading wire:target.except="download">...</div>

```



#

# Customizing CSS display property

When `wire:loading` is added to an element, Livewire updates the CSS `display` property.By default, Livewire uses `none` to hide and `inline-block` to show.If you're toggling an element that uses a display value other than `inline-block` (like `flex`), you can append `.flex`:



```blade
<div class="flex" wire:loading.flex>...</div>

```



Available display values:



```blade
<div wire:loading.inline-flex>...</div><div wire:loading.inline>...</div><div wire:loading.block>...</div><div wire:loading.table>...</div><div wire:loading.flex>...</div><div wire:loading.grid>...</div>

```



#

# Delaying a loading indicator

On fast connections, updates often happen so quickly that loading indicators only flash briefly on the screen.Livewire provides a `.delay` modifier to delay the showing of an indicator:



```blade
<div wire:loading.delay>...</div>

```



The above element will only appear if the request takes over 200 milliseconds.To customize the delay, you can use one of Livewire's interval aliases:



```blade
<div wire:loading.delay.shortest>...</div> <!-- 50ms --><div wire:loading.delay.shorter>...</div> <!-- 100ms --><div wire:loading.delay.short>...</div> <!-- 150ms --><div wire:loading.delay>...</div> <!-- 200ms --><div wire:loading.delay.long>...</div> <!-- 300ms --><div wire:loading.delay.longer>...</div> <!-- 500ms --><div wire:loading.delay.longest>...</div> <!-- 1000ms -->

```



#

# Styling with data-loading

Livewire automatically adds a `data-loading` attribute to any element that triggers a network request. This allows you to style loading states directly with CSS or Tailwind without using `wire:loading` directives.

#

#

# Using Tailwind's data attribute variant



```blade
<button wire:click="save" class="data-loading:opacity-50 data-loading:pointer-events-none">    Save Changes</button>

```



#

#

# Using CSS



```css
[data-loading] {    opacity: 0.5;    pointer-events: none;}button[data-loading] {    background-color: #ccc;    cursor: wait;}

```



#

#

# Styling parent and child elements

Style parent elements when a child has `data-loading` using `has-data-loading:`:



```blade
<div class="has-data-loading:opacity-50">    <button wire:click="save">Save</button></div>

```



Style child elements from a parent with `data-loading` using `in-data-loading:`:



```blade
<button wire:click="save">    <span class="in-data-loading:hidden">Save</span>    <span class="hidden in-data-loading:block">Saving...</span></button>

```



#

# See also
- [Loading States](../features/loading-states.md) Ã¢â‚¬â€ Modern approach with data-loading attributes- [Actions](../essentials/actions.md) Ã¢â‚¬â€ Show feedback during action processing- [Forms](../essentials/forms.md) Ã¢â‚¬â€ Display form submission progress

#

# Reference



```text
wire:loadingwire:target="action"wire:target="property"wire:target.except="action"

```



#

#

# Modifiers
- `.remove`- `.class="class-name"`- `.class.remove="class-name"`- `.attr="attribute"`- `.delay`- `.delay.shortest`- `.delay.shorter`- `.delay.short`- `.delay.long`- `.delay.longer`- `.delay.longest`- `.inline-flex`- `.inline`- `.block`- `.table`- `.flex`- `.grid`
