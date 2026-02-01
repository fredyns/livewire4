# Components

source: https://livewire.laravel.com/docs/4.x/componentsLivewire components are essentially PHP classes with properties and methods that can be called directly from a Blade template. This powerful combination allows you to create full-stack interactive interfaces with a fraction of the effort and complexity of modern JavaScript alternatives.This guide covers everything you need to know about creating, rendering, and organizing Livewire components. You'll learn about the different component formats available (single-file, multi-file, and class-based), how to pass data between components, and how to use components as full pages.#

# Creating componentsYou can create a component using the `make:livewire` Artisan command:

```

bashphp artisan make:livewire post.create

```

This creates a single-file component at:

```

textresources/views/components/post/⚡create.blade.php

```

```

php<?phpuse Livewire\Component;new class extends Component{    public $title = '';    public function save()    {        // Save logic here...    }};?><div>    <input wire:model="title" type="text">    <button wire:click="save">Save Post</button></div>

```

You might be wondering about the lightning bolt in the filename. This small touch serves a practical purpose: it makes Livewire components instantly recognizable in your editor's file tree and search results. Since it's a Unicode character, it works seamlessly across all platforms — Windows, macOS, Linux, Git, and your production servers.The emoji is completely optional and if you find it outside your comfort zone you can disable it entirely in your `config/livewire.php` file:

```

php'make_command' => [    'emoji' => false,],

```

##

# Creating page componentsWhen creating components that will be used as full pages, use the `pages::` namespace to organize them in a dedicated directory:

```

bashphp artisan make:livewire pages::post.create

```

This creates the component at:

```

textresources/views/pages/post/⚡create.blade.php

```

Learn more about using components as pages in the *Page components* section below. You can also register your own custom namespaces—see the [Pages documentation](./pages.md).

##

# Multi-file componentsAs your component or project grows, you might find the single-file approach limiting. Livewire offers a multi-file alternative that splits your component into separate files for better organization and IDE support.To create a multi-file component, pass the `--mfc` flag:

```

bashphp artisan make:livewire post.create --mfc

```

This creates a directory with all related files together:

```

textresources/views/components/post/⚡create/├── create.php 

# PHP class├── create.blade.php 

# Blade template├── create.js 

# JavaScript (optional)├── create.css 

# Scoped styles (optional)├── create.global.css 

# Global styles (optional)└── create.test.php 

# Pest test (optional, with --test flag)

```

##

# Converting between formatsLivewire provides the `livewire:convert` command to seamlessly convert components between single-file and multi-file formats.Auto-detect and convert:

```

bashphp artisan livewire:convert post.create

```

Explicitly convert to multi-file:

```

bashphp artisan livewire:convert post.create --mfc

```

This will parse your single-file component, create a directory structure, split the files, and delete the original.Explicitly convert to single-file:

```

bashphp artisan livewire:convert post.create --sfc

```

This combines all files back into a single file and deletes the directory.If your multi-file component has a test file, you'll be prompted to confirm before conversion since test files cannot be preserved in the single-file format.

##

# When to use each formatSingle-file components (default):- Best for most components- Keeps related code together- Easy to understand at a glance- Perfect for small to medium componentsMulti-file components:- Better for large, complex components- Improved IDE support and navigation- Clearer separation when components have significant JavaScriptClass-based components:- Familiar to developers from Livewire v2/v3- Traditional Laravel separation of concerns- Better for teams with established conventions#

# Rendering componentsYou can include a Livewire component within any Blade template using the `<livewire:component-name />` syntax:

```

blade<livewire:component-name />

```

If the component is located in a sub-directory, you can indicate this using the dot (`.`) character:

```

blade<livewire:post.create />

```

For namespaced components—like `pages::`—use the namespace prefix:

```

blade<livewire:pages::post.create />

```

##

# Passing propsTo pass data into a Livewire component, you can use prop attributes on the component tag:

```

blade<livewire:post.create title="Initial Title" />

```

For dynamic values or variables, prefix the attribute with a colon:

```

blade<livewire:post.create :title="$initialTitle" />

```

Data passed into components is received through the `mount()` method:

```

php<?phpuse Livewire\Component;new class extends Component{    public $title;    public function mount($title = null)    {        $this->title = $title;    }    // ...};

```

You can think of the `mount()` method as a class constructor. It runs when the component initializes, but not on subsequent requests within a page's session.To reduce boilerplate code, you can omit the `mount()` method and Livewire will automatically set any properties with names matching the passed values:

```

php<?phpuse Livewire\Component;new class extends Component{    public $title; // Automatically set from prop    // ...};

```

The `$title` property will not update automatically if the outer `:title="$initialValue"` changes after the initial page load. Livewire allows you to opt-in to making your props reactive (see [Nesting Components](./nesting.md)).

##

# Passing route parameters as propsWhen using components as pages, you can pass route parameters directly to your component. The route parameters are automatically passed to the `mount()` method:

```

phpRoute::livewire('/posts/{id}', 'pages::post.show');

```

```

php<?phpuse Livewire\Component;new class extends Component{    public $postId;    public function mount($id)    {        $this->postId = $id;    }};

```

Livewire also supports Laravel's route model binding:

```

phpRoute::livewire('/posts/{post}', 'pages::post.show');

```

```

php<?phpuse App\Models\Post;use Livewire\Component;new class extends Component{    public Post $post; // Automatically bound from route    // No mount() needed
- Livewire handles it automatically};

```

#

# Accessing data in views

##

# Component propertiesThe simplest approach is using public properties, which are automatically available in your Blade template:

```

php<?phpuse Livewire\Component;new class extends Component{    public $title = 'My Post';};

```

```

blade<div>    <h1>{{ $title }}</h1></div>

```

Protected properties must be accessed with `$this->`:

```

phppublic $title = 'My Post'; // Available as {{ $title }}protected $apiKey = 'secret-key'; // Available as {{ $this->apiKey }}

```

Unlike public properties, protected properties are never sent to the frontend and cannot be manipulated by users. This makes them safe for sensitive data. However, they are not persisted between requests, which limits their usefulness in most Livewire scenarios.

##

# Computed propertiesComputed properties are methods that act like memoized properties. They're perfect for expensive operations like database queries:

```

phpuse Livewire\Attributes\Computed;#[Computed]public function posts(){    return Post::with('author')->latest()->get();}

```

```

blade<div>    @foreach ($this->posts as $post)        <article wire:key="{{ $post->id }}">{{ $post->title }}</article>    @endforeach</div>

```

Notice the `$this->` prefix
- this tells Livewire to call the method and cache the result for the current request only (not between requests).

##

# Passing data from `render()`Similar to a controller, you can pass data directly to the view using the `render()` method:

```

phppublic function render(){    return $this->view([        'author' => Auth::user(),        'currentTime' => now(),    ]);}

```

Keep in mind that `render()` runs on every component update, so avoid expensive operations here unless you need fresh data on every update.#

# Organizing components

##

# Component namespacesWhile Livewire automatically discovers components in the default `resources/views/components/` directory, you can customize where Livewire looks for components and organize them using namespaces.By default, Livewire provides two namespaces:- `pages::` — Points to `resources/views/pages/`- `layouts::` — Points to `resources/views/layouts/`You can define additional namespaces in your `config/livewire.php` file:

```

php'component_namespaces' => [    'layouts' => resource_path('views/layouts'),    'pages' => resource_path('views/pages'),    'admin' => resource_path('views/admin'),    'widgets' => resource_path('views/widgets'),],

```

Then use them when creating, rendering, and routing:

```

bashphp artisan make:livewire admin::users-table

```

```

blade<livewire:admin::users-table />

```

```

phpRoute::livewire('/admin/users', 'admin::users-table');

```

##

# Additional component locationsIf you want Livewire to discover components in additional directories beyond the defaults, you can configure them in your `config/livewire.php` file:

```

php'component_locations' => [    resource_path('views/components'),    resource_path('views/admin/components'),    resource_path('views/widgets'),],

```

##

# Programmatic registrationFor more dynamic scenarios (like package development or runtime configuration), you can register components, locations, and namespaces programmatically in a service provider.Register an individual component:

```

phpuse Livewire\Livewire;Livewire::addComponent(    name: 'custom-button',    viewPath: resource_path('views/ui/button.blade.php'),);

```

Register a component directory:

```

phpLivewire::addLocation(    viewPath: resource_path('views/admin/components'),);

```

Register a namespace:

```

phpLivewire::addNamespace(    namespace: 'ui',    viewPath: resource_path('views/ui'),);

```

#

##

# Registering class-based componentsFor class-based components, use the same methods but with the `class` parameter instead of `path`.

```

phpuse Livewire\Livewire;// Register an individual class-based component:Livewire::addComponent(    name: 'todos',    class: \App\Livewire\Todos::class,);// Register a location for class-based components:Livewire::addLocation(    classNamespace: 'App\\Admin\\Livewire',);// Create a namespace for class-based components:Livewire::addNamespace(    namespace: 'admin',    classNamespace: 'App\\Admin\\Livewire',    classPath: app_path('Admin/Livewire'),    classViewPath: resource_path('views/admin/livewire'),);

```

#

# Class-based componentsFor teams migrating from Livewire v3 or those who prefer a more traditional Laravel structure, Livewire fully supports class-based components. This approach separates the PHP class and Blade view into different files in their conventional locations.

```

bashphp artisan make:livewire CreatePost --class

```

This creates two separate files:

```

textapp/Livewire/CreatePost.phpresources/views/livewire/create-post.blade.php

```

`app/Livewire/CreatePost.php`:

```

php<?phpnamespace App\Livewire;use Livewire\Component;class CreatePost extends Component{    public function render()    {        return view('livewire.create-post');    }}

```

`resources/views/livewire/create-post.blade.php`:

```

blade<div>    {{-- ... --}}</div>

```

Use class-based components when:- Migrating from Livewire v2/v3- Your team prefers a more traditional file structure- You have established conventions around class-based architectureUse single-file or multi-file components when:- Starting a new Livewire v4 project- You want better component colocation- You want to use the latest Livewire conventionsIf you want class-based components by default, configure it in `config/livewire.php`:

```

php'make_command' => [    'type' => 'class',],

```

#

# Customizing component stubsYou can customize the files (or stubs) Livewire uses to generate new components by running:

```

bashphp artisan livewire:stubs

```

This creates stub files in your application that you can modify:Single-file component stubs:- `stubs/livewire-sfc.stub` — Single-file componentsMulti-file component stubs:- `stubs/livewire-mfc-class.stub` — PHP class for multi-file components- `stubs/livewire-mfc-view.stub` — Blade view for multi-file components- `stubs/livewire-mfc-js.stub` — JavaScript for multi-file components- `stubs/livewire-mfc-test.stub` — Pest test for multi-file componentsClass-based component stubs:- `stubs/livewire.stub` — PHP class for class-based components- `stubs/livewire.view.stub` — Blade view for class-based componentsAdditional stubs:- `stubs/livewire.attribute.stub` — Attribute classes- `stubs/livewire.form.stub` — Form classes#

# Troubleshooting

##

# Component not foundSymptom: Error message like "Component [post.create] not found" or "Unable to find component"Solutions:- Verify the component file exists at the expected path- Check that the component name in your view matches the file structure (dots for subdirectories)- For namespaced components, ensure the namespace is defined in `config/livewire.php` or manually registered in a service provider- Try clearing your view cache:

```

bashphp artisan view:clear

```

##

# Component shows blank or doesn't renderCommon causes:- Missing root element in your Blade template (Livewire requires exactly one root element)- Syntax errors in the PHP section of your component- Check your Laravel logs for detailed error messages

##

# Class name conflictsSymptom: Errors about duplicate class names when using single-file componentsSolution: This can happen if you have multiple single-file components with the same name in different directories. Either:- Rename one of the components to be unique- Namespace one of the directories for more clear separation#

# See also- [Properties](./properties.md) — Manage component state and data- [Actions](./actions.md) — Handle user interactions with methods- [Pages](./pages.md) — Use components as full pages with routing- [Nesting Components](./nesting.md) — Compose components together and pass data between them- [Lifecycle Hooks](./lifecycle-hooks.md) — Execute code at specific points in a component's lifecycle
