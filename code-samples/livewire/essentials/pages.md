# Pages

source: https://livewire.laravel.com/docs/4.x/pagesLivewire components can be used as entire pages by assigning them directly to routes. This allows you to build complete application pages using Livewire components, with additional capabilities like custom layouts, page titles, and route parameters.#

# Routing to componentsTo route to a component, use the `Route::livewire()` method in your `routes/web.php` file:

```

phpRoute::livewire('/posts/create', 'pages::post.create');

```

When you visit the specified URL, the component will be rendered as a complete page using your application's layout.#

# LayoutsComponents rendered via routes will use your application's layout file. By default, Livewire looks for a layout called `layouts::app` located at `resources/views/layouts/app.blade.php`.You may create this file if it doesn't already exist by running the following command:

```

bashphp artisan livewire:layout

```

This command will generate a file called:

```

textresources/views/layouts/app.blade.php

```

Ensure you have created a Blade file at this location and included a `{{ $slot }}` placeholder.

```

blade<!-- resources/views/layouts/app.blade.php --><!DOCTYPE html><html lang="{{ str_replace('_', '-', app()->getLocale()) }}">    <head>        <meta charset="utf-8">        <meta name="viewport" content="width=device-width, initial-scale=1.0">        <title>{{ $title ?? config('app.name') }}</title>        @vite(['resources/css/app.css', 'resources/js/app.js'])        @livewireStyles    </head>    <body>        {{ $slot }}        @livewireScripts    </body></html>

```

You may customize the default layout by updating the `component_layout` configuration option in your `config/livewire.php` file:

```

php'component_layout' => 'layouts::dashboard',

```

##

# Component-specific layoutsTo use a different layout for a specific component, you may place the `#[Layout]` attribute above your component class:

```

php<?phpuse Livewire\Attributes\Layout;use Livewire\Component;new #[Layout('layouts::dashboard')] class extends Component{    // ...};

```

Alternatively, you may use the `->layout()` method within your component's `render()` method:

```

php<?phpuse Livewire\Component;new class extends Component{    // ...    public function render()    {        return $this->view()            ->layout('layouts::dashboard');    }};

```

#

# Setting the page titleAssigning unique page titles to each page in your application is helpful for both users and search engines.To set a custom page title for a page component, first, make sure your layout file includes a dynamic title:

```

blade<head>    <title>{{ $title ?? config('app.name') }}</title></head>

```

Next, above your Livewire component's class, add the `#[Title]` attribute and pass it your page title:

```

php<?phpuse Livewire\Attributes\Title;use Livewire\Component;new #[Title('Create post')] class extends Component{    // ...};

```

This will set the page title for the component. In this example, the page title will be "Create Post" when the component is rendered.If you need to pass a dynamic title, such as a title that uses a component property, you can use the `->title()` fluent method in the component's `render()` method:

```

phppublic function render(){    return $this->view()        ->title('Create Post');}

```

#

# Setting additional layout file slotsIf your layout file has any named slots in addition to `$slot`, you can set their content in your Blade view by defining `<x-slot>` outside your root element.For example, if you want to be able to set the page language for each component individually, you can add a dynamic `$lang` slot into the opening HTML tag in your layout file:

```

blade<!-- resources/views/layouts/app.blade.php --><!DOCTYPE html><html lang="{{ str_replace('_', '-', $lang ?? app()->getLocale()) }}">    ...</html>

```

Then, in your component view, define an `<x-slot>` element outside the root element:

```

blade<x-slot:lang>fr</x-slot><div>    // French content goes here...</div>

```

#

# Accessing route parametersWhen working with page components, you may need to access route parameters within your Livewire component.To demonstrate, first, define a route with a parameter in your `routes/web.php` file:

```

phpRoute::livewire('/posts/{id}', 'pages::show-post');

```

Here, we've defined a route with an `id` parameter which represents a post's ID.Next, update your Livewire component to accept the route parameter in the `mount()` method:

```

php<?phpuse App\Models\Post;use Livewire\Component;new class extends Component{    public Post $post;    public function mount($id)    {        $this->post = Post::findOrFail($id);    }};

```

In this example, because the parameter name `$id` matches the route parameter `{id}`, if the `/posts/1` URL is visited, Livewire will pass the value of "1" as `$id`.#

# Using route model bindingLaravel's route model binding allows you to automatically resolve Eloquent models from route parameters.After defining a route with a model parameter in your `routes/web.php` file:

```

phpRoute::livewire('/posts/{post}', 'pages::show-post');

```

You can now accept the route model parameter through the `mount()` method of your component:

```

php<?phpuse App\Models\Post;use Livewire\Component;new class extends Component{    public Post $post;    public function mount(Post $post)    {        $this->post = $post;    }};

```

Livewire knows to use route model binding because the `Post` type-hint is prepended to the `$post` parameter in `mount()`.Like before, you can reduce boilerplate by omitting the `mount()` method:

```

php<?phpuse App\Models\Post;use Livewire\Component;new class extends Component{    public Post $post;};

```

The `$post` property will automatically be assigned to the model bound via the route's `{post}` parameter.#

# See also- [Components](./components.md) — Learn about creating and organizing components- [Navigate](../features/navigate.md) — Build SPA-like navigation between pages- [Redirecting](../features/redirecting.md) — Redirect users after form submissions or actions- [Layout Attribute](../php-attributes/layout.md) — Specify layouts for full-page components- [Title Attribute](../php-attributes/title.md) — Set page titles dynamically
