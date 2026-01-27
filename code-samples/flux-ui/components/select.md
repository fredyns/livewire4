# Select

Source: https://fluxui.dev/components/select

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:select</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:model</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"industry"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> placeholder</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Choose industry..."</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:select.option</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Photography</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:select.option</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:select.option</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Design services</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:select.option</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:select.option</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Web development</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:select.option</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:select.option</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Accounting</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:select.option</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:select.option</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Legal services</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:select.option</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:select.option</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Consulting</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:select.option</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:select.option</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Other</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:select.option</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:select</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## Small

```blade
<flux:select size="sm" placeholder="Choose industry...">
    <flux:select.option>Photography</flux:select.option>
    <flux:select.option>Design services</flux:select.option>
    <flux:select.option>Web development</flux:select.option>
    <flux:select.option>Accounting</flux:select.option>
    <flux:select.option>Legal services</flux:select.option>
    <flux:select.option>Consulting</flux:select.option>
    <flux:select.option>Other</flux:select.option>
</flux:select>
```

## Custom select

```blade
<flux:select variant="listbox" placeholder="Choose industry...">
    <flux:select.option>Photography</flux:select.option>
    <flux:select.option>Design services</flux:select.option>
    <flux:select.option>Web development</flux:select.option>
    <flux:select.option>Accounting</flux:select.option>
    <flux:select.option>Legal services</flux:select.option>
    <flux:select.option>Consulting</flux:select.option>
    <flux:select.option>Other</flux:select.option>
</flux:select>
```

## The button slot

```blade
<flux:select variant="listbox">
    <x-slot name="button">
        <flux:select.button class="rounded-full!" placeholder="Choose industry..." :invalid="$errors->has('...')" />
    </x-slot>

    <flux:select.option>Photography</flux:select.option>
    ...
</flux:select>
```

## Clearable

```blade
<flux:select variant="listbox" clearable>
    ...
</flux:select>
```

## Options with images/icons

```blade
<flux:select variant="listbox" placeholder="Select role...">
    <flux:select.option>
        <div class="flex items-center gap-2">
            <flux:icon.shield-check variant="mini" class="text-zinc-400" /> Owner
        </div>
    </flux:select.option>

    <flux:select.option>
        <div class="flex items-center gap-2">
            <flux:icon.key variant="mini" class="text-zinc-400" /> Administrator
        </div>
    </flux:select.option>

    <flux:select.option>
        <div class="flex items-center gap-2">
            <flux:icon.user variant="mini" class="text-zinc-400" /> Member
        </div>
    </flux:select.option>

    <flux:select.option>
        <div class="flex items-center gap-2">
            <flux:icon.eye variant="mini" class="text-zinc-400" /> Viewer
        </div>
    </flux:select.option>
</flux:select>
```

## Searchable select

```blade
<flux:select variant="listbox" searchable placeholder="Choose industries...">
    <flux:select.option>Photography</flux:select.option>
    <flux:select.option>Design services</flux:select.option>
    <flux:select.option>Web development</flux:select.option>
    <flux:select.option>Accounting</flux:select.option>
    <flux:select.option>Legal services</flux:select.option>
    <flux:select.option>Consulting</flux:select.option>
    <flux:select.option>Other</flux:select.option>
</flux:select>
```

## The search slot

```blade
<flux:select variant="listbox" searchable>
    <x-slot name="search">
        <flux:select.search class="px-4" placeholder="Search industries..." />
    </x-slot>

    ...
</flux:select>
```

## Multiple select

```blade
<flux:select variant="listbox" multiple placeholder="Choose industries...">
    <flux:select.option>Photography</flux:select.option>
    <flux:select.option>Design services</flux:select.option>
    <flux:select.option>Web development</flux:select.option>
    <flux:select.option>Accounting</flux:select.option>
    <flux:select.option>Legal services</flux:select.option>
    <flux:select.option>Consulting</flux:select.option>
    <flux:select.option>Other</flux:select.option>
</flux:select>
```

## Selected suffix

```blade
<flux:select variant="listbox" selected-suffix="industries selected" multiple>
    ...
</flux:select>
```

```blade
<flux:select variant="listbox" selected-suffix="{{ __('industries selected') }}" multiple>
    ...
</flux:select>
```

## Checkbox indicator

```blade
<flux:select variant="listbox" indicator="checkbox" multiple>
    ...
</flux:select>
```

## Clearing search

```blade
<flux:select variant="listbox" searchable multiple clear="close">
    ...
</flux:select>
```

## Combobox

```blade
<flux:select variant="combobox" placeholder="Choose industry...">
    <flux:select.option>Photography</flux:select.option>
    <flux:select.option>Design services</flux:select.option>
    <flux:select.option>Web development</flux:select.option>
    <flux:select.option>Accounting</flux:select.option>
    <flux:select.option>Legal services</flux:select.option>
    <flux:select.option>Consulting</flux:select.option>
    <flux:select.option>Other</flux:select.option>
</flux:select>
```

## The input slot

```blade
<flux:select variant="combobox">
    <x-slot name="input">
        <flux:select.input x-model="search" :invalid="$errors->has('...')" />
    </x-slot>

    ...
</flux:select>
```

## Backend search

```blade
<flux:select wire:model="userId" variant="combobox" :filter="false">
    <x-slot name="input">
        <flux:select.input wire:model.live="search" />
    </x-slot>

    @foreach ($this->users as $user)
        <flux:select.option value="{{ $user->id }}" wire:key="{{ $user->id }}">
            {{ $user->name }}
        </flux:select.option>
    @endforeach
</flux:select>

<!--
public $search = '';
public $userId = null;

#[\Livewire\Attributes\Computed]
public function users() {
    return \App\Models\User::query()
        ->when($this->search, fn($query) => $query->where('name', 'like', '%' . $this->search . '%'))
        ->limit(20)
        ->get();
}
-->
```

## Create option

```blade
<flux:select wire:model="projectId" variant="combobox">
    <x-slot name="input">
        <flux:select.input wire:model="search" placeholder="Start typing..." />
    </x-slot>

    @foreach ($this->projects as $project)
        <flux:select.option :wire:key="$project->id">{{ $project->name }}</flux:select.option>
    @endforeach

    <flux:select.option.create wire:click="createProject" min-length="2">
        Create "<span wire:text="search"></span>"
    </flux:select.option.create>
</flux:select>

<!--
public $search = '';
public $projectId = null;

public function createProject(){
    $project = Project::create([
        'name' => $this->search,
    ]);

    $this->projectId = $project->id;
}
-->
```

```blade
<flux:select wire:model="projectId" variant="combobox" :filter="false">
    <x-slot name="input">
        <flux:select.input wire:model.live="search" placeholder="Start typing..." />
    </x-slot>

    @foreach($this->projects as $project)
        <flux:select.option :value="$project->id">{{ $project->name }}</flux:select.option>
    @endforeach

    <flux:select.option.create wire:click="createProject" min-length="2">
        Create "<span wire:text="search"></span>"
    </flux:select.option.create>
</flux:select>

<!--
#[\Livewire\Attributes\Computed]
public function projects() {
    return Project::query()
        ->where('name', 'like', '%' . trim($this->search) . '%')
        ->limit(20)->get()
        ->when(blank($this->search) && $this->projectId, function ($results) {
            return Project::query()
                ->whereIn('id', [$this->projectId])
                ->whereNotIn('id', $results->pluck('id'))
                ->get()->merge($results);
        });
}
-->
```

## With listbox variant

```blade
public function createProject() {
    // Create logic...

    $this->search = '';
}
```

## Loading message

```blade
<flux:select wire:model="projectId" variant="combobox" :filter="false">
    ...

    <x-slot name="empty">
        <flux:select.option.empty when-loading="Loading projects...">
            No projects found.
        </flux:select.option.empty>
    </x-slot>
</flux:select>
```

```blade
<flux:select wire:model="projectId" variant="combobox" :filter="false">
    <x-slot name="input">
        <flux:select.input wire:model.live="search" placeholder="Start typing..." />
    </x-slot>

    ...

    <flux:select.option.create wire:click="createProject" min-length="2">
        Create "<span wire:text="search"></span>"
    </flux:select.option.create>
</flux:select>

<!--
public function createProject() {
    $this->validate(['search' => 'required|unique:projects,name']);
    // Create logic...
}

public function updatedSearch() {
    $this->resetErrorBag('search');
}
-->
```

```blade
<flux:select wire:model="projectId" variant="listbox">
    @foreach($this->projects as $project)
        <flux:select.option :value="$project->id">{{ $project->name }}</flux:select.option>
    @endforeach

    <flux:select.option.create modal="create-project">Create new</flux:select.option>
</flux:select>

<flux:modal name="create-project" class="md:w-96">
    <form wire:submit="createProject" class="space-y-6">
        <div>
            <flux:heading size="lg">Create new project</flux:heading>
            <flux:text class="mt-2">Enter the name of the new project.</flux:text>
        </div>

        <flux:input wire:model="projectName" label="Name" placeholder="e.g. 'UX Research'" />

        <div class="flex">
            <flux:spacer />
            <flux:button type="submit" variant="primary">Create</flux:button>
        </div>
    </form>
</flux:modal>
```

## Reference

### `flux:select`

| Prop | Description |
| --- | --- |
| `wire:model` | Binds the select to a Livewire property. |
| `placeholder` | Text when no option is selected. |
| `label` | Label text (wraps in `flux:field` + `flux:label`). |
| `description` | Help text between label and select. |
| `description:trailing` | Show description below the select. |
| `badge` | Badge text at end of label. |
| `size` | Options: `sm`, `xs`. |
| `variant` | Options: `default` (native), `listbox`, `combobox`. |
| `multiple` | Multiple selection (listbox only). |
| `filter` | If `false`, disables client-side filtering. |
| `searchable` | Adds search (listbox/combobox only). |
| `empty` | Empty message for searchable selects. |
| `clearable` | Shows clear button (listbox/combobox only). |
| `selected-suffix` | Suffix for count of selected options (multiple listbox). |
| `clear` | When to clear search. Options: `select` (default), `close`. |
| `disabled` | Disables interaction. |
| `invalid` | Error styling. |

### `flux:select.option`

| Prop | Description |
| --- | --- |
| `value` | Option value. |
| `label` | Display text. |
| `selected-label` | Display text when selected. |
| `disabled` | Disables selection. |

### `flux:select.option.create`

| Prop | Description |
| --- | --- |
| `min-length` | Minimum chars before showing create option. |
| `modal` | Modal name to open when selected. |
| `wire:click` | Livewire action when selected. |

### `flux:select.option.empty`

| Prop | Description |
| --- | --- |
| `when-loading` | Loading message. |

### `flux:select.button`

| Prop | Description |
| --- | --- |
| `placeholder` | Text when no option is selected. |
| `invalid` | Error styling. |
| `size` | Options: `sm`, `xs`. |
| `disabled` | Disables selection. |
| `clearable` | Shows clear button when selected. |

### `flux:select.input`

| Prop | Description |
| --- | --- |
| `placeholder` | Text when no option is selected. |
| `invalid` | Error styling. |
| `size` | Options: `sm`, `xs`. |

### `flux:select.search`

| Prop | Description |
| --- | --- |
| `placeholder` | Placeholder text. |
| `icon` | Leading icon name. |
| `clearable` | Shows clear button. Default: `true`. |
