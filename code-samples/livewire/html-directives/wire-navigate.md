# wire:navigate

source: https://livewire.laravel.com/docs/4.x/wire-navigate

Livewire

'

s `wire:navigate` feature makes page navigation much faster, providing an SPA-like experience for your users.This page is a simple reference for the `wire:navigate` directive. Be sure to read the page on Livewire's Navigate feature for more complete documentation.

#

# Basic usage

Simple example adding `wire:navigate` to links in a nav bar:



```blade
<nav>    <a href="/" wire:navigate>Dashboard</a>    <a href="/posts" wire:navigate>Posts</a>    <a href="/users" wire:navigate>Users</a></nav>

```



When any of these links are clicked, Livewire will intercept the click and, instead of allowing the browser to perform a full page visit, Livewire will fetch the page in the background and swap it with the current page.

#

# Styling active links with data-current

Livewire automatically adds a `data-current` attribute to any `wire:navigate` link that matches the current page URL.This allows you to style active navigation links using CSS or Tailwind without any additional directives:



```blade
<nav>    <a href="/" wire:navigate class="data-current:font-bold">Dashboard</a>    <a href="/posts" wire:navigate class="data-current:font-bold">Posts</a>    <a href="/users" wire:navigate class="data-current:font-bold">Users</a></nav>

```



The `data-current` attribute is added and removed automatically as users navigate between pages.Read more about highlighting active links in the Navigate documentation.

#

# Prefetching pages on hover

By adding the `.hover` modifier, Livewire will pre-fetch a page when a user hovers over a link.



```blade
<a href="/" wire:navigate.hover>Dashboard</a>

```



#

# Going deeper

For more complete documentation on this feature, visit Livewire's navigate documentation page.

#

# See also
- [Navigate](../features/navigate.md) Ã¢â‚¬â€ Complete guide to SPA navigation- [Pages](../essentials/pages.md) Ã¢â‚¬â€ Create routable page components- [@persist](../blade-directives/persist.md) Ã¢â‚¬â€ Persist elements during navigation

#

# Reference



```text
wire:navigate

```



#

#

# Modifiers
- `.hover`
