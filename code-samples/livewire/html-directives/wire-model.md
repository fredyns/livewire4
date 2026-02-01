# wire:model

source: https://livewire.laravel.com/docs/4.x/wire-modelLivewire makes it easy to bind a component property's value with form inputs using `wire:model`.Here is a simple example of using `wire:model` to bind the `$title` and `$content` properties with form inputs in a "Create Post" component:

```

phpuse App\Models\Post;use Livewire\Component;class CreatePost extends Component{    public $title = '';    public $content = '';    public function save()    {        $post = Post::create([            'title' => $this->title,            'content' => $this->content,        ]);        // ...    }}

```

```

blade<form wire:submit="save">    <label>        <span>Title</span>        <input type="text" wire:model="title">    </label>    <label>        <span>Content</span>        <textarea wire:model="content"></textarea>    </label>    <button type="submit">Save</button></form>

```

Because both inputs use `wire:model`, their values will be synchronized with the server's properties when the "Save" button is pressed.If you tried this in your browser and are confused why the title isn't automatically updating, it's because Livewire only updates a component when an action is submitted—like pressing a submit button—not when a user types into a field.This cuts down on network requests and improves performance.To enable "live" updating as a user types, you can use `wire:model.live` instead. Learn more about data binding.

#

# Customizing update timingBy default, Livewire will only send a network request when an action is performed (like `wire:click` or `wire:submit`), NOT when a `wire:model` input is updated.This drastically improves performance by reducing network requests and provides a smoother experience for your users.However, there are occasions where you may want to update the server more frequently for things like real-time validation.

#

#

# Live updatingTo send property updates to the server as a user types into an input-field, append the `.live` modifier:

```

blade<input type="text" wire:model.live="title">

```

#

#

#

# Customizing the debounceBy default, when using `wire:model.live`, Livewire adds a 150 millisecond debounce to server updates.If a user is continually typing, Livewire will wait until the user stops typing for 150 milliseconds before sending a request.You can customize this timing by appending `.debounce.Xms` after `.live`. Example changing the debounce to 250 milliseconds:

```

blade<input type="text" wire:model.live.debounce.250ms="title">

```

#

#

# Updating on "blur" eventThe `.blur` modifier delays syncing until the user clicks away from the input:

```

blade<input type="text" wire:model.blur="title">

```

To also send a network request on blur, add `.live`:

```

blade<input type="text" wire:model.blur.live="title">

```

#

#

# Updating on "change" eventThe `.change` modifier triggers on the change event, which is useful for select elements:

```

blade<select wire:model.change="state">...</select><!-- With network request --><select wire:model.change.live="state">...</select>

```

#

#

# Updating on "enter" keyThe `.enter` modifier syncs when the user presses the Enter key:

```

blade<input type="text" wire:model.enter="search"><!-- With network request --><input type="text" wire:model.enter.live="search">

```

#

# Input fieldsLivewire supports most native input elements out of the box.Meaning you should just be able to attach `wire:model` to any input element in the browser and easily bind properties to them.

#

#

# Text inputs

```

blade<input type="text" wire:model="title">

```

#

#

# Textarea inputs

```

blade<textarea type="text" wire:model="content"></textarea>

```

If the "content" value is initialized with a string, Livewire will fill the textarea with that value.There's no need to do something like the following:

```

blade<!-- Warning: This snippet demonstrates what NOT to do... --><textarea type="text" wire:model="content">{{ $content }}</textarea>

```

#

#

# CheckboxesCheckboxes can be used for single values (like a boolean property), or they may be used to toggle a single value in a group of related values.

#

#

#

# Single checkboxExample binding a boolean property `$receiveUpdates`:

```

blade<input type="checkbox" wire:model="receiveUpdates">

```

When `$receiveUpdates` is false, the checkbox will be unchecked. When the value is true, the checkbox will be checked.

#

#

#

# Multiple checkboxesExample binding multiple checkboxes to `$updateTypes`, an array property:

```

phppublic $updateTypes = [];

```

```

blade<input type="checkbox" value="email" wire:model="updateTypes"><input type="checkbox" value="sms" wire:model="updateTypes"><input type="checkbox" value="notification" wire:model="updateTypes">

```

If the user checks the first two boxes but not the third, `$updateTypes` will be:

```

text["email", "sms"]

```

#

#

# Radio buttonsTo toggle between two different values for a single property, you may use radio buttons:

```

blade<input type="radio" value="yes" wire:model="receiveUpdates"><input type="radio" value="no" wire:model="receiveUpdates">

```

#

#

# Select dropdownsWhen adding `wire:model` to a dropdown, the currently selected value will be bound to the provided property name and vice versa.There is no need to manually add `selected` to the option that will be selected — Livewire handles that for you automatically.Example select dropdown with a static list of states:

```

blade<select wire:model="state">    <option value="AL">Alabama</option>    <option value="AK">Alaska</option>    <option value="AZ">Arizona</option>    ...</select>

```

When a specific state is selected (for example "Alaska"), the `$state` property will be set to `AK`.If you would prefer the value to be set to "Alaska" instead of "AK", you can leave the `value=""` attribute off the `<option>` element entirely.Often, you may build your dropdown options dynamically using Blade:

```

blade<select wire:model="state">    @foreach (\App\Models\State::all() as $state)        <option value="{{ $state->id }}">{{ $state->label }}</option>    @endforeach</select>

```

If you don't have a specific option selected by default, you may want to show a muted placeholder option by default:

```

blade<select wire:model="state">    <option disabled value="">Select a state...</option>    @foreach (\App\Models\State::all() as $state)        <option value="{{ $state->id }}">{{ $state->label }}</option>    @endforeach</select>

```

#

#

# Dependent select dropdownsSometimes you may want one select menu to be dependent on another.For example, a list of cities that changes based on which state is selected.You must add a `wire:key` to the changing select so that Livewire properly refreshes its value when the options change.

```

blade<!-- States select menu... --><select wire:model.live="selectedState">    @foreach (State::all() as $state)        <option value="{{ $state->id }}">{{ $state->label }}</option>    @endforeach</select><!-- Cities dependent select menu... --><select wire:model.live="selectedCity" wire:key="{{ $selectedState }}">    @foreach (City::whereStateId($selectedState->id)->get() as $city)        <option value="{{ $city->id }}">{{ $city->label }}</option>    @endforeach</select>

```

#

#

# Multi-select dropdownsIn a "multiple" select menu, states will be added to the `$states` array property when they are selected and removed if they are deselected:

```

blade<select wire:model="states" multiple>    <option value="AL">Alabama</option>    <option value="AK">Alaska</option>    <option value="AZ">Arizona</option>    ...</select>

```

#

# Event propagationBy default, `wire:model` only listens for input/change events that originate directly on the element itself, not events that bubble up from child elements.This prevents unexpected behavior when using `wire:model` on container elements like modals or accordions that contain other form inputs.In rare cases where you want `wire:model` to also respond to events bubbling up from child elements, you can use the `.deep` modifier:

```

blade<div wire:model.deep="value">    <input type="text">    <!-- Changes here will update $value --></div>

```

Most use cases don't require listening to child events. Only use `.deep` when you specifically need to capture events from descendant elements.

#

# Going deeperFor more complete documentation on using `wire:model` in the context of HTML forms, visit the Livewire forms documentation page.

#

# See also- [Forms](../essentials/forms.md) — Complete guide to building forms with Livewire- [Properties](../essentials/properties.md) — Understand data binding and property management- [Validation](../features/validation.md) — Validate bound properties in real-time- [File Uploads](../features/uploads.md) — Bind file inputs with wire:model

#

# Reference

```

textwire:model="propertyName"

```

#

#

# Modifiers- `.live`- `.blur`- `.change`- `.enter`- `.lazy`- `.debounce.Xms`- `.throttle.Xms`- `.number`- `.boolean`- `.fill`- `.deep`- `.preserve-scroll`
