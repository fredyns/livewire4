# Lifecycle Hookssource: https://livewire.laravel.com/docs/4.x/lifecycle-hooks

Livewire provides a variety of lifecycle hooks that allow you to execute code at specific points during a component's lifecycle. These hooks enable you to perform actions before or after particular events, such as initializing the component, updating properties, or rendering the template.Available hooks include:
- `mount()`- `hydrate()`- `boot()`- `updating()`- `updated()`- `rendering()`- `render()`- `rendered()`- `dehydrate()`- `exception($e, $stopPropagation)`

#

# Mount

In a standard PHP class, a constructor (`__construct()`) takes in outside parameters and initializes the object's state. However, in Livewire, you use the `mount()` method for accepting parameters and initializing the state of your component.Livewire components don't use `__construct()` because Livewire components are re-constructed on subsequent network requests, and we only want to initialize the component once when it is first created.Example:



```php
<?php// resources/views/components/profile/ÃƒÂ¢Ã…Â¡Ã‚Â¡edit.blade.phpuse Illuminate\Support\Facades\Auth;use Livewire\Component;new class extends Component{    public $name;    public $email;    public function mount()    {        $this->name = Auth::user()->name;        $this->email = Auth::user()->email;    }    // ...};

```



`mount()` can also receive parameters, including route-model binding:



```php
public function mount(Post $post){    $this->title = $post->title;    $this->content = $post->content;}

```



#

# Boot

If you want to run logic at the beginning of every request (initial and subsequent), use `boot()`.`boot()` is useful for initializing protected properties (not persisted between requests).



```php
<?phpuse App\Models\Post;use Livewire\Attributes\Locked;use Livewire\Component;new class extends Component{    #[Locked]    public $postId = 1;    protected Post $post;    public function boot()    {        $this->post = Post::find($this->postId);    }    // ...};

```



#

# Update

Client-side users can update public properties in many different ways, most commonly by modifying an input with `wire:model`.Livewire provides hooks to intercept updates:
- `updating($property, $value)` runs before a property is updated.- `updated($property)` (or `updated($property, $value)`) runs after a property is updated.Example of preventing a change:



```php
<?phpuse Exception;use Livewire\Component;new class extends Component{    public $postId = 1;    public function updating($property, $value)    {        if ($property === 'postId') {            throw new Exception;        }    }    // ...};

```



Example of enforcing formatting:



```php
<?phpuse Livewire\Component;new class extends Component{    public $username = '';    public $email = '';    public function updated($property)    {        if ($property === 'username') {            $this->username = strtolower($this->username);        }    }    // ...};

```



Or target a property directly in the method name:



```php
public function updatedUsername(){    $this->username = strtolower($this->username);}

```



#

#

# Arrays

Array properties have an additional `$key` argument to specify the changing element.



```php
<?phpuse Livewire\Component;new class extends Component{    public $preferences = [];    public function updatedPreferences($value, $key)    {        // $value = 'dark'        // $key = 'theme'    }    // ...};

```



#

# Hydrate & Dehydrate

Hydrate and dehydrate refer to a Livewire component being serialized to JSON for the client-side and then unserialized back into a PHP object on the subsequent request.Example using a DTO:



```php
<?phpuse Livewire\Component;new class extends Component{    public $post;    public function mount($title, $content)    {        $this->post = new PostDto([            'title' => $title,            'content' => $content,        ]);    }    public function hydrate()    {        $this->post = new PostDto($this->post);    }    public function dehydrate()    {        $this->post = $this->post->toArray();    }    // ...};

```



#

# Render

Use `rendering()` and `rendered()` to hook into rendering:



```php
<?phpuse App\Models\Post;use Livewire\Component;new class extends Component{    public function render()    {        return $this->view([            'post' => Post::all(),        ]);    }    public function rendering($view, $data)    {        // Runs BEFORE the provided view is rendered...    }    public function rendered($view, $html)    {        // Runs AFTER the provided view is rendered...    }    // ...};

```



#

# Exception

The `exception()` hook lets you intercept and catch errors.



```php
<?phpuse Livewire\Component;new class extends Component{    public function exception($e, $stopPropagation)    {        if ($e instanceof NotFoundException) {            $this->notify('Post is not found');            $stopPropagation();        }    }    // ...};

```



#

# Using hooks inside a trait

To avoid trait hook method collisions, Livewire supports prefixing hook methods with the camelCased trait name.Example trait and prefixed hooks:



```php
trait HasPostForm{    public $title = '';    public $content = '';    public function mountHasPostForm() {}    public function hydrateHasPostForm() {}    public function bootHasPostForm() {}    public function updatingHasPostForm() {}    public function updatedHasPostForm() {}    public function renderingHasPostForm() {}    public function renderedHasPostForm() {}    public function dehydrateHasPostForm() {}}

```



#

# Using hooks inside a form object

Form objects support update hooks too:



```php
namespace App\Livewire\Forms;use Livewire\Form;class PostForm extends Form{    public $title = '';    public $tags = [];    public function updating($property, $value) {}    public function updated($property, $value) {}    public function updatingTitle($value) {}    public function updatedTitle($value) {}    public function updatingTags($value, $key) {}    public function updatedTags($value, $key) {}}

```



#

# See also
- [Properties](properties.md) ÃƒÂ¢Ã¢â€šÂ¬Ã¢â‚¬Â Initialize properties in `mount()` and `boot()`- [Components](components.md) ÃƒÂ¢Ã¢â€šÂ¬Ã¢â‚¬Â Understand when hooks run during component creation- [Pages](pages.md) ÃƒÂ¢Ã¢â€šÂ¬Ã¢â‚¬Â Use `mount()` to receive route parameters- [Hydration](../advanced/hydration.md) ÃƒÂ¢Ã¢â€šÂ¬Ã¢â‚¬Â Understand the `hydrate()` and `dehydrate()` hooks
