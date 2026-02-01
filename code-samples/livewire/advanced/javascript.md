# JavaScript

source: https://livewire.laravel.com/docs/4.x/javascriptLivewire and Alpine provide plenty of utilities for building dynamic components directly in HTML, however sometimes it’s helpful to execute plain JavaScript.The examples use bare `<script>` tags (works for single-file and multi-file components). For class-based components (Blade view separate from the PHP class), wrap scripts with `@script`:

```

blade@script<script>    // Your JavaScript here...</script>@endscript

```

#

# Component scriptsYou can add `<script>` tags directly inside your component template. Livewire handles the execution timing so they run at the correct time without needing `document.addEventListener('...')` wrappers.Example:

```

blade<div>    ...</div><script>    // This Javascript will get executed every time this component is loaded onto the page...</script>

```

Example registering a JavaScript action:

```

blade<div>    <button wire:click="$js.increment">+</button></div><script>    this.$js.increment = () => {        console.log('increment')    }</script>

```

Learn more: #

# $wireWhen you add `<script>` tags inside your component, you automatically have access to your component’s `$wire` object.Example refreshing every 2 seconds:

```

html<script>    setInterval(() => {        $wire.$refresh()    }, 2000)</script>

```

The `$wire` object is the JavaScript interface to your Livewire component:

```

js// Access and modify properties$wire.count$wire.count = 5$wire.$set('count', 5)// Call component methods$wire.save()$wire.delete(postId)// Refresh the component$wire.$refresh()// Dispatch events$wire.$dispatch('post-created', { postId: 2 })// Listen for events$wire.$on('post-created', (event) => {    console.log(event.postId)})// Access the root element$wire.$el.querySelector('.modal')

```

#

# Loading external assets with @assetsComponent `<script>` tags are useful for per-load code, but sometimes you want to load whole assets once per page.Example loading Pikaday:

```

blade<div>    <input type="text" data-picker></div>@assets    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js" defer></script>    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">@endassets<script>    new Pikaday({ field: $wire.$el.querySelector('[data-picker]') })</script>

```

Livewire ensures `@assets` blocks are only loaded once per page.#

# InterceptorsIntercept Livewire requests at three levels: action (most granular), message (per-component), and request (HTTP level).

```

js// Action interceptors$wire.intercept(callback)$wire.intercept('save', callback)Livewire.interceptAction(callback)// Message interceptors$wire.interceptMessage(callback)$wire.interceptMessage('save', callback)Livewire.interceptMessage(callback)// Request interceptors$wire.interceptRequest(callback)$wire.interceptRequest('save', callback)Livewire.interceptRequest(callback)

```

All interceptors return an unsubscribe function:

```

jslet unsubscribe = $wire.intercept(callback)unsubscribe()

```

##

# Action interceptors

```

js$wire.intercept(({ action, onSend, onCancel, onSuccess, onError, onFailure, onFinish }) => {    // action.name
- Method name ('save', '$refresh', etc.)    // action.params
- Method parameters    // action.component
- Component instance    // action.cancel()
- Cancel this action    onSend(({ call }) => {        // call: { method, params, metadata }    })    onCancel(() => {})    onSuccess((result) => {        // result: Return value from PHP method    })    onError(({ response, body, preventDefault }) => {        preventDefault() // Prevent error modal    })    onFailure(({ error }) => {        // error: Network error    })    onFinish(() => {        // Runs after DOM morph completes (or on error/cancel)    })})

```

##

# Message interceptors

```

js$wire.interceptMessage(({ message, cancel, onSend, onCancel, onSuccess, onError, onFailure, onStream, onFinish }) => {    // message.component
- Component instance    // message.actions
- Set of actions in this message    onSend(({ payload }) => {        // payload: { snapshot, updates, calls }    })    onSuccess(({ payload, onSync, onEffect, onMorph, onRender }) => {        onSync(() => {})        onEffect(() => {})        onMorph(async () => {})        onRender(() => {})    })    onError(({ response, body, preventDefault }) => {        preventDefault()    })    onStream(({ json }) => {        // json: Parsed stream chunk    })    onFinish(() => {})})

```

#

##

# TimingHook order for successful requests:1. `onSuccess`2. `onSync`3. `onEffect`4. `onMorph`5. `onFinish`6. `onRender` (via `requestAnimationFrame`)Action promises (`.then()`) resolve at the same time as `onFinish`.

##

# Request interceptors

```

js$wire.interceptRequest(({ request, onSend, onCancel, onSuccess, onError, onFailure, onResponse, onParsed, onStream, onRedirect, onDump, onFinish }) => {    // request.messages
- Set of messages in this request    // request.cancel()
- Cancel this request    onResponse(({ response }) => {        // response: Fetch Response (before body read)    })    onParsed(({ response, body }) => {        // body: Response body as string    })    onError(({ response, body, preventDefault }) => {        preventDefault()    })    onRedirect(({ url, preventDefault }) => {        preventDefault()    })    onDump(({ html, preventDefault }) => {        preventDefault()    })    onFinish(() => {})})

```

#

# livewire:init / livewire:initializedLivewire dispatches two browser events for extension points:

```

html<script>    document.addEventListener('livewire:init', () => {        // Runs after Livewire is loaded but before initialization...    })    document.addEventListener('livewire:initialized', () => {        // Runs immediately after Livewire has finished initializing...    })</script>

```

#

# The global Livewire objectUse `window.Livewire` to interact with Livewire from external scripts.

##

# Accessing components

```

jslet component = Livewire.first()let component = Livewire.find(id)let components = Livewire.getByName(name)let components = Livewire.all()

```

##

# Events

```

jsLivewire.dispatch('post-created', { postId: 2 })Livewire.dispatchTo('dashboard', 'post-created', { postId: 2 })Livewire.on('post-created', ({ postId }) => {    // ...})

```

When using Alpine and `wire:navigate`, ensure global listeners don’t accumulate; unregister them in an Alpine `destroy()`.

```

jsAlpine.data('MyComponent', () => ({    listeners: [],    init() {        this.listeners.push(            Livewire.on('post-created', (options) => {                // Do something...            })        )    },    destroy() {        this.listeners.forEach((listener) => {            listener()        })    },}))

```

##

# Livewire.hook()

```

jsLivewire.hook('component.init', ({ component, cleanup }) => {    // ...})

```

#

# Custom directivesRegister directives with `Livewire.directive()`.Example: a custom `wire:confirm` directive:

```

blade<button wire:confirm="Are you sure?" wire:click="delete">Delete post</button>

```

```

jsLivewire.directive('confirm', ({ el, directive, component, cleanup }) => {    let content = directive.expression    let onClick = e => {        if (! confirm(content)) {            e.preventDefault()            e.stopImmediatePropagation()        }    }    el.addEventListener('click', onClick, { capture: true })    cleanup(() => {        el.removeEventListener('click', onClick)    })})

```

#

# JavaScript hooksHook into initialization:

```

jsLivewire.hook('component.init', ({ component, cleanup }) => {    //})Livewire.hook('element.init', ({ component, el }) => {    //})

```

Morphing hooks:

```

jsLivewire.hook('morph.updating', ({ el, component, toEl, skip, childrenOnly }) => {})Livewire.hook('morph.updated', ({ el, component }) => {})Livewire.hook('morph.removing', ({ el, component, skip }) => {})Livewire.hook('morph.removed', ({ el, component }) => {})Livewire.hook('morph.adding', ({ el, component }) => {})Livewire.hook('morph.added', ({ el }) => {})Livewire.hook('morph', ({ el, component }) => {})Livewire.hook('morphed', ({ el, component }) => {})

```

#

# js()Use the `js()` method from PHP to evaluate JavaScript expressions after a server-side action:

```

php<?php// resources/views/components/post/⚡create.blade.phpuse Livewire\Component;new class extends Component {    public $title = '';    public function save()    {        // Save post to database...        $this->js("alert('Post saved!')");    }};

```

You can access `$wire` inside the expression:

```

php$this->js('$wire.$refresh()');$this->js('$wire.$dispatch("post-created", { id: ' . $post->id . ' })');

```

#

# Common patternsInitialize libraries when your component loads:

```

blade<div>    <div id="map" style="height: 400px;"></div></div>@assets    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY"></script>@endassets<script>    new google.maps.Map($wire.$el.querySelector('#map'), {        center: { lat: {{ $latitude }}, lng: {{ $longitude }} },        zoom: 12,    })</script>

```

Sync state with localStorage:

```

html<script>    if (localStorage.getItem('draft')) {        $wire.content = localStorage.getItem('draft')    }    $wire.$watch('content', (value) => {        localStorage.setItem('draft', value)    })</script>

```

#

# @jsUse Blade `@js` to output PHP data into JavaScript:

```

html<script>    let posts = @js($posts)</script>

```

#

# GuidanceUse component scripts when:- The JavaScript is specific to the component- You need access to `$wire` or component-specific data- It should run every time the component loadsUse global scripts when:- Registering custom directives/hooks- App-wide listeners#

# DebuggingAccess components from browser console:

```

jslet $wire = Livewire.first()console.log($wire.count)$wire.increment()

```

Monitor all requests:

```

jsLivewire.interceptRequest(({ onSend }) => {    onSend(() => {        console.log('Request sent:', Date.now())    })})

```

View component snapshots:

```

jslet component = Livewire.first().__instance()console.log(component.snapshot)

```

#

# Performance tips- Use `wire:ignore` for elements Livewire shouldn’t touch- Debounce expensive work using `wire:model.debounce`- Use lazy loading (`lazy` parameter) for components not immediately visible- Consider islands for isolated update regions#

# See also-
- -
- -
