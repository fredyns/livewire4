# wire:confirm

source: https://livewire.laravel.com/docs/4.x/wire-confirmBefore performing dangerous actions in Livewire, you may want to provide your users with some sort of visual confirmation.Livewire makes this easy to do by adding `wire:confirm` in addition to any action (`wire:click`, `wire:submit`, etc.).#

# Basic usageExample adding a confirmation dialog to a "Delete post" button:

```

blade<button    type="button"    wire:click="delete"    wire:confirm="Are you sure you want to delete this post?">    Delete post</button>

```

When a user clicks "Delete post", Livewire will trigger a confirmation dialog (the default browser confirmation alert).If the user hits escape or presses cancel, the action won't be performed. If they press "OK", the action will be completed.#

# Prompting users for inputFor even more dangerous actions (like deleting a user's account entirely), you may want to present a confirmation prompt where the user must type a specific string.Livewire provides a helpful `.prompt` modifier. When applied to `wire:confirm`, it will prompt the user for input and only confirm the action if the input matches (case-sensitive) the provided string.The confirmation string is designated by a `|` (pipe) character at the end of the `wire:confirm` value.

```

blade<button    type="button"    wire:click="delete"    wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE">    Delete account</button>

```

When a user presses "Delete account", the action will only be performed if `DELETE` is entered into the prompt; otherwise, the action will be cancelled.#

# Reference

```

textwire:confirm="message"

```

##

# Modifiers- `.prompt`
