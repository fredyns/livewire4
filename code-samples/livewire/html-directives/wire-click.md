# wire:click

source: https://livewire.laravel.com/docs/4.x/wire-click

Livewire provides a simple `wire:click` directive for calling component methods (aka actions) when a user clicks a specific element on the page.For example, given the `ShowInvoice` component below:



```php
<?phpnamespace App\Livewire;use App\Models\Invoice;use Livewire\Component;class ShowInvoice extends Component{    public Invoice $invoice;    public function download()    {        return response()->download(            $this->invoice->file_path,            'invoice.pdf'        );    }}

```



You can trigger the `download()` method when a user clicks a "Download Invoice" button by adding `wire:click="download"`:



```blade
<button type="button" wire:click="download">Download Invoice</button>

```



#

# Passing parameters

You can pass parameters to actions directly in the `wire:click` directive:



```blade
<button wire:click="delete({{ $post->id }})">Delete</button>

```



When the button is clicked, the `delete()` method will be called with the post's ID.Action parameters should be treated like HTTP request input and should not be trusted. Always authorize ownership before updating data.

#

# Using on links

When using `wire:click` on `<a>` tags, you must append `.prevent` to prevent the default link behavior. Otherwise, the browser will navigate to the provided `href`.



```blade
<a href="#" wire:click.prevent="show">View Details</a>

```



#

# Preventing re-renders

Use `.renderless` to skip re-rendering the component after the action completes. This is useful for actions that only perform side effects (like logging or analytics):



```blade
<button wire:click.renderless="trackClick">Track Event</button>

```



#

# Preserving scroll position

By default, updating content may change the scroll position.Use `.preserve-scroll` to maintain the current scroll position:



```blade
<button wire:click.preserve-scroll="loadMore">Load More</button>

```



#

# Parallel execution

By default, Livewire queues actions within the same component.Use `.async` to allow actions to run in parallel:



```blade
<button wire:click.async="process">Process</button>

```



#

# Going deeper

The `wire:click` directive is just one of many different available event listeners in Livewire.For full documentation on its (and other event listeners) capabilities, visit the Livewire actions documentation page.

#

# See also
- [Actions](../essentials/actions.md) Ã¢â‚¬â€ Complete guide to component actions- [Events](../essentials/events.md) Ã¢â‚¬â€ Dispatch events from click handlers- [wire:confirm](wire-confirm.md) Ã¢â‚¬â€ Add confirmation dialogs to actions

#

# Reference



```text
wire:click="methodName"wire:click="methodName(param1, param2)"

```



#

#

# Modifiers
- `.prevent`- `.stop`- `.self`- `.once`- `.debounce`- `.debounce.500ms`- `.throttle`- `.throttle.500ms`- `.window`- `.document`- `.outside`- `.passive`- `.capture`- `.camel`- `.dot`- `.renderless`- `.preserve-scroll`- `.async`
