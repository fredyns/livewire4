# wire:submit

source: https://livewire.laravel.com/docs/4.x/wire-submitLivewire makes it easy to handle form submissions via the `wire:submit` directive.By adding `wire:submit` to a `<form>` element, Livewire will intercept the form submission, prevent the default browser handling, and call any Livewire component method.

#

# Basic usageBasic example of using `wire:submit` to handle a "Create Post" form submission:

```

php<?phpnamespace App\Livewire;use App\Models\Post;use Livewire\Component;class CreatePost extends Component{    public $title = '';    public $content = '';    public function save()    {        Post::create([            'title' => $this->title,            'content' => $this->content,        ]);        $this->redirect('/posts');    }    public function render()    {        return view('livewire.create-post');    }}

```

```

blade<form wire:submit="save">    <input type="text" wire:model="title">    <textarea wire:model="content"></textarea>    <button type="submit">Save</button></form>

```

In the above example, when a user submits the form by clicking "Save", `wire:submit` intercepts the submit event and calls the `save()` action on the server.`wire:submit` is different than other Livewire event handlers in that it internally calls `event.preventDefault()` without the need for the `.prevent` modifier.By default, when Livewire is sending a form submission to the server, it will disable form submit buttons and mark all form inputs as readonly. This way a user cannot submit the same form again until the initial submission is complete.

#

# Going deeper`wire:submit` is just one of many event listeners that Livewire provides. The following pages provide much more complete documentation on using `wire:submit`:- [Responding to browser events with Livewire](../essentials/actions.md)- [Creating forms in Livewire](../essentials/forms.md)

#

# See also- [Forms](../essentials/forms.md) — Handle form submissions with Livewire- [Actions](../essentials/actions.md) — Process form data in actions- [Validation](../features/validation.md) — Validate forms before submission

#

# Reference

```

textwire:submit="methodName"wire:submit="methodName(param1, param2)"

```

#

#

# Modifiers- `.prevent`- `.stop`- `.self`- `.once`- `.debounce`- `.debounce.500ms`- `.throttle`- `.throttle.500ms`- `.window`- `.document`- `.passive`- `.capture`- `.renderless`- `.preserve-scroll`- `.async`
