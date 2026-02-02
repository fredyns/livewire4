# Transitionsource: https://livewire.laravel.com/docs/4.x/attribute-transition

The `#[Transition]` attribute configures view transition behavior for action methods, allowing you to set transition types or skip transitions entirely.

#

# Basic usage

Apply the `#[Transition]` attribute to action methods that should trigger specific transition animations:



```php
<?phpuse Livewire\Attributes\Transition;use Livewire\Component;class Wizard extends Component{    public $step = 1;    #[Transition(type: 'forward')]    public function next()    {        $this->step++;    }    #[Transition(type: 'backward')]    public function previous()    {        $this->step--;    }}

```





```blade
<div>    <div wire:transition="content">Step {{ $step }}</div>    <button wire:click="previous">Back</button>    <button wire:click="next">Next</button></div>

```



The transition type can be targeted in CSS using the `:active-view-transition-type()` selector:



```css
html:active-view-transition-type(forward) {    &::view-transition-old(content) {        animation: 300ms ease-out slide-out-left;    }    &::view-transition-new(content) {        animation: 300ms ease-in slide-in-right;    }}html:active-view-transition-type(backward) {    &::view-transition-old(content) {        animation: 300ms ease-out slide-out-right;    }    &::view-transition-new(content) {        animation: 300ms ease-in slide-in-left;    }}@keyframes slide-out-left {    from { transform: translateX(0); opacity: 1; }    to { transform: translateX(-100%); opacity: 0; }}@keyframes slide-in-right {    from { transform: translateX(100%); opacity: 0; }    to { transform: translateX(0); opacity: 1; }}@keyframes slide-out-right {    from { transform: translateX(0); opacity: 1; }    to { transform: translateX(100%); opacity: 0; }}@keyframes slide-in-left {    from { transform: translateX(-100%); opacity: 0; }    to { transform: translateX(0); opacity: 1; }}

```



#

# Skipping transitions

Use `skip: true` to disable transitions for specific actions:



```php
#[Transition(skip: true)]public function reset(){    $this->step = 1;}

```



This is useful for actions like "reset" or "cancel" that should instantly update without animation.

#

# Parameters
- `type` (string)
- for example `'forward'`, `'backward'`- `skip` (bool)
- `true` to disable transitions

#

# Alternative approaches

For dynamic transition types that depend on runtime logic, use the `transition()` method instead:



```php
public function goToStep($step){    $this->transition(type: $step > $this->step ? 'forward' : 'backward');    $this->step = $step;}

```



You can also skip transitions imperatively:



```php
public function reset(){    $this->skipTransition();    $this->step = 1;}

```



#

# Learn more

For more information about view transitions, see the `wire:transition` documentation.

#

# Reference



```text
#[Transition]

```
