# File Uploads

source: https://livewire.laravel.com/docs/4.x/uploadsLivewire offers powerful support for uploading files within your components.First, add the `WithFileUploads` trait to your component. Once this trait has been added to your component, you can use `wire:model` on file inputs as if they were any other input type and Livewire will take care of the rest.Here's an example of a simple component that handles uploading a photo:

```

php<?php// resources/views/components/⚡upload-photo.blade.phpuse Livewire\Attributes\Validate;use Livewire\Component;use Livewire\WithFileUploads;new class extends Component{    use WithFileUploads;    #[Validate('image|max:1024')] // 1MB Max    public $photo;    public function save()    {        $this->photo->store(path: 'photos');    }};

```

```

blade<form wire:submit="save">    <input type="file" wire:model="photo">    @error('photo')        <span class="error">{{ $message }}</span>    @enderror    <button type="submit">Save photo</button></form>

```

The term `upload` is reserved by Livewire. You cannot use it as a method or property name in your component.Under the hood, when a user selects a file:1. Livewire’s JavaScript requests a temporary signed upload URL.2. JavaScript uploads the file to that URL, storing it temporarily and returning a unique hash ID.3. JavaScript makes a final request telling the server to set the component property to the temporary file.4. The public property (in this case, `$photo`) is now set to a temporary upload and is ready to be stored or validated.

#

# Storing uploaded filesThe previous example demonstrates the most basic storage scenario: moving the temporarily uploaded file to the `photos` directory on the application's default filesystem disk.You can access the original file name of a temporary upload by calling its `->getClientOriginalName()` method.Livewire honors the same APIs Laravel uses for storing uploaded files.Common scenarios:

```

phppublic function save(){    // Store the file in the "photos" directory of the default filesystem disk    $this->photo->store(path: 'photos');    // Store the file in the "photos" directory in a configured "s3" disk    $this->photo->store(path: 'photos', options: 's3');    // Store the file in the "photos" directory with the filename "avatar.png"    $this->photo->storeAs(path: 'photos', name: 'avatar');    // Store the file in the "photos" directory in a configured "s3" disk with the filename "avatar.png"    $this->photo->storeAs(path: 'photos', name: 'avatar', options: 's3');    // Store the file in the "photos" directory, with "public" visibility in a configured "s3" disk    $this->photo->storePublicly(path: 'photos', options: 's3');    // Store the file in the "photos" directory, with the name "avatar.png", with "public" visibility in a configured "s3" disk    $this->photo->storePubliclyAs(path: 'photos', name: 'avatar', options: 's3');}

```

#

# Handling multiple filesLivewire automatically handles multiple file uploads by detecting the `multiple` attribute on the `<input>` tag.Example using an array property named `$photos`:

```

php<?php// resources/views/components/⚡upload-photos.blade.phpuse Livewire\Attributes\Validate;use Livewire\Component;use Livewire\WithFileUploads;new class extends Component{    use WithFileUploads;    #[Validate(['photos.*' => 'image|max:1024'])]    public $photos = [];    public function save()    {        foreach ($this->photos as $photo) {            $photo->store(path: 'photos');        }    }};

```

```

blade<form wire:submit="save">    <input type="file" wire:model="photos" multiple>    @error('photos.*')        <span class="error">{{ $message }}</span>    @enderror    <button type="submit">Save photo</button></form>

```

#

# File validationValidating file uploads with Livewire is the same as handling file uploads from a standard Laravel controller.Many validation rules relating to files require access to the file. When uploading directly to S3, these validation rules will fail if the S3 file object is not publicly accessible.For more information on file validation, consult Laravel's file validation documentation.

#

# Temporary preview URLsAfter a user chooses a file, you should typically show them a preview of that file before they submit the form and store the file.Livewire makes this trivial by using the `->temporaryUrl()` method on uploaded files.For security reasons, temporary preview URLs are only supported on files with image MIME types.Example:

```

php<?php// resources/views/components/⚡upload-photo.blade.phpuse Livewire\Attributes\Validate;use Livewire\Component;use Livewire\WithFileUploads;new class extends Component{    use WithFileUploads;    #[Validate('image|max:1024')]    public $photo;    // ...};

```

```

blade<form wire:submit="save">    @if ($photo)        <img src="{{ $photo->temporaryUrl() }}">    @endif    <input type="file" wire:model="photo">    @error('photo')        <span class="error">{{ $message }}</span>    @enderror    <button type="submit">Save photo</button></form>

```

#

# Testing file uploadsYou can use Laravel's existing file upload testing helpers to test file uploads.Example:

```

php<?phpnamespace Tests\Feature\Livewire;use App\Livewire\UploadPhoto;use Illuminate\Http\UploadedFile;use Illuminate\Support\Facades\Storage;use Livewire\Livewire;use Tests\TestCase;class UploadPhotoTest extends TestCase{    public function test_can_upload_photo()    {        Storage::fake('avatars');        $file = UploadedFile::fake()->image('avatar.png');        Livewire::test(UploadPhoto::class)            ->set('photo', $file)            ->call('upload', 'uploaded-avatar.png');        Storage::disk('avatars')->assertExists('uploaded-avatar.png');    }}

```

Example component that matches the test:

```

php<?php// resources/views/components/⚡upload-photo.blade.phpuse Livewire\Component;use Livewire\WithFileUploads;new class extends Component{    use WithFileUploads;    public $photo;    public function upload($name)    {        $this->photo->storeAs('/', $name, disk: 'avatars');    }    // ...};

```

For more information on testing file uploads, consult Laravel's file upload testing documentation.

#

# Uploading directly to Amazon S3Livewire stores all file uploads in a temporary directory until you permanently store the file.By default, Livewire uses the default filesystem disk configuration (usually local) and stores the files within a `livewire-tmp/` directory.If you want to bypass your application server and instead store Livewire's temporary uploads in an S3 bucket, set the `LIVEWIRE_TEMPORARY_FILE_UPLOAD_DISK` environment variable in your `.env` file to `s3` (or another custom disk that uses the `s3` driver):

```

textLIVEWIRE_TEMPORARY_FILE_UPLOAD_DISK=s3

```

Now, when a user uploads a file, the file will never actually be stored on your server. Instead, it will be uploaded directly to your S3 bucket within the `livewire-tmp/` sub-directory.Alternatively, you can publish Livewire's configuration file with `php artisan livewire:config` for full control over the `temporary_file_upload` config.

#

#

# Configuring automatic file cleanupLivewire's temporary upload directory will fill up with files quickly; therefore, it's essential to configure S3 to clean up files older than 24 hours.Run:

```

bashphp artisan livewire:configure-s3-upload-cleanup

```

Now, any temporary files older than 24 hours will be cleaned up by S3 automatically.If you are not using S3 for file storage, Livewire will handle file cleanup automatically and there is no need to run the command above.

#

# Loading indicatorsAlthough `wire:model` for file uploads works differently than other `wire:model` input types under the hood, the interface for showing loading indicators remains the same.You can display a loading indicator scoped to the file upload using `wire:loading`:

```

blade<input type="file" wire:model="photo"><div wire:loading wire:target="photo">Uploading...</div>

```

Or using Livewire's automatic `data-loading` attribute:

```

blade<div>    <input type="file" wire:model="photo">    <div class="not-data-loading:hidden">Uploading...</div></div>

```

#

# Progress indicatorsEvery Livewire file upload operation dispatches JavaScript events on the corresponding `<input>` element:- `livewire-upload-start`- `livewire-upload-finish`- `livewire-upload-cancel`- `livewire-upload-error`- `livewire-upload-progress`Example using Alpine to display a progress bar:

```

blade<form wire:submit="save">    <div        x-data="{ uploading: false, progress: 0 }"        x-on:livewire-upload-start="uploading = true"        x-on:livewire-upload-finish="uploading = false"        x-on:livewire-upload-cancel="uploading = false"        x-on:livewire-upload-error="uploading = false"        x-on:livewire-upload-progress="progress = $event.detail.progress"    >        <!-- File Input -->        <input type="file" wire:model="photo">        <!-- Progress Bar -->        <div x-show="uploading">            <progress max="100" x-bind:value="progress"></progress>        </div>    </div>    <!-- ... --></form>

```

#

# Cancelling an uploadIf an upload is taking a long time, a user may want to cancel it.You can provide this functionality with Livewire's `$cancelUpload()` function.Example using `wire:click`:

```

blade<form wire:submit="save">    <!-- File Input -->    <input type="file" wire:model="photo">    <!-- Cancel upload button -->    <button type="button" wire:click="$cancelUpload('photo')">Cancel Upload</button>    <!-- ... --></form>

```

Or from Alpine:

```

blade<button type="button" x-on:click="$wire.cancelUpload('photo')">Cancel Upload</button>

```

#

# JavaScript upload APIIntegrating with third-party file-uploading libraries often requires more control than a simple `<input type="file" wire:model="...">` element.Livewire exposes dedicated JavaScript functions on the component object, accessible using `$wire`.

```

jslet file = $wire.el.querySelector('input[type="file"]').files[0]// Upload a file...$wire.upload('photo', file, (uploadedFilename) => {    // Success callback...}, () => {    // Error callback...}, (event) => {    // Progress callback...    // event.detail.progress contains a number between 1 and 100 as the upload progresses}, () => {    // Cancelled callback...})// Upload multiple files...$wire.uploadMultiple('photos', [file], successCallback, errorCallback, progressCallback, cancelledCallback)// Remove single file from multiple uploaded files...$wire.removeUpload('photos', uploadedFilename, successCallback)// Cancel an upload...$wire.cancelUpload('photos')

```

#

# ConfigurationBecause Livewire stores all file uploads temporarily before you validate or store them, it assumes some default handling behavior for all file uploads.

#

#

# Global validationBy default, Livewire will validate all temporary file uploads with the following rules: `file|max:12288`.If you wish to customize these rules, you can do so inside your application's `config/livewire.php` file:

```

php'temporary_file_upload' => [    // ...    'rules' => 'file|mimes:png,jpg,pdf|max:102400', // (100MB max, and only accept PNGs, JPEGs, and PDFs)],

```

#

#

# Global middlewareThe temporary file upload endpoint is assigned a throttling middleware by default. You can customize exactly what middleware this endpoint uses:

```

php'temporary_file_upload' => [    // ...    'middleware' => 'throttle:5,1', // Only allow 5 uploads per user per minute],

```

#

#

# Temporary upload directoryTemporary files are uploaded to the specified disk's `livewire-tmp/` directory. You can customize this directory:

```

php'temporary_file_upload' => [    // ...    'directory' => 'tmp',],

```

#

# See also- [Forms](../essentials/forms.md) — Handle file uploads in forms- [Validation](validation.md) — Validate uploaded files- [Loading States](loading-states.md) — Show upload progress indicators- [wire:model](../html-directives/wire-model.md) — Bind file inputs to properties
