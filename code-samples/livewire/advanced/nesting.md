# Nestingsource: https://livewire.laravel.com/docs/4.x/understanding-nesting

Like many component-based frameworks, Livewire components are nestable ÃƒÂ¢Ã¢â€šÂ¬Ã¢â‚¬Â one component can render multiple components within itself.Because LivewireÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢s nesting system is built differently than other frameworks, there are implications and constraints worth understanding.Before learning nesting, itÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢s helpful to understand hydration:

source: https://livewire.laravel.com/docs/4.x/hydratio

n

#

# Every component is independent {#every-component-is-an-island}Every component on a page tracks its state and makes updates independently.Example: Posts (parent) with nested Show

Post (child) components.



```php
<?phpnamespace App\Livewire;use Illuminate\Support\Facades\Auth;use Livewire\Component;class Posts extends Component{    public $postLimit = 2;    public function render()    {        return view('livewire.posts', [            'posts' => Auth::user()->posts()                ->limit($this->postLimit)                ->get(),        ]);    }}

```





```blade
<div>    Post Limit:    <input type="number" wire:model.live="postLimit">    @foreach ($posts as $post)        <livewire:show-post :$post :wire:key="$post->id">    @endforeach</div>

```





```php
<?phpnamespace App\Livewire;use Illuminate\Support\Facades\Auth;use Livewire\Component;use App\Models\Post;class ShowPost extends Component{    public Post $post;    public function render()    {        return view('livewire.show-post');    }}

```





```blade
<div>    <h1>{{ $post->title }}</h1>    <p>{{ $post->content }}</p>    <button wire:click="$refresh">Refresh post</button></div>

```



On initial render, the parent contains both its own template and the childrenÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢s templates, and each component has its own `wire:id` and `wire:snapshot`.

#

# Updating a child

If you click ÃƒÂ¢Ã¢â€šÂ¬Ã…â€œRefresh postÃƒÂ¢Ã¢â€šÂ¬Ã‚Â inside a child, only that childÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢s snapshot is sent to the server, and only that child is re-rendered.Example payload:



```js
{  memo: { name: 'show-post', id: '456' },  state: { /* ... */ },}

```



Example response HTML:



```html
<div wire:id="456">    <h1>The first post</h1>    <p>Post content</p>    <button wire:click="$refresh">Refresh post</button></div>

```



#

# Updating the parent

When updating the parent (e.g. changing `postLimit` from 2 to 1), only the parent snapshot is sent.When the parent re-renders and encounters child components, it renders placeholders for them instead of re-rendering children.Example post-update parent HTML (placeholders):



```html
<div wire:id="123">    Post Limit:    <input type="number" wire:model.live="postLimit">    <div wire:id="456"></div></div>

```



When received in the browser, Livewire morphs the DOM but intelligently skips child placeholders, preserving the existing child DOM.

#

# Performance implications

Independent components can isolate expensive work into smaller regions.However, because components are independent, inter-component communication can be harder, and props passed to children are not automatically ÃƒÂ¢Ã¢â€šÂ¬Ã…â€œreactiveÃƒÂ¢Ã¢â€šÂ¬Ã‚Â across parent updates.Livewire provides dedicated APIs for these scenarios, including Reactive properties, Modelable components, and the `$parent` object.

source: https://livewire.laravel.com/docs/4.x/nestin

g
