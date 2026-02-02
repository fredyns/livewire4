# Computed Properties

source: https://livewire.laravel.com/docs/4.x/computed-properties

Computed properties are a way to create "derived" properties in Livewire. Like accessors on an Eloquent model, computed properties allow you to access values and memoize them for future access during the request.Computed properties are particularly useful in combination with component's public properties.

#

# Basic usage

To create a computed property, add the `#[Computed]` attribute above any method in your Livewire component. Once the attribute has been added to the method, you can access it like any other property.Make sure you import any attribute classes. For example, `#[Computed]` requires `use Livewire\Attributes\Computed;`.Example `show-user` component with a computed `user()` property derived from `$userId`:



```php
<?php// resources/views/components/Ã¢Å¡Â¡show-user.blade.phpuse App\Models\User;use Illuminate\Support\Facades\Auth;use Livewire\Attributes\Computed;use Livewire\Component;new class extends Component{    public $userId;    #[Computed]    public function user()    {        return User::find($this->userId);    }    public function follow()    {        Auth::user()->follow($this->user);    }};

```





```blade
<div>    <h1>{{ $this->user->name }}</h1>    <span>{{ $this->user->email }}</span>    <button wire:click="follow">Follow</button></div>

```



Because the `#[Computed]` attribute has been added to the `user()` method, the value is accessible in other methods in the component and within the Blade template.Unlike normal properties, computed properties aren't directly available inside your component's template. Instead, you must access them on the `$this` object.For example, a computed property named `posts()` must be accessed via `$this->posts` inside your template.Trying to use a computed property within a Form will result in an error when you attempt to access the property in Blade using `$form->property` syntax.

#

# Performance advantage

You may be asking yourself: why use computed properties at all? Why not just call the method directly?Accessing a method as a computed property offers a performance advantage over calling a method.Internally, when a computed property is executed for the first time, Livewire memoizes the returned value. Any subsequent accesses in the request will return the memoized value instead of executing multiple times.It's a common misconception that Livewire memoizes computed properties for the entire lifespan of your Livewire component on a page. However, this isn't the case: Livewire only memoizes the result for the duration of a single component request (it does not persist between requests).

#

#

# Clearing the memo

Consider the following problematic scenario:1. You access a computed property that depends on a certain property or database state2. The underlying property or database state changes3. The memoized value for the property becomes stale and needs to be re-computedTo clear, or "bust", the stored memo, you can use PHP's `unset()`.Example `createPost()` action that makes the `posts()` computed stale, so it calls `unset($this->posts)`:



```php
<?php// resources/views/components/Ã¢Å¡Â¡show-posts.blade.phpuse Illuminate\Support\Facades\Auth;use Livewire\Attributes\Computed;use Livewire\Component;new class extends Component{    public function createPost()    {        if ($this->posts->count() > 10) {            throw new \Exception('Maximum post count exceeded');        }        Auth::user()->posts()->create(...);        unset($this->posts);    }    #[Computed]    public function posts()    {        return Auth::user()->posts;    }    // ...};

```



In the above component, the computed property is memoized before a new post is created because the `createPost()` method accesses `$this->posts` before the new post is created.To ensure that `$this->posts` contains the most up-to-date contents when accessed inside the view, the memo is cleared using `unset($this->posts)`.

#

#

# Caching between requests

The memoization discussed so far only lasts for a single request.If you need values to persist across multiple requests, you need actual Laravel caching.Example using `Cache::remember()`:



```php
<?php// resources/views/components/Ã¢Å¡Â¡show-user.blade.phpuse App\Models\User;use Illuminate\Support\Facades\Cache;use Livewire\Attributes\Computed;use Livewire\Component;new class extends Component{    public $userId;    #[Computed]    public function user()    {        $key = 'user'.$this->getId();        $seconds = 3600; // 1 hour...        return Cache::remember($key, $seconds, function () {            return User::find($this->userId);        });    }    // ...};

```



Because each unique instance of a Livewire component has a unique ID, you can use `$this->getId()` to generate a unique cache key that will only be applied to future requests for this same component instance.Livewire's `#[Computed]` attribute provides a `persist` parameter. By applying `#[Computed(persist: true)]` to a method, you can achieve the same result without any extra code:



```php
use App\Models\User;use Livewire\Attributes\Computed;#[Computed(persist: true)]public function user(){    return User::find($this->userId);}

```



When `$this->user` is accessed from your component, it will continue to be cached for the duration of the Livewire component on the page. This means the Eloquent query will only be executed once.Livewire caches persisted values for 3600 seconds (one hour). You can override this by passing an additional `seconds` parameter:



```php
#[Computed(persist: true, seconds: 7200)]

```



As previously discussed, you can clear a computed property's memo using PHP's `unset()`. This also applies to computed properties using `persist: true`: Livewire will clear both the in-request memo and the underlying cached value in Laravel's cache.

#

#

# Caching across all components

Instead of caching the value of a computed property for the duration of a single component request, you can cache it across all components in your application using `cache: true`:



```php
use App\Models\Post;use Livewire\Attributes\Computed;#[Computed(cache: true)]public function posts(){    return Post::all();}

```



Until the cache expires or is busted, every instance of this component in your application will share the same cached value for `$this->posts`.If you need to manually clear the cache for a computed property, you may set a custom cache key using the `key` parameter:



```php
use App\Models\Post;use Livewire\Attributes\Computed;#[Computed(cache: true, key: 'homepage-posts')]public function posts(){    return Post::all();}

```



#

# When to use computed properties?In addition to offering performance advantages, there are a few other scenarios where computed properties are helpful.Specifically, when passing data into your component's Blade template, there are a few occasions where a computed property is a better alternative.

#

#

# Conditionally accessing values

Example passing posts through `render()`:



```php
public function render(){    return view('livewire.show-posts', [        'posts' => Post::all(),    ]);}

```





```blade
<div>    @foreach ($posts as $post)        <div wire:key="{{ $post->id }}">            <!-- ... -->        </div>    @endforeach</div>

```



If you are conditionally accessing a value that is computationally expensive to retrieve in your Blade template, you can reduce overhead using a computed property.Without a computed property, the query might run even when the data won't be displayed:



```blade
<div>    @if (Auth::user()->can_see_posts)        @foreach ($posts as $post)            <div wire:key="{{ $post->id }}">                <!-- ... -->            </div>        @endforeach    @endif</div>

```



Using a computed property instead:



```php
use App\Models\Post;use Livewire\Attributes\Computed;#[Computed]public function posts(){    return Post::all();}public function render(){    return view('livewire.show-posts');}

```





```blade
<div>    @if (Auth::user()->can_see_posts)        @foreach ($this->posts as $post)            <div wire:key="{{ $post->id }}">                <!-- ... -->            </div>        @endforeach    @endif</div>

```



Now, because we are providing the posts to the template using a computed property, we only execute the database query when the data is needed.

#

#

# Using inline templates

Computed properties are useful when using inline templates.Example returning a template string directly inside `render()`:



```php
<?php// resources/views/components/Ã¢Å¡Â¡show-posts.blade.phpuse App\Models\Post;use Livewire\Attributes\Computed;use Livewire\Component;new class extends Component{    #[Computed]    public function posts()    {        return Post::all();    }    public function render()    {        return <<<HTML<div>    @foreach ($this->posts as $post)        <div wire:key="{{ $post->id }}">            <!-- ... -->        </div>    @endforeach</div>HTML;    }};

```



Without a computed property, you would have no way to explicitly pass data into the inline Blade template.

#

#

# Omitting the render method

Another way to cut down on boilerplate is by omitting the `render()` method entirely.When omitted, Livewire uses its own `render()` method returning the corresponding Blade view by convention.In these cases, you don't have a `render()` method from which you can pass data into a Blade view.Rather than re-introducing the `render()` method, you can provide that data to the view via computed properties:



```php
<?php// resources/views/components/Ã¢Å¡Â¡show-posts.blade.phpuse App\Models\Post;use Livewire\Attributes\Computed;use Livewire\Component;new class extends Component{    #[Computed]    public function posts()    {        return Post::all();    }};

```





```blade
<div>    @foreach ($this->posts as $post)        <div wire:key="{{ $post->id }}">            <!-- ... -->        </div>    @endforeach</div>

```



#

# Alternative: Session properties

If you need to persist simple values across page refreshes without cross-request caching, consider using the `#[Session]` attribute instead of computed properties.Session properties are useful when:- You want user-specific values to persist across page reloads (like search filters or UI preferences)- You don't need the value to be shareable via URL- The value is simple and not computationally expensive to storeFor example, storing a search query in the session:



```php
use Livewire\Attributes\Session;#[Session]public $search = '';

```



This keeps the search value across page refreshes without using URL parameters or computed property caching.Learn more about session properties.

#

# See also
- [Properties](../essentials/properties.md) Ã¢â‚¬â€ Understand basic property management- [Islands](islands.md) Ã¢â‚¬â€ Optimize performance with lazy computed values- [Computed Attribute](../php-attributes/computed.md) Ã¢â‚¬â€ Use `#[Computed]` for memoization- [Components](../essentials/components.md) Ã¢â‚¬â€ Access computed properties in views
