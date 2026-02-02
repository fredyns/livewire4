# Title

source: https://livewire.laravel.com/docs/4.x/attribute-title

The `#[Title]` attribute sets the page title for full-page Livewire components.

#

# Basic usage

Apply the `#[Title]` attribute to a full-page component to set its title:



```php
<?php// resources/views/pages/posts/Ã¢Å¡Â¡create.blade.phpuse Livewire\Attributes\Title;use Livewire\Component;new #[Title('Create Post')] class extends Component {    public $title = '';    public $content = '';    public function save()    {        // Save post...    }};?><div>    <h1>Create a New Post</h1>    <input type="text" wire:model="title" placeholder="Post title">    <textarea wire:model="content" placeholder="Post content"></textarea>    <button wire:click="save">Save Post</button></div>

```



The browser tab will display "Create Post" as the page title.

#

# Layout configuration

For the `#[Title]` attribute to work, your layout file must include a `$title` variable:



```blade
<!-- resources/views/components/layouts/app.blade.php --><!DOCTYPE html><html><head>    <title>{{ $title ?? 'My App' }}</title></head><body>    {{ $slot }}</body></html>

```



The `?? 'My App'` provides a fallback title if none is specified.

#

# Dynamic titles

For dynamic titles using component properties, use the `title()` method in the `render()` method:



```php
<?php// resources/views/pages/posts/Ã¢Å¡Â¡edit.blade.phpuse Livewire\Component;use App\Models\Post;new class extends Component {    public Post $post;    public function mount($id)    {        $this->post = Post::findOrFail($id);    }    public function render()    {        return $this->view()            ->title("Edit: {$this->post->title}");    }};?><div>    <h1>Edit Post</h1>    <!-- ... --></div>

```



The title will dynamically include the post's title.

#

# Combining with layouts

You can use both `#[Title]` and `#[Layout]` together:



```php
<?php// resources/views/pages/posts/Ã¢Å¡Â¡create.blade.phpuse Livewire\Attributes\Layout;use Livewire\Attributes\Title;use Livewire\Component;new#[Layout('layouts.admin')]#[Title('Create Post')]class extends Component {    // ...};

```



This component will use the admin layout with "Create Post" as the title.

#

# When to use

Use `#[Title]` when:- Building full-page components- You want clean, declarative title definitions- The title is static or rarely changes- You're following SEO best practicesUse `title()` method when:- The title depends on component properties- You need to compute the title dynamically- The title changes based on component state

#

# Example: CRUD pages



```php
<?php// resources/views/pages/posts/Ã¢Å¡Â¡index.blade.phpuse Livewire\Attributes\Title;use Livewire\Component;new #[Title('All Posts')] class extends Component { };

```





```php
<?php// resources/views/pages/posts/Ã¢Å¡Â¡create.blade.phpuse Livewire\Attributes\Title;use Livewire\Component;new #[Title('Create Post')] class extends Component { };

```





```php
<?php// resources/views/pages/posts/Ã¢Å¡Â¡edit.blade.phpuse Livewire\Component;use App\Models\Post;new class extends Component {    public Post $post;    public function render()    {        return $this->view()->title("Edit: {$this->post->title}");    }};

```





```php
<?php// resources/views/pages/posts/Ã¢Å¡Â¡show.blade.phpuse Livewire\Component;use App\Models\Post;new class extends Component {    public Post $post;    public function render()    {        return $this->view()->title($this->post->title);    }};

```



Each page has a contextually appropriate title that improves user experience and SEO.

#

# SEO considerations

Good page titles are crucial for SEO:
- Be descriptive- Keep it concise- Include keywords- Be unique

#

# Only for full-page components

The `#[Title]` attribute only works for full-page components accessed via routes.Regular components rendered within other views don't use titles Ã¢â‚¬â€ they inherit the parent page's title.

#

# Learn more

For more information about full-page components, layouts, and routing, see the Pages documentation.

#

# Reference



```text
#[Title(    string $content,)]

```
