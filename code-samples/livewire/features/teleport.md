# Teleportsource: https://livewire.laravel.com/docs/4.x/teleport

Livewire allows you to teleport part of your template to another part of the DOM on the page entirely.This is useful for things like nested dialogs. When nesting one dialog inside of another, the z-index of the parent modal is applied to the nested modal. This can cause problems with styling backdrops and overlays.To avoid this problem, you can use Livewire's `@teleport` directive to render each nested modal as siblings in the rendered DOM.This functionality is powered by Alpine's `x-teleport` directive.

#

# Basic usage

To teleport a portion of your template to another part of the DOM, wrap it in Livewire's `@teleport` directive.Example rendering a modal dialog's contents at the end of the `<body>` element:



```blade
<div>    <!-- Modal -->    <div x-data="{ open: false }">        <button @click="open = ! open">Toggle Modal</button>        @teleport('body')            <div x-show="open">                Modal contents...            </div>        @endteleport    </div></div>

```



The `@teleport` selector can be any string you would normally pass into something like `document.querySelector()`.Now, when the above Livewire template is rendered on the page, the contents portion of the modal will be rendered at the end of `<body>`.Livewire only supports teleporting HTML outside your components. For example, teleporting a modal to the `<body>` tag is fine, but teleporting it to another element within your component will not work.Make sure you only include a single root element inside your `@teleport` statement.
