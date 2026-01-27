# File upload - PRO

Source: https://fluxui.dev/components/file-upload

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:file-upload</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:model</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"photos"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> multiple</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> label</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Upload files"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:file-upload.dropzone</span></span><span class="line"><span style="color:#D050A3;--shiki-dark:#75FFC7">        heading</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Drop files here or click to browse"</span></span><span class="line"><span style="color:#D050A3;--shiki-dark:#75FFC7">        text</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"JPG, PNG, GIF up to 10MB"</span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:file-upload</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">div</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> class</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"mt-4 flex flex-col gap-2"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:file-item</span></span><span class="line"><span style="color:#D050A3;--shiki-dark:#75FFC7">        heading</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"Profile_pic.jpg"</span></span><span class="line"><span style="color:#D050A3;--shiki-dark:#75FFC7">        image</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"https://fluxui.dev/img/demo/user.png"</span></span><span class="line"><span style="color:#D050A3;--shiki-dark:#75FFC7">        size</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"162400"</span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    ></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">x-slot</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> name</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"actions"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">            <</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:file-item.remove</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">        </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">x-slot</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF">    </</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:file-item</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span><span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"></</span><span style="color:#157FD2;--shiki-dark:#81E6FF">div</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF">></span></span>
```


## Inline layout

```blade
<flux:file-upload wire:model="photos" multiple label="Upload files">
    <flux:file-upload.dropzone
        heading="Drop files or click to browse"
        text="JPG, PNG, GIF up to 10MB"
        inline
    />
</flux:file-upload>

<div class="mt-3 flex flex-col gap-2">
    <flux:file-item heading="Profile_pic.jpg">
        <x-slot name="actions">
            <flux:file-item.remove />
        </x-slot>
    </flux:file-item>

    <flux:file-item heading="Brand_banner.jpg">
        <x-slot name="actions">
            <flux:file-item.remove />
        </x-slot>
    </flux:file-item>
</div>
```

## Progress indicator

```blade
<flux:file-upload wire:model="photos" multiple label="Upload files">
    <flux:file-upload.dropzone
        heading="Drop files or click to browse"
        text="JPG, PNG, GIF up to 10MB"
        with-progress
        inline
    />
</flux:file-upload>
```

## Disabled state

```blade
<flux:file-upload wire:model="photos" multiple label="Upload files" disabled>
    <flux:file-upload.dropzone
        heading="Drop files or click to browse"
        text="JPG, PNG, GIF up to 10MB"
        inline
    />
</flux:file-upload>
```

## Custom uploader

```blade
<flux:file-upload wire:model="photo">
    <!-- Custom avatar uploader -->
    <div
        class="
            relative flex items-center justify-center size-20 rounded-full transition-colors cursor-pointer
            border border-zinc-200 dark:border-white/10 hover:border-zinc-300 dark:hover:border-white/10
            bg-zinc-100 hover:bg-zinc-200 dark:bg-white/10 hover:dark:bg-white/15 in-data-dragging:dark:bg-white/15
        "
    >
        @if ($photo)
            <img src="{{ $photo?->temporaryUrl() }}" class="size-full object-cover rounded-full" />
        @else
            <flux:icon name="user" variant="solid" class="text-zinc-500 dark:text-zinc-400" />
        @endif

        <div class="absolute bottom-0 right-0 bg-white dark:bg-zinc-800 rounded-full">
            <flux:icon name="arrow-up-circle" variant="solid" class="text-zinc-500 dark:text-zinc-400" />
        </div>
    </div>
</flux:file-upload>
```

## Livewire integration

```blade
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class FileUpload extends Component
{
    use WithFileUploads;

    #[Validate('image|max:10240')] // 10MB Max
    public $photo;

    public function removePhoto()
    {
        $this->photo->delete();
        $this->photo = null;
    }

    public function save()
    {
        $this->photo->store(path: 'photos');

        return $this->redirect('...');
    }
}
```

```blade
<!-- Blade view: -->
<form wire:submit="save">
    <flux:file-upload wire:model="photo" label="Upload file">
        <flux:file-upload.dropzone heading="Drop file here or click to browse" text="JPG, PNG, GIF up to 10MB" />
    </flux:file-upload>

    <div class="mt-3 flex flex-col gap-2">
        @if ($photo)
            <flux:file-item
                :heading="$photo->getClientOriginalName()"
                :image="$photo->temporaryUrl()"
                :size="$photo->getSize()"
            >
                <x-slot name="actions">
                    <flux:file-item.remove wire:click="removePhoto" aria-label="{{ 'Remove file: ' . $photo->getClientOriginalName() }}" />
                </x-slot>
            </flux:file-item>
        @endif
    </div>

    <flux:button type="submit">Save</flux:button>
</form>
```

```blade
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class FileUpload extends Component
{
    use WithFileUploads;

    #[Validate(['photos.*' => 'image|max:1024'])]
    public $photos = [];

    public function removePhoto($index)
    {
        $photo = $this->photos[$index];
        $photo->delete();

        unset($this->photos[$index]);
        $this->photos = array_values($this->photos);
    }

    public function save()
    {
        foreach ($this->photos as $photo) {
            $photo->store(path: 'photos');
        }

        return $this->redirect('...');
    }
}
```

```blade
<!-- Blade view: -->
<form wire:submit="save">
    <flux:file-upload wire:model="photos" label="Upload files" multiple>
        <flux:file-upload.dropzone heading="Drop files here or click to browse" text="JPG, PNG, GIF up to 10MB" />
    </flux:file-upload>

    <div class="mt-3 flex flex-col gap-2">
        @foreach ($photos as $index => $photo)
            <flux:file-item
                :heading="$photo->getClientOriginalName()"
                :image="$photo->temporaryUrl()"
                :size="$photo->getSize()"
            >
                <x-slot name="actions">
                    <flux:file-item.remove
                        wire:click="removePhoto({{ $index }})"
                        aria-label="{{ 'Remove file: ' . $photo->getClientOriginalName() }}"
                    />
                </x-slot>
            </flux:file-item>
        @endforeach
    </div>

    <flux:button type="submit">Save</flux:button>
</form>
```

## Reference

### `flux:file-upload`

| Prop | Description |
| --- | --- |
| `name` | The input name attribute for form submissions. |
| `multiple` | Allows selecting/uploading multiple files. Default: `false`. |
| `label` | Field label text displayed above the upload area. |
| `description` | Helper text displayed below the field. |
| `error` | Error message for validation failures. |
| `disabled` | Disables interaction. Default: `false`. |

### `flux:file-upload.dropzone`

| Prop | Description |
| --- | --- |
| `heading` | Main text displayed in the dropzone. |
| `text` | Supporting text below heading (restrictions, etc.). |
| `icon` | Icon name. Default: `cloud-arrow-up`. |
| `inline` | Compact horizontal layout. Default: `false`. |
| `with-progress` | Shows progress bar during uploads (requires `text`). Default: `false`. |

### `flux:file-item`

| Prop | Description |
| --- | --- |
| `heading` | File name/title. |
| `text` | Additional text (auto-calculated from size if omitted). |
| `image` | URL/path to preview image. |
| `size` | File size in bytes (auto-formatted). |
| `icon` | Icon when no image is provided. Default: `document`. |
| `invalid` | Error state. Default: `false`. |

### `flux:file-item.remove`

| Livewire directive | Description |
| --- | --- |
| `wire:click` | Triggers a Livewire method to remove the file. |
| `aria-label` | aria-label for the remove button. |
