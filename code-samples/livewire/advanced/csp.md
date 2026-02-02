# CSP

source: https://livewire.laravel.com/docs/4.x/csp

Livewire offers a CSP-safe build that allows you to use Livewire applications in environments with strict Content Security Policy (CSP) headers that prohibit `'unsafe-eval'`.

#

# What is Content Security Policy (CSP)?

CSP is a security standard that helps prevent attacks like XSS and code injection by controlling which resources a browser may load and execute.One of the most restrictive CSP directives is `'unsafe-eval'`. When omitted, it prevents JavaScript from executing dynamic code through `eval()`, `new Function()`, and similar constructs.

#

# Why CSP affects Livewire

By default, Livewire (and Alpine.js) uses `new Function()` to compile and execute JavaScript expressions from HTML attributes like:



```blade
<button wire:click="$set('count', count + 1)">Increment</button><div wire:show="user.role === 'admin'">Admin panel</div>

```



This approach is faster and safer than `eval()` but still violates CSP policies that forbid `'unsafe-eval'`.

#

# Enabling CSP-safe mode

Set `csp_safe` to `true` in `config/livewire.php`:



```php
'csp_safe' => true,

```



#

#

# Impact on Alpine.js

Enabling CSP-safe mode affects Alpine too: it will use its CSP-safe evaluator, and expressions will be subject to parsing limitations.

#

# What's supported

#

#

# Basic Livewire expressions



```blade
<!-- These work --><button wire:click="increment">+</button><button wire:click="decrement">-</button><button wire:click="reset">Reset</button><button wire:click="save">Save</button><input wire:model="name"><input wire:model.live="search">

```



#

#

# Method calls with parameters



```blade
<!-- These work --><button wire:click="updateUser('John', 25)">Update User</button><button wire:click="setCount(42)">Set Count</button><button wire:click="saveData({ name: 'John', age: 30 })">Save Object</button>

```



#

#

# Property access and updates



```blade
<!-- These work --><input wire:model="user.name"><input wire:model="settings.theme"><button wire:click="$set('user.active', true)">Activate</button><div wire:show="user.role === 'admin'">Admin Panel</div>

```



#

#

# Basic expressions in Alpine



```html
<!-- These work --><div x-data="{ count: 0, name: 'Livewire' }" wire:ignore>    <button x-on:click="count++">Increment</button>    <span x-text="count"></span>    <span x-text="'Hello ' + name"></span>    <div x-show="count > 5">Count is high!</div></div>

```



#

# What's not supported

#

#

# Complex Java

Script expressions



```blade
<!-- These don't work --><button wire:click="items.filter(i => i.active).length">Count Active</button><div wire:show="users.some(u => u.role === 'admin')">Has Admin</div><button wire:click="(() => console.log('Hi'))()">Complex Function</button>

```



#

#

# Template literals and advanced syntax



```html
<!-- These don't work --><div x-text="`Hello ${name}`">Bad</div><div x-data="{ ...defaults }">Bad</div><button x-on:click="() => doSomething()">Bad</button>

```



#

#

# Dynamic property access



```blade
<!-- These don't work --><div wire:show="user[dynamicProperty]">Bad</div><button wire:click="this[methodName]()">Bad</button>

```



#

# Working around limitations

For complex Alpine expressions, use `Alpine.data()` or move logic to methods:



```html
<!-- Instead of complex inline expressions --><div x-data="users">    <div x-show="hasActiveAdmins">Admin panel available</div>    <span x-text="activeUserCount">0</span></div><script nonce="[nonce]">    Alpine.data('users', () => ({        users: ...,         get hasActiveAdmins() {            return this.users.filter(u => u.active && u.role === 'admin').length > 0        },        get activeUserCount() {            return this.users.filter(u => u.active).length        },    }))</script>

```



#

# CSP headers example



```text
Content-Security-Policy: default-src 'self'; script-src 'nonce-[random]' 'strict-dynamic'; style-src 'self' 'unsafe-inline';

```



Key points:- Remove `'unsafe-eval'` from `script-src`- Use nonce-based script loading (`'nonce-[random]'`)- Consider `'strict-dynamic'`

#

# Performance considerations

The CSP-safe build uses a different expression evaluator:
- Parsing: slightly slower initial parsing (usually negligible)- Runtime: similar runtime performance for simple expressions- Bundle size: slightly larger

#

# Testing your CSP implementation1. Enable CSP headers in your web server/app2. Check devtools console for CSP violations3. Verify Livewire/Alpine expressions still work4. Ensure no unsafe-eval errors appear

#

# When to use CSP-safe mode

Consider CSP-safe mode when:
- Your application requires strict CSP compliance- Organizational policy prohibits `'unsafe-eval'`- You deploy to platforms with mandatory CSP restrictions
