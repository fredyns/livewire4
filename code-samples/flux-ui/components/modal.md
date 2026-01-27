# Modal

Source: https://fluxui.dev/components/modal

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:modal.trigger</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> name</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"edit-profile"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:button</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Edit profile</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:button</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:modal.trigger</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:modal</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> name</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"edit-profile"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> class</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"md:w-96"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">div</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> class</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"space-y-6"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">div</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:heading</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> size</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"lg"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Update profile</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:heading</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:text</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> class</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"mt-2"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Make changes to your personal details.</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:text</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">div</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:input</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> label</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Name"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> placeholder</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Your name"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:input</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> label</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Date of birth"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> type</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"date"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">div</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> class</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"flex"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:spacer</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:button</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> type</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"submit"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> variant</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"primary"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Save changes</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:button</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">div</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">div</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:modal</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## Unique modal names

```blade
@foreach ($users as $user)
    <flux:modal :name="'edit-profile-'.$user->id">
        ...
    </flux:modal>
@endforeach
```

## Livewire methods

```blade
<flux:modal name="confirm">
    <!-- ... -->
</flux:modal>
```

```blade
<?php

class ShowPost extends \Livewire\Component
{
    public function delete()
    {
        // Control "confirm" modals anywhere on the page...
        Flux::modal('confirm')->show();
        Flux::modal('confirm')->close();

        // Control "confirm" modals within this Livewire component...
        $this->modal('confirm')->show();
        $this->modal('confirm')->close();

        // Closes all modals on the page...
        Flux::modals()->close();
    }
}
```

## JavaScript methods

```blade
<button x-on:click="$flux.modal('confirm').show()">
    Open modal
</button>

<button x-on:click="$flux.modal('confirm').close()">
    Close modal
</button>

<button x-on:click="$flux.modals().close()">
    Close all modals
</button>
```

```blade
// Control "confirm" modals anywhere on the page...
Flux.modal('confirm').show()
Flux.modal('confirm').close()

// Closes all modals on the page...
Flux.modals().close()
```

## Data binding

```blade
<flux:modal wire:model.self="showConfirmModal">
    <!-- ... -->
</flux:modal>
```

```blade
<?php

class ShowPost extends \Livewire\Component
{
    public $showConfirmModal = false;

    public function delete()
    {
        $this->showConfirmModal = true;
    }
}
```

```blade
<flux:button x-on:click="$wire.showConfirmModal = true">Delete post</flux:button>
```

## Close events

```blade
<flux:modal @close="someLivewireAction">
    <!-- ... -->
</flux:modal>
```

## Cancel events

```blade
<flux:modal @cancel="someLivewireAction">
    <!-- ... -->
</flux:modal>
```

## Disable click outside

```blade
<flux:modal :dismissible="false">
    <!-- ... -->
</flux:modal>
```

## Confirmation

```blade
<flux:modal.trigger name="delete-profile">
    <flux:button variant="danger">Delete</flux:button>
</flux:modal.trigger>

<flux:modal name="delete-profile" class="min-w-[22rem]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Delete project?</flux:heading>

            <flux:text class="mt-2">
                You're about to delete this project.<br>
                This action cannot be reversed.
            </flux:text>
        </div>

        <div class="flex gap-2">
            <flux:spacer />

            <flux:modal.close>
                <flux:button variant="ghost">Cancel</flux:button>
            </flux:modal.close>

            <flux:button type="submit" variant="danger">Delete project</flux:button>
        </div>
    </div>
</flux:modal>
```

## Flyout

```blade
<flux:modal.trigger name="edit-profile">
    <flux:button>Edit profile</flux:button>
</flux:modal.trigger>

<flux:modal name="edit-profile" flyout>
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Update profile</flux:heading>
            <flux:text class="mt-2">Make changes to your personal details.</flux:text>
        </div>

        <flux:input label="Name" placeholder="Your name" />
        <flux:input label="Date of birth" type="date" />

        <div class="flex">
            <flux:spacer />
            <flux:button type="submit" variant="primary">Save changes</flux:button>
        </div>
    </div>
</flux:modal>
```

## Flyout positioning

```blade
<flux:modal flyout position="left">
    <!-- ... -->
</flux:modal>
```

```blade
<flux:modal.trigger name="edit-profile">
    <flux:button>Edit profile</flux:button>
</flux:modal.trigger>

<flux:modal name="edit-profile" flyout variant="floating" class="md:w-lg">
    <div class="space-y-6">
        <flux:heading size="lg">Update profile</flux:heading>
        <flux:subheading>Make changes to your personal details.</flux:subheading>
        <flux:input label="Name" placeholder="Your name" />
        <flux:input label="Date of birth" type="date" />
    </div>

    <x-slot name="footer" class="flex items-center justify-end gap-2">
        <flux:modal.close>
            <flux:button variant="filled">Cancel</flux:button>
        </flux:modal.close>

        <flux:button type="submit" variant="primary">Save changes</flux:button>
    </x-slot>
</flux:modal>
```

## Reference

### `flux:modal`

| Prop | Description |
| --- | --- |
| `name` | Unique identifier for the modal. Required when using triggers. |
| `flyout` | If `true`, the modal opens as a flyout. |
| `variant` | Options: `default`, `floating`, `bare` (legacy: `flyout`). |
| `position` | Flyout side. Options: `right` (default), `left`, `bottom`. |
| `dismissible` | If `false`, clicking outside wonâ€™t close. Default: `true`. |
| `closable` | If `false`, hides the close button. Default: `true`. |
| `wire:model` | Optional Livewire binding for open state. |

### `flux:modal.trigger`

| Prop | Description |
| --- | --- |
| `name` | Modal name to open (must match `flux:modal name`). |
| `shortcut` | Keyboard shortcut to open (e.g. `cmd.k`). |

### `flux:modal.close`

| Slot | Description |
| --- | --- |
| `default` | Close trigger element (e.g. button). |

### `Flux::modal()`

| Parameter | Description |
| --- | --- |
| `default|name` | Name of the modal to control. |

### `Flux::modals()`

| Method | Description |
| --- | --- |
| `close()` | Closes all modals on the page. |

### `$flux.modal()`

| Parameter | Description |
| --- | --- |
| `default|name` | Name of the modal to control. |
