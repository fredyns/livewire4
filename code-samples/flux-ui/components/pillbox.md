# Pillbox - PRO

Source: https://fluxui.dev/components/pillbox

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:pillbox</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:model</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"selectedTags"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> multiple</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> placeholder</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Choose tags..."</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:pillbox.option</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> value</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"design"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Design</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:pillbox.option</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:pillbox.option</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> value</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"development"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Development</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:pillbox.option</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:pillbox.option</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> value</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"marketing"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Marketing</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:pillbox.option</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:pillbox.option</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> value</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"sales"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Sales</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:pillbox.option</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:pillbox.option</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> value</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"support"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Support</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:pillbox.option</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:pillbox.option</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> value</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"engineering"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Engineering</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:pillbox.option</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:pillbox.option</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> value</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"product"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Product</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:pillbox.option</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:pillbox.option</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> value</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"operations"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span><span style="color:#424258;--shiki-dark:#EEFFFF">Operations</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:pillbox.option</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:pillbox</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## Small

```blade
<flux:pillbox size="sm" multiple placeholder="Choose tags...">
    <flux:pillbox.option value="design">Design</flux:pillbox.option>
    <flux:pillbox.option value="development">Development</flux:pillbox.option>
    <flux:pillbox.option value="marketing">Marketing</flux:pillbox.option>
    <flux:pillbox.option value="sales">Sales</flux:pillbox.option>
    <flux:pillbox.option value="support">Support</flux:pillbox.option>
    <flux:pillbox.option value="engineering">Engineering</flux:pillbox.option>
    <flux:pillbox.option value="product">Product</flux:pillbox.option>
    <flux:pillbox.option value="operations">Operations</flux:pillbox.option>
</flux:pillbox>
```

## Searchable

```blade
<flux:pillbox multiple searchable placeholder="Choose skills...">
    <flux:pillbox.option value="javascript">JavaScript</flux:pillbox.option>
    <flux:pillbox.option value="typescript">TypeScript</flux:pillbox.option>
    <flux:pillbox.option value="php">PHP</flux:pillbox.option>
    <flux:pillbox.option value="python">Python</flux:pillbox.option>
    <flux:pillbox.option value="ruby">Ruby</flux:pillbox.option>
    <flux:pillbox.option value="go">Go</flux:pillbox.option>
    <flux:pillbox.option value="rust">Rust</flux:pillbox.option>
    <flux:pillbox.option value="java">Java</flux:pillbox.option>
    <flux:pillbox.option value="csharp">C#</flux:pillbox.option>
    <flux:pillbox.option value="swift">Swift</flux:pillbox.option>
</flux:pillbox>
```

## Custom search placeholder

```blade
<flux:pillbox multiple searchable search:placeholder="Filter skills...">
    ...
</flux:pillbox>
```

## With icons

```blade
<flux:pillbox multiple placeholder="Choose platforms...">
    <flux:pillbox.option value="github">
        <div class="flex items-center gap-2">
            <flux:icon.code-bracket variant="mini" class="text-zinc-400" /> GitHub
        </div>
    </flux:pillbox.option>

    <flux:pillbox.option value="gitlab">
        <div class="flex items-center gap-2">
            <flux:icon.server variant="mini" class="text-zinc-400" /> GitLab
        </div>
    </flux:pillbox.option>

    <flux:pillbox.option value="bitbucket">
        <div class="flex items-center gap-2">
            <flux:icon.cloud variant="mini" class="text-zinc-400" /> Bitbucket
        </div>
    </flux:pillbox.option>
</flux:pillbox>
```

## Combobox

```blade
<flux:pillbox variant="combobox" multiple placeholder="Choose skills...">
    <flux:pillbox.option value="javascript">JavaScript</flux:pillbox.option>
    <flux:pillbox.option value="typescript">TypeScript</flux:pillbox.option>
    <flux:pillbox.option value="php">PHP</flux:pillbox.option>
    <flux:pillbox.option value="python">Python</flux:pillbox.option>
    <flux:pillbox.option value="ruby">Ruby</flux:pillbox.option>
    <flux:pillbox.option value="go">Go</flux:pillbox.option>
    <flux:pillbox.option value="rust">Rust</flux:pillbox.option>
    <flux:pillbox.option value="java">Java</flux:pillbox.option>
    <flux:pillbox.option value="csharp">C#</flux:pillbox.option>
    <flux:pillbox.option value="swift">Swift</flux:pillbox.option>
</flux:pillbox>
```

## Create option

```blade
<flux:pillbox wire:model="selectedTags" variant="combobox" multiple>
    <x-slot name="input">
        <flux:pillbox.input wire:model="search" placeholder="Choose tags..." />
    </x-slot>

    @foreach ($this->tags as $tag)
        <flux:pillbox.option :value="$tag->id">{{ $tag->name }}</flux:pillbox.option>
    @endforeach

    <flux:pillbox.option.create wire:click="createTag" min-length="2">
        Create new "<span wire:text="search"></span>"
    </flux:pillbox.option.create>
</flux:pillbox>

<!--
public $search = '';
public $selectedTags = [];

public function createProject(){
    $tag = Tag::create([
        'name' => $this->search,
    ]);

    $this->selectedTags[] = $tag->id;
    $this->search = '';
}
-->
```

```blade
<flux:pillbox wire:model.live="selectedTags" variant="combobox" multiple :filter="false">
    <x-slot name="input">
        <flux:pillbox.input wire:model.live="search" placeholder="Choose tags..." />
    </x-slot>

    @foreach($this->tags as $tag)
        <flux:pillbox.option :value="$tag->id">{{ $tag->name }}</flux:pillbox.option>
    @endforeach

    <flux:pillbox.option.create wire:click="createTag" min-length="2">
        Create "<span wire:text="search"></span>"
    </flux:pillbox.option.create>
</flux:pillbox>

<!--
#[\Livewire\Attributes\Computed]
public function tags() {
    return \App\Models\Tag::query()
        ->where('name', 'like', '%' . trim($this->search) . '%')
        ->limit(20)->get()
        ->when(blank($this->search) && $this->selectedTags, function ($results) {
            return \App\Models\Tag::query()
                ->whereIn('id', $this->selectedTags)
                ->whereNotIn('id', $results->pluck('id'))
                ->get()->merge($results);
        });
}
-->
```

## Loading message

```blade
<flux:pillbox wire:model="selectedTags" variant="combobox" multiple :filter="false">
    ...

    <x-slot name="empty">
        <flux:pillbox.option.empty when-loading="Loading tags...">
            No tags found.
        </flux:pillbox.option.empty>
    </x-slot>
</flux:pillbox>
```

```blade
<flux:pillbox wire:model.live="selectedTags" variant="combobox" multiple placeholder="Choose tags..." :filter="false">
    <x-slot name="input">
        <flux:pillbox.input wire:model.live="search" placeholder="Choose tags..." />
    </x-slot>

    ...

    <flux:pillbox.option.create wire:click="createTag" min-length="2">
        Create "<span wire:text="search"></span>"
    </flux:pillbox.option.create>
</flux:pillbox>

<!--
public function createTag() {
    $this->validate(['search' => 'required|unique:tags,name']);
    // Create logic...
}

public function updatedSearch() {
    $this->resetErrorBag('search');
}
-->
```

```blade
<flux:pillbox wire:model="projectId" variant="combobox" placeholder="Choose project...">
    <flux:pillbox.option.create modal="create-tag">Create new</flux:pillbox.option.create>

    @foreach($this->tags as $tag)
        <flux:pillbox.option :value="$tag->id">{{ $tag->name }}</flux:pillbox.option>
    @endforeach
</flux:pillbox>

<flux:modal name="create-tag" class="md:w-96">
    <form wire:submit="createTag" class="space-y-6">
        <div>
            <flux:heading size="lg">Create new tag</flux:heading>
            <flux:text class="mt-2">Enter the name of the new tag.</flux:text>
        </div>

        <flux:input wire:model="newTagName" label="Name" placeholder="e.g. 'Research'" />

        <div class="flex">
            <flux:spacer />
            <flux:button type="submit" variant="primary">Create</flux:button>
        </div>
    </form>
</flux:modal>
```

## Reference

### `flux:pillbox`

| Prop | Description |
| --- | --- |
| `wire:model` | Binds the pillbox to a Livewire property (array for multiple values). |
| `placeholder` | Text when no pills are selected. |
| `label` | Label text (wraps in `flux:field` + `flux:label`). |
| `description` | Help text between label and pillbox. |
| `size` | Options: `sm`. |
| `searchable` | Adds a search input inside dropdown. |
| `search:placeholder` | Placeholder for search when `searchable`. |
| `filter` | If `false`, disables client-side filtering (for server-side options). |
| `disabled` | Disables interaction. |
| `invalid` | Error styling on border. |

### `flux:pillbox.option`

| Prop | Description |
| --- | --- |
| `value` | Stored value for this option. |
| `label` | Display text for option. |
| `selected-label` | Display text when selected. |
| `disabled` | Disables selection. |
| `filterable` | If `false`, option wonâ€™t be hidden by search filter. |

### `flux:pillbox.option.create`

| Prop | Description |
| --- | --- |
| `min-length` | Minimum characters before showing create option. |
| `modal` | Modal name to open when selected. |
| `wire:click` | Livewire action to call when selected. |

### `flux:pillbox.option.empty`

| Prop | Description |
| --- | --- |
| `when-loading` | Message shown while loading options. |

### `flux:pillbox.search`

| Prop | Description |
| --- | --- |
| `placeholder` | Search input placeholder. Default: `Search...`. |
| `icon` | Icon in search input. Default: magnifying glass. |
| `clearable` | Shows clear button. Default: `true`. |

### `flux:pillbox.trigger`

| Prop | Description |
| --- | --- |
| `placeholder` | Text when no pills are selected. |
| `invalid` | Error styling on trigger. |
| `size` | Options: `sm`. |
| `clearable` | Shows clear-all button in trigger. |
