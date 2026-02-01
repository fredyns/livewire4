# Security

source: https://livewire.laravel.com/docs/4.x/securityLivewire has internal security features, but application code must still validate and authorize actions and treat client-provided values as untrusted user input.#

# Action parameters are untrustedParameters passed to Livewire actions are mutable on the client.Insecure example (no authorization):

```

php<?phpuse App\Models\Post;use Livewire\Component;class ShowPost extends Component{    // ...    public function delete($id)    {        // INSECURE!        $post = Post::find($id);        $post->delete();    }}

```

```

blade<button wire:click="delete({{ $post->id }})">Delete Post</button>

```

A malicious user can change `wire:click="delete(...)"` in the browser and pass any ID.To secure it, authorize inside the action.Example: create a Laravel policy:

```

bashphp artisan make:policy PostPolicy --model=Post

```

```

php<?phpnamespace App\Policies;use App\Models\Post;use App\Models\User;class PostPolicy{    public function delete(?User $user, Post $post): bool    {        return $user?->id === $post->user_id;    }}

```

Then authorize in the component:

```

phppublic function delete($id){    $post = Post::find($id);    $this->authorize('delete', $post);    $post->delete();}

```

#

# Public properties are untrustedPublic properties should also be treated as untrusted.Insecure example:

```

php<?phpuse App\Models\Post;use Livewire\Component;class ShowPost extends Component{    public $postId;    public function mount($postId)    {        $this->postId = $postId;    }    public function delete()    {        // INSECURE!        $post = Post::find($this->postId);        $post->delete();    }}

```

```

blade<button wire:click="delete">Delete Post</button>

```

A malicious user could inject:

```

html<input type="text" wire:model="postId">

```

And then delete any post.

##

# Solution: use model propertiesStore the entire model, not just an ID:

```

php<?phpuse App\Models\Post;use Livewire\Component;class ShowPost extends Component{    public Post $post;    public function mount($postId)    {        $this->post = Post::find($postId);    }    public function delete()    {        $this->post->delete();    }}

```

##

# Solution: lock propertiesUse the `#[Locked]` attribute:

source: https://livewire.laravel.com/docs/4.x/attribute-locked

```

php<?phpuse App\Models\Post;use Livewire\Component;use Livewire\Attributes\Locked;class ShowPost extends Component{    #[Locked]    public $postId;    public function mount($postId)    {        $this->postId = $postId;    }    public function delete()    {        $post = Post::find($this->postId);        $post->delete();    }}

```

##

# Solution: authorize manuallyEven if the user can change `postId`, authorization will prevent harmful changes:

```

php<?phpuse App\Models\Post;use Livewire\Component;class ShowPost extends Component{    public $postId;    public function mount($postId)    {        $this->postId = $postId;    }    public function delete()    {        $post = Post::find($this->postId);        $this->authorize('delete', $post);        $post->delete();    }}

```

#

# Persistent middlewareIf a Livewire component is loaded on a page with route-level authorization middleware, Livewire re-applies that middleware on subsequent requests (“Persistent Middleware”).Example:

```

phpRoute::livewire('/post/{post}', App\Livewire\UpdatePost::class)    ->middleware('can:update,post');

```

By default, Livewire persists a set of middleware across network requests.If you want your custom middleware persisted, register it:

```

php<?phpnamespace App\Providers;use Illuminate\Support\ServiceProvider;use Livewire;class AppServiceProvider extends ServiceProvider{    public function boot(): void    {        Livewire::addPersistentMiddleware([            App\Http\Middleware\EnsureUserHasRole::class,        ]);    }}

```

Livewire currently doesn’t support middleware arguments in persistent middleware definitions.

```

php// Bad...Livewire::addPersistentMiddleware(AuthorizeRe

source::class.':admin');// Good...Livewire::addPersistentMiddleware(AuthorizeRe

source::class);

```

#

# Customizing the update routeTo apply middleware to every Livewire update request, register a custom update route:

```

phpLivewire::setUpdateRoute(function ($handle) {    return Route::post('/livewire/update', $handle)        ->middleware(App\Http\Middleware\LocalizeViewPaths::class);});

```

Learn more: https://livewire.laravel.com/docs/installation
