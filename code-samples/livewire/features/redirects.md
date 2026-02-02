# Redirectingsource: https://livewire.laravel.com/docs/4.x/redirecting

After a user performs some action Ã¢â‚¬â€ like submitting a form Ã¢â‚¬â€ you may want to redirect them to another page in your application.Because Livewire requests aren't standard full-page browser requests, standard HTTP redirects won't work. Instead, you need to trigger redirects via JavaScript.Fortunately, Livewire exposes a simple `$this->redirect()` helper method to use within your components. Internally, Livewire will handle the process of redirecting on the frontend.If you prefer, you can use Laravel's built-in redirect utilities within your components as well.

#

# Basic usage

Example `post.create` component that redirects after creating a post:



```php
<?phpuse App\Models\Post;use Livewire\Component;new class extends Component{    public $title = '';    public $content = '';    public function save()    {        Post::create([            'title' => $this->title,            'content' => $this->content,        ]);        $this->redirect('/posts');    }};?><form wire:submit="save">    <!-- Form fields... --></form>

```



As you can see, when the `save` action is triggered, a redirect will also be triggered to `/posts`. When Livewire receives this response, it will redirect the user to the new URL on the frontend.

#

# Redirect to Route

If you want to redirect to a page using its route name, you can use `redirectRoute`.Example route named `profile`:



```php
Route::get('/user/profile', function () {    // ...})->name('profile');

```



Redirect using the route name:



```php
$this->redirectRoute('profile');

```



Pass parameters to the route as the second argument:



```php
$this->redirectRoute('profile', ['id' => 1]);

```



#

# Redirect to intended

If you want to redirect the user back to the previous page they were on you can use `redirectIntended`.It accepts an optional default URL as its first argument (used as a fallback if no previous page can be determined):



```php
$this->redirectIntended('/default/url');

```



#

# Redirecting to full-page components

Because Livewire uses Laravel's built-in redirection feature, you can use all of the redirection methods available to you in a typical Laravel application.For example, if you are using a Livewire component as a full-page component for a route like:



```php
Route::livewire('/posts', 'pages::show-posts');

```



You can redirect to it simply by using the route path:



```php
public function save(){    // ...    $this->redirect('/posts');}

```



#

# Redirect to controller actions

If you want to redirect to a route handled by a controller action, you can use `redirectAction()`:



```php
$this->redirectAction([UserController::class, 'index']);

```



You can pass parameters to the controller action as the second argument:



```php
$this->redirectAction([UserController::class, 'show'], ['id' => 1]);

```



#

# Flash messages

In addition to allowing you to use Laravel's built-in redirection methods, Livewire also supports Laravel's session flash data utilities.To pass flash data along with a redirect, you can use Laravel's `session()->flash()` method:



```php
<?phpuse Livewire\Component;new class extends Component{    // ...    public function update()    {        // ...        session()->flash('status', 'Post successfully updated.');        $this->redirect('/posts');    }};?>

```



Assuming the page being redirected to contains the following Blade snippet, the user will see a "Post successfully updated." message after updating the post:



```blade
@if (session('status'))    <div class="alert alert-success">        {{ session('status') }}    </div>@endif

```



#

# See also
- [Navigate](navigate.md) Ã¢â‚¬â€ Use SPA navigation for redirects- [Actions](../essentials/actions.md) Ã¢â‚¬â€ Redirect after action completion- [Forms](../essentials/forms.md) Ã¢â‚¬â€ Redirect after successful form submission- [Pages](../essentials/pages.md) Ã¢â‚¬â€ Navigate between page components
