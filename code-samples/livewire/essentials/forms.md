# Forms

source: https://livewire.laravel.com/docs/4.x/formsBecause forms are the backbone of most web applications, Livewire provides loads of helpful utilities for building them. From handling simple input elements to complex things like real-time validation or file uploading, Livewire has simple, well-documented tools to make your life easier and delight your users.

#

# Submitting a formLet's start by looking at a very simple form in a `post.create` component. This form will have two simple text inputs and a submit button, as well as some code on the backend to manage the form's state and submission:

```

php<?php// resources/views/components/post/⚡create.blade.phpuse App\Models\Post;use Livewire\Component;new class extends Component{    public $title = '';    public $content = '';    public function save()    {        Post::create(            $this->only(['title', 'content']),        );        session()->flash('status', 'Post successfully updated.');        return $this->redirect('/posts');    }};?><form wire:submit="save">    <input type="text" wire:model="title">    <input type="text" wire:model="content">    <button type="submit">Save</button></form>

```

As you can see, we are binding the public `$title` and `$content` properties in the form above using `wire:model`. This is one of the most commonly used and powerful features of Livewire.In addition to binding `$title` and `$content`, we are using `wire:submit` to capture the submit event when the "Save" button is clicked and invoking the `save()` action.

#

# Adding validationTo avoid storing incomplete or dangerous user input, most forms need some sort of input validation.Livewire makes validating your forms as simple as adding `#[Validate]` attributes above the properties you want to be validated.Once a property has a `#[Validate]` attribute attached to it, the validation rule will be applied to the property's value any time it's updated server-side.

```

php<?php// resources/views/components/post/⚡create.blade.phpuse App\Models\Post;use Livewire\Attributes\Validate;use Livewire\Component;new class extends Component{    #[Validate('required')]    public $title = '';    #[Validate('required')]    public $content = '';    public function save()    {        $this->validate();        Post::create(            $this->only(['title', 'content']),        );        return $this->redirect('/posts');    }};

```

```

blade<form wire:submit="save">    <input type="text" wire:model="title">    <div>        @error('title')            <span class="error">{{ $message }}</span>        @enderror    </div>    <input type="text" wire:model="content">    <div>        @error('content')            <span class="error">{{ $message }}</span>        @enderror    </div>    <button type="submit">Save</button></form>

```

#

# Extracting a form objectIf you are working with a large form and prefer to extract all of its properties, validation logic, etc., into a separate class, Livewire offers form objects.You can create a form class by hand or use the artisan command:

```

bashphp artisan livewire:form PostForm

```

This creates:

```

textapp/Livewire/Forms/PostForm.php

```

```

php<?phpnamespace App\Livewire\Forms;use Livewire\Attributes\Validate;use Livewire\Form;class PostForm extends Form{    #[Validate('required|min:5')]    public $title = '';    #[Validate('required|min:5')]    public $content = '';}

```

```

php<?php// resources/views/components/post/⚡create.blade.phpuse App\Livewire\Forms\PostForm;use App\Models\Post;use Livewire\Component;new class extends Component{    public PostForm $form;    public function save()    {        $this->validate();        Post::create(            $this->form->only(['title', 'content']),        );        return $this->redirect('/posts');    }};

```

```

blade<form wire:submit="save">    <input type="text" wire:model="form.title">    <div>        @error('form.title')            <span class="error">{{ $message }}</span>        @enderror    </div>    <input type="text" wire:model="form.content">    <div>        @error('form.content')            <span class="error">{{ $message }}</span>        @enderror    </div>    <button type="submit">Save</button></form>

```

You can also extract the post creation logic into the form object:

```

php<?phpnamespace App\Livewire\Forms;use App\Models\Post;use Livewire\Attributes\Validate;use Livewire\Form;class PostForm extends Form{    #[Validate('required|min:5')]    public $title = '';    #[Validate('required|min:5')]    public $content = '';    public function store()    {        $this->validate();        Post::create($this->only(['title', 'content']));    }}

```

Then call it from the component:

```

phppublic function save(){    $this->form->store();    return $this->redirect('/posts');}

```

#

# Resetting form fieldsIf you are using a form object, you may want to reset the form after it has been submitted. This can be done by calling the `reset()` method:

```

phppublic function store(){    $this->validate();    Post::create($this->only(['title', 'content']));    $this->reset();}

```

You can also reset specific properties:

```

php$this->reset('title');$this->reset(['title', 'content']);

```

#

# Pulling form fieldsAlternatively, you can use the `pull()` method to both retrieve a form's properties and reset them in one operation.

```

phppublic function store(){    $this->validate();    Post::create(        $this->pull(),    );}

```

Pull specific properties:

```

php$this->pull('title');$this->pull(['title', 'content']);

```

#

# Using Rule objectsIf you have more sophisticated validation scenarios where Laravel's `Rule` objects are necessary, you can alternatively define a `rules()` method:

```

php<?phpnamespace App\Livewire\Forms;use App\Models\Post;use Illuminate\Validation\Rule;use Livewire\Form;class PostForm extends Form{    public ?Post $post;    public $title = '';    public $content = '';    protected function rules()    {        return [            'title' => [                'required',                Rule::unique('posts')->ignore($this->post),            ],            'content' => 'required|min:5',        ];    }    public function update()    {        $this->validate();        $this->post->update($this->only(['title', 'content']));        $this->reset();    }}

```

When using a `rules()` method instead of `#[Validate]`, Livewire will only run the validation rules when you call `$this->validate()`, rather than every time a property is updated.If you want Livewire to validate specific fields after every request, you can use `#[Validate]` without any provided rules (and still define `rules()`):

```

php#[Validate]public $title = '';

```

#

# Showing a loading indicatorBy default, Livewire will automatically disable submit buttons and mark inputs as readonly while a form is being submitted.You can add a loading spinner to the submit button via `wire:loading`:

```

blade<button type="submit">    Save    <div wire:loading>        <svg>...</svg>    </div></button>

```

Alternatively, you can use Tailwind and Livewire's automatic `data-loading` attribute:

```

blade<button type="submit">    <span class="in-data-loading:hidden">Save</span>    <span class="not-in-data-loading:hidden">        <svg>...</svg>    </span></button>

```

#

# Live-updating fieldsBy default, Livewire only sends a network request when the form is submitted (or any other action is called), not while the form is being filled out.To synchronize the input field with the backend as the user types, add the `.live` modifier:

```

blade<input type="text" wire:model.live="title">

```

#

# Only updating fields on blurIf you want to send the request when a user tabs out of the input, use `.blur`:

```

blade<input type="text" wire:model.live.blur="title">

```

#

# Real-time validationUsing `.live` or `.blur` will cause Livewire to run validation rules before updating the property. If validation fails, the property won't be updated and a validation message can be shown:

```

blade<input type="text" wire:model.live.blur="title"><div>    @error('title')        <span class="error">{{ $message }}</span>    @enderror</div>

```

#

# Real-time form savingIf you want to automatically save a form as the user fills it out rather than wait until the user clicks submit, you can do so using Livewire's `updated()` hook:

```

php<?phpuse App\Models\Post;use Livewire\Attributes\Validate;use Livewire\Component;new class extends Component{    public Post $post;    #[Validate('required')]    public $title = '';    #[Validate('required')]    public $content = '';    public function mount(Post $post)    {        $this->post = $post;        $this->title = $post->title;        $this->content = $post->content;    }    public function updated($name, $value)    {        $this->post->update([            $name => $value,        ]);    }};?><form wire:submit>    <input type="text" wire:model.live.blur="title">    <div>        @error('title')            <span class="error">{{ $message }}</span>        @enderror    </div>    <input type="text" wire:model.live.blur="content">    <div>        @error('content')            <span class="error">{{ $message }}</span>        @enderror    </div></form>

```

#

# Showing dirty indicatorsLivewire provides the `wire:dirty` directive to allow you to toggle elements or modify classes when an input's value diverges from the server-side component:

```

blade<input type="text" wire:model.live.blur="title" wire:dirty.class="border-yellow">

```

You can also toggle visibility using `wire:dirty` with `wire:target`:

```

blade<input type="text" wire:model="title"><div wire:dirty wire:target="title">Unsaved...</div>

```

#

# Debouncing inputBy default, a debounce of `250ms` is applied to `.live` text inputs. You can customize this:

```

blade<input type="text" wire:model.live.debounce.150ms="title">

```

#

# Throttling inputIf you want requests to be sent at a fixed interval while a user is typing, use `.throttle`:

```

blade<input type="text" wire:model.live.throttle.150ms="title">

```

#

# Extracting input fields to Blade componentsIt can be helpful to extract repetitive UI elements into dedicated Blade components.Original:

```

blade<form wire:submit="save">    <input type="text" wire:model="title">    <div>        @error('title')            <span class="error">{{ $message }}</span>        @enderror    </div>    <input type="text" wire:model="content">    <div>        @error('content')            <span class="error">{{ $message }}</span>        @enderror    </div>    <button type="submit">Save</button></form>

```

After extracting `<x-input-text>`:

```

blade<form wire:submit="save">    <x-input-text name="title" wire:model="title" />    <x-input-text name="content" wire:model="content" />    <button type="submit">Save</button></form>

```

`resources/views/components/input-text.blade.php`:

```

blade@props(['name'])<input type="text" name="{{ $name }}" {{ $attributes }}><div>    @error($name)        <span class="error">{{ $message }}</span>    @enderror</div>

```

#

# Custom form controlsSometimes you want to create a non-native control (like a counter) but still bind to it with `wire:model`.Example `<x-input-counter />` Blade component:

```

blade<!-- resources/view/components/input-counter.blade.php --><div    x-data="{ count: 0 }"    x-modelable="count"    {{ $attributes }}>    <button x-on:click="count--">-</button>    <span x-text="count"></span>    <button x-on:click="count++">+</button></div>

```

Because of `{{ $attributes }}`, a parent can do:

```

blade<x-input-counter wire:model="quantity" />

```

And in the browser it will effectively become:

```

html<div x-data="{ count: 0 }" x-modelable="count" wire:model="quantity">

```

#

# See also- [Validation](../features/validation.md) — Validate form inputs with real-time feedback- [wire:model](../html-directives/wire-model.md) — Bind form inputs to component properties- [File Uploads](../features/uploads.md) — Handle file uploads in forms- [Actions](actions.md) — Process form submissions with actions- [Loading States](../features/loading-states.md) — Show loading indicators during form submission
