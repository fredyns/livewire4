# Forms

source: https://livewire.laravel.com/docs/4.x/forms

Because forms are the backbone of most web applications, Livewire provides loads of helpful utilities for building them. From handling simple input elements to complex things like real-time validation or file uploading, Livewire has simple, well-documented tools to make your life easier and delight your users.

#

# Submitting a form

Let's start by looking at a very simple form in a `post.create` component. This form has two simple text inputs and a submit button, as well as some code on the backend to manage the form's state and submission:



```php
<?php// resources/views/components/post/Ã¢Å¡Â¡create.blade.phpuse App\Models\Post;use Livewire\Component;new class extends Component{    public $title = '';    public $content = '';    public function save()    {        Post::create(            $this->only(['title', 'content'])        );        session()->flash('status', 'Post successfully updated.');        return $this->redirect('/posts');    }};?><form wire:submit="save">    <input type="text" wire:model="title">    <input type="text" wire:model="content">    <button type="submit">Save</button></form>

```



As you can see, we are binding the public `$title` and `$content` properties in the form above using `wire:model`.In addition to binding `$title` and `$content`, we are using `wire:submit` to capture the submit event when the "Save" button is clicked and invoking the `save()` action.After the new post is created in the database, we redirect the user to the posts page and show them a flash message that the new post was created.

#

# Adding validation

See the Validation page for in-depth validation, including real-time validation.

#

# Extracting a form object

Example extracting the logic into a Livewire form object.Component using a `PostForm` form object:



```php
<?php// resources/views/components/post/Ã¢Å¡Â¡edit.blade.phpuse App\Livewire\Forms\PostForm;use App\Models\Post;use Livewire\Component;new class extends Component{    public PostForm $form;    public function mount(Post $post)    {        $this->form->setPost($post);    }    public function save()    {        $this->form->update();        return $this->redirect('/posts');    }};

```



Form object definition:



```php
<?phpnamespace App\Livewire\Forms;use App\Models\Post;use Livewire\Attributes\Validate;use Livewire\Form;class PostForm extends Form{    public ?Post $post;    #[Validate('required|min:5')]    public $title = '';    #[Validate('required|min:5')]    public $content = '';    public function setPost(Post $post)    {        $this->post = $post;        $this->title = $post->title;        $this->content = $post->content;    }    public function store()    {        $this->validate();        Post::create($this->only(['title', 'content']));    }    public function update()    {        $this->validate();        $this->post->update(            $this->only(['title', 'content'])        );    }}

```



As you can see, `setPost()` optionally fills the form with existing data and stores the post on the form object for later use. The `update()` method updates the existing post.Form objects are not required when working with Livewire, but they can help keep your components free of repetitive boilerplate.

#

# Resetting form fields

If you are using a form object, you may want to reset the form after it has been submitted. This can be done by calling the `reset()` method:



```php
<?phpnamespace App\Livewire\Forms;use App\Models\Post;use Livewire\Attributes\Validate;use Livewire\Form;class PostForm extends Form{    #[Validate('required|min:5')]    public $title = '';    #[Validate('required|min:5')]    public $content = '';    // ...    public function store()    {        $this->validate();        Post::create($this->only(['title', 'content']));        $this->reset();    }}

```



You can also reset specific properties:



```php
$this->reset('title');// Or multiple at once...$this->reset(['title', 'content']);

```



#

# Pulling form fields

Alternatively, you can use the `pull()` method to both retrieve a form's properties and reset them in one operation.



```php
<?phpnamespace App\Livewire\Forms;use App\Models\Post;use Livewire\Attributes\Validate;use Livewire\Form;class PostForm extends Form{    #[Validate('required|min:5')]    public $title = '';    #[Validate('required|min:5')]    public $content = '';    // ...    public function store()    {        $this->validate();        Post::create(            $this->pull()        );    }}

```



You can also pull specific properties:



```php
// Return a value before resetting...$this->pull('title');// Return a key-value array of properties before resetting...$this->pull(['title', 'content']);

```



#

# Using Rule objects

If you have more sophisticated validation scenarios where Laravel's `Rule` objects are necessary, you can define a `rules()` method to declare your validation rules:



```php
<?phpnamespace App\Livewire\Forms;use App\Models\Post;use Illuminate\Validation\Rule;use Livewire\Form;class PostForm extends Form{    public ?Post $post;    public $title = '';    public $content = '';    protected function rules()    {        return [            'title' => [                'required',                Rule::unique('posts')->ignore($this->post),            ],            'content' => 'required|min:5',        ];    }    // ...    public function update()    {        $this->validate();        $this->post->update($this->only(['title', 'content']));        $this->reset();    }}

```



When using a `rules()` method instead of `#[Validate]`, Livewire will only run the validation rules when you call `$this->validate()`, rather than every time a property is updated.If you are using real-time validation (or any other scenario where you'd like Livewire to validate specific fields after every request), you can use `#[Validate]` without any provided rules:



```php
<?phpnamespace App\Livewire\Forms;use App\Models\Post;use Illuminate\Validation\Rule;use Livewire\Attributes\Validate;use Livewire\Form;class PostForm extends Form{    public ?Post $post;    #[Validate]    public $title = '';    public $content = '';    protected function rules()    {        return [            'title' => [                'required',                Rule::unique('posts')->ignore($this->post),            ],            'content' => 'required|min:5',        ];    }    // ...    public function update()    {        $this->validate();        $this->post->update($this->only(['title', 'content']));        $this->reset();    }}

```



Now if the `$title` property is updated before the form is submitted (like when using `wire:model.live.blur`), the validation for `$title` will be run.

#

# Showing a loading indicator

By default, Livewire will automatically disable submit buttons and mark inputs as readonly while a form is being submitted.To make the loading state more visible to users, you can use `wire:loading` to show a spinner:



```blade
<button type="submit">    Save    <div wire:loading>        <svg>...</svg>        <!-- SVG loading spinner -->    </div></button>

```



Alternatively, you can use Tailwind and Livewire's automatic `data-loading` attribute:



```blade
<button type="submit">    <span class="in-data-loading:hidden">Save</span>    <span class="not-in-data-loading:hidden">        <svg>...</svg>        <!-- SVG loading spinner -->    </span></button>

```



Learn more about loading states.

#

# Live-updating fields

By default, Livewire only sends a network request when the form is submitted (or another action is called), not while the form is being filled out.If you want a field synchronized as the user types, add the `.live` modifier:



```blade
<input type="text" wire:model.live="title">

```



#

# Only updating fields on blur

If you want to send a request only when a user tabs away (blurs) an input, use the `.blur` modifier:



```blade
<input type="text" wire:model.live.blur="title">

```



#

# Real-time validation

Using `.live` or `.blur` on `wire:model` will send requests as the user fills out the form.Each of those requests will run the appropriate validation rules before updating each property. If validation fails, the property won't be updated on the server and a validation message will be shown:



```blade
<input type="text" wire:model.live.blur="title"><div>    @error('title')        <span class="error">{{ $message }}</span>    @enderror</div>

```



Example validation rule:



```php
#[Validate('required|min:5')]public $title = '';

```



#

# Real-time form saving

If you want to automatically save a form as the user fills it out rather than wait until the user clicks "submit", you can use Livewire's `updated()` hook.



```php
<?php// resources/views/components/post/Ã¢Å¡Â¡edit.blade.phpuse App\Models\Post;use Livewire\Attributes\Validate;use Livewire\Component;new class extends Component{    public Post $post;    #[Validate('required')]    public $title = '';    #[Validate('required')]    public $content = '';    public function mount(Post $post)    {        $this->post = $post;        $this->title = $post->title;        $this->content = $post->content;    }    public function updated($name, $value)    {        $this->post->update([            $name => $value,        ]);    }};?><form wire:submit>    <input type="text" wire:model.live.blur="title">    <div>        @error('title')            <span class="error">{{ $message }}</span>        @enderror    </div>    <input type="text" wire:model.live.blur="content">    <div>        @error('content')            <span class="error">{{ $message }}</span>        @enderror    </div></form>

```



#

# Showing dirty indicators

In real-time saving scenarios, it can be helpful to indicate to users when a field hasn't been persisted to the database yet.Livewire provides the `wire:dirty` directive to allow you to toggle elements or modify classes when an input's value diverges from the server-side component:



```blade
<input type="text" wire:model.live.blur="title" wire:dirty.class="border-yellow">

```



If you want to toggle an entire element's visibility, you can use `wire:dirty` in conjunction with `wire:target`:



```blade
<input type="text" wire:model="title"><div wire:dirty wire:target="title">Unsaved...</div>

```



#

# Debouncing input

When using `.live` on a text input, you can control how often a network request is sent.By default, a debounce of `250ms` is applied, but you can customize it using `.debounce`:



```blade
<input type="text" wire:model.live.debounce.150ms="title">

```



#

# Throttling input

If instead you want to send a request as the user types (on an interval), not only after they've paused, you can use `.throttle`:



```blade
<input type="text" wire:model.live.throttle.150ms="title">

```



#

# Extracting input fields to Blade components

It can be helpful to extract repetitive UI elements such as validation messages and labels into dedicated Blade components.Original template:



```blade
<form wire:submit="save">    <input type="text" wire:model="title">    <div>        @error('title')            <span class="error">{{ $message }}</span>        @enderror    </div>    <input type="text" wire:model="content">    <div>        @error('content')            <span class="error">{{ $message }}</span>        @enderror    </div>    <button type="submit">Save</button></form>

```



After extracting an `<x-input-text>` component:



```blade
<form wire:submit="save">    <x-input-text name="title" wire:model="title" />    <x-input-text name="content" wire:model="content" />    <button type="submit">Save</button></form>

```



Source for the `x-input-text` component:



```blade
<!-- resources/views/components/input-text.blade.php -->@props(['name'])<input type="text" name="{{ $name }}" {{ $attributes }}><div>    @error($name)        <span class="error">{{ $message }}</span>    @enderror</div>

```



#

# Custom form controls

Sometimes you may want to create an entire input component from scratch (without an underlying native input element), but still be able to bind its value to Livewire properties using `wire:model`.Example: an `<x-input-counter />` component written in Alpine that supports `wire:model`.Pure-Alpine version for reference:



```html
<div x-data="{ count: 0 }">    <button x-on:click="count--">-</button>    <span x-text="count"></span>    <button x-on:click="count++">+</button></div>

```



Using the Blade component with `wire:model`:



```blade
<x-input-counter wire:model="quantity" />

```



Component 

source:



```blade
<!-- resources/view/components/input-counter.blade.php --><div x-data="{ count: 0 }" x-modelable="count" {{ $attributes }}>    <button x-on:click="count--">-</button>    <span x-text="count"></span>    <button x-on:click="count++">+</button></div>

```



Because of `{{ $attributes }}`, when rendered in the browser, `wire:model="quantity"` will be forwarded and appear alongside `x-modelable="count"`.`x-modelable="count"` tells Alpine to look for any `x-model` or `wire:model` statements and use `count` as the data to bind them to.Because `x-modelable` works for both `wire:model` and `x-model`, you can also use this Blade component interchangeably with Livewire and Alpine.Example using `x-model` instead:



```blade
<x-input-counter x-model="quantity" />

```



#

# See also
- [Validation](validation.md) Ã¢â‚¬â€ Validate form inputs with real-time feedback- [wire:model](../html-directives/wire-model.md) Ã¢â‚¬â€ Bind form inputs to component properties- [File Uploads](uploads.md) Ã¢â‚¬â€ Handle file uploads in forms- [Actions](../essentials/actions.md) Ã¢â‚¬â€ Process form submissions with actions- [Loading States](loading-states.md) Ã¢â‚¬â€ Show loading indicators during form submission
