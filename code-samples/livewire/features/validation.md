# Validationsource: https://livewire.laravel.com/docs/4.x/validation

Livewire aims to make validating a user's input and giving them feedback as pleasant as possible. By building on top of Laravel's validation features, Livewire leverages your existing knowledge while also providing you with robust, additional features like real-time validation.Here's an example `CreatePost` component that demonstrates the most basic validation workflow in Livewire:



```php
<?phpnamespace App\Livewire;use App\Models\Post;use Livewire\Component;class CreatePost extends Component{    public $title = '';    public $content = '';    public function save()    {        $validated = $this->validate([            'title' => 'required|min:3',            'content' => 'required|min:3',        ]);        Post::create($validated);        return redirect()->to('/posts');    }    public function render()    {        return view('livewire.create-post');    }}

```





```blade
<form wire:submit="save">    <input type="text" wire:model="title">    <div>@error('title') {{ $message }} @enderror</div>    <textarea wire:model="content"></textarea>    <div>@error('content') {{ $message }} @enderror</div>    <button type="submit">Save</button></form>

```



Livewire provides a `validate()` method that you can call to validate your component's properties. It returns the validated set of data that you can then safely insert into the database.On the frontend, you can use Laravel's existing Blade directives to show validation messages to your users.

#

# Validate attributes

If you prefer to co-locate your component's validation rules with the properties directly, you can use Livewire's `#[Validate]` attribute.By associating validation rules with properties using `#[Validate]`, Livewire will automatically run the properties validation rules before each update. However, you should still run `$this->validate()` before persisting data to a database so that properties that haven't been updated are also validated.



```php
use App\Models\Post;use Livewire\Attributes\Validate;use Livewire\Component;class CreatePost extends Component{    #[Validate('required|min:3')]    public $title = '';    #[Validate('required|min:3')]    public $content = '';    public function save()    {        $this->validate();        Post::create([            'title' => $this->title,            'content' => $this->content,        ]);        return redirect()->to('/posts');    }    // ...}

```



PHP Attributes are restricted to certain syntaxes like plain strings and arrays. If you find yourself wanting to use run-time syntaxes like Laravel's Rule objects (`Rule::exists(...)`) you should instead define a `rules()` method in your component.If you prefer more control over when the properties are validated, you can pass a `onUpdate: false` parameter to the `#[Validate]` attribute. This will disable any automatic validation and instead assume you want to manually validate the properties using the `$this->validate()` method.



```php
use App\Models\Post;use Livewire\Attributes\Validate;use Livewire\Component;class CreatePost extends Component{    #[Validate('required|min:3', onUpdate: false)]    public $title = '';    #[Validate('required|min:3', onUpdate: false)]    public $content = '';    public function save()    {        $validated = $this->validate();        Post::create($validated);        return redirect()->to('/posts');    }    // ...}

```



#

#

# Custom attribute name

If you wish to customize the attribute name injected into the validation message, you may do so using the `as:` parameter:



```php
use Livewire\Attributes\Validate;#[Validate('required', as: 'date of birth')]public $dob;

```



When validation fails in the above snippet, Laravel will use "date of birth" instead of "dob" as the name of the field in the validation message.

#

#

# Custom validation message

To bypass Laravel's validation message and replace it with your own, you can use the `message:` parameter in the `#[Validate]` attribute:



```php
use Livewire\Attributes\Validate;#[Validate('required', message: 'Please provide a post title')]public $title;

```



If you wish to add different messages for different rules, you can simply provide multiple `#[Validate]` attributes:



```php
use Livewire\Attributes\Validate;#[Validate('required', message: 'Please provide a post title')]#[Validate('min:3', message: 'This title is too short')]public $title;

```



#

#

# Opting out of localization

By default, Livewire rule messages and attributes are localized using Laravel's translate helper: `trans()`.You can opt-out of localization by passing the `translate: false` parameter to the `#[Validate]` attribute:



```php
#[Validate('required', message: 'Please provide a post title', translate: false)]public $title;

```



#

#

# Custom key

When applying validation rules directly to a property using the `#[Validate]` attribute, Livewire assumes the validation key should be the name of the property itself. However, there are times when you may want to customize the validation key.For example, you might want to provide separate validation rules for an array property and its children:



```php
#[Validate([    'todos' => 'required',    'todos.*' => [        'required',        'min:3',        new Uppercase,    ],])]public $todos = [];

```



#

# Form objects

As more properties and validation rules are added to a Livewire component, it can begin to feel too crowded. To alleviate this pain and also provide a helpful abstraction for code reuse, you can use Livewire's Form Objects to store your properties and validation rules.Below is the same CreatePost example, but now the properties and rules have been extracted to a dedicated form object named `PostForm`:



```php
<?phpnamespace App\Livewire\Forms;use Livewire\Attributes\Validate;use Livewire\Form;class PostForm extends Form{    #[Validate('required|min:3')]    public $title = '';    #[Validate('required|min:3')]    public $content = '';}

```



The `PostForm` above can now be defined as a property on the `CreatePost` component:



```php
<?phpnamespace App\Livewire;use App\Livewire\Forms\PostForm;use App\Models\Post;use Livewire\Component;class CreatePost extends Component{    public PostForm $form;    public function save()    {        Post::create(            $this->form->all()        );        return redirect()->to('/posts');    }    // ...}

```



When referencing the property names in the template, you must prepend `form.` to each instance:



```blade
<form wire:submit="save">    <input type="text" wire:model="form.title">    <div>@error('form.title') {{ $message }} @enderror</div>    <textarea wire:model="form.content"></textarea>    <div>@error('form.content') {{ $message }} @enderror</div>    <button type="submit">Save</button></form>

```



When using form objects, `#[Validate]` attribute validation will be run every time a property is updated. However, if you disable this behavior by specifying `onUpdate: false` on the attribute, you can manually run a form object's validation using `$this->form->validate()`:



```php
public function save(){    Post::create(        $this->form->validate()    );    return redirect()->to('/posts');}

```



#

# Real-time validation

Real-time validation is the term used for when you validate a user's input as they fill out a form rather than waiting for the form submission.By using `#[Validate]` attributes directly on Livewire properties, any time a network request is sent to update a property's value on the server, the provided validation rules will be applied.To provide a real-time validation experience for your users on a specific input, no extra backend work is required. The only thing that is required is using `wire:model.live` or `wire:model.live.blur` to instruct Livewire to trigger network requests as the fields are filled out.Example using `wire:model.live.blur`:



```blade
<form wire:submit="save">    <input type="text" wire:model.live.blur="title">    <!-- ... --></form>

```



If you are using a `rules()` method to declare your validation rules for a property instead of the `#[Validate]` attribute, you can still include a `#[Validate]` attribute with no parameters to retain the real-time validating behavior:



```php
use App\Models\Post;use Livewire\Attributes\Validate;use Livewire\Component;class CreatePost extends Component{    #[Validate]    public $title = '';    public $content = '';    protected function rules()    {        return [            'title' => 'required|min:5',            'content' => 'required|min:5',        ];    }    public function save()    {        $validated = $this->validate();        Post::create($validated);        return redirect()->to('/posts');    }}

```



#

# Customizing error messages

Laravel provides sensible validation messages like "The title field is required." out-of-the-box.Sometimes the property you are validating has a name that isn't suited for displaying to users. Livewire allows you to specify an alternative name for a property using the `as:` parameter:



```php
use Livewire\Attributes\Validate;#[Validate('required', as: 'date of birth')]public $dob = '';

```



If customizing the property name isn't enough, you can customize the entire validation message using the `message:` parameter:



```php
use Livewire\Attributes\Validate;#[Validate('required', message: 'Please fill out your date of birth.')]public $dob = '';

```



If you have multiple rules to customize the message for, it is recommended that you use entirely separate `#[Validate]` attributes:



```php
use Livewire\Attributes\Validate;#[Validate('required', message: 'Please enter a title.')]#[Validate('min:5', message: 'Your title is too short.')]public $title = '';

```



If you want to use the `#[Validate]` attribute's array syntax instead, you can specify custom attributes and messages:



```php
use Livewire\Attributes\Validate;#[Validate(    [        'titles' => 'required',        'titles.*' => 'required|min:5',    ],    message: [        'required' => 'The :attribute is missing.',        'titles.required' => 'The :attribute are missing.',        'min' => 'The :attribute is too short.',    ],    attribute: [        'titles.*' => 'title',    ],)]public $titles = [];

```



#

# Defining a rules() method

As an alternative to Livewire's `#[Validate]` attributes, you can define a method in your component called `rules()` and return a list of fields and corresponding validation rules.This can be helpful if you are trying to use run-time syntaxes that aren't supported in PHP Attributes, for example, Laravel rule objects like `Rule::password()`.These rules will then be applied when you run `$this->validate()` inside the component. You also can define the `messages()` and `validationAttributes()` functions.Example:



```php
use App\Models\Post;use Illuminate\Validation\Rule;use Livewire\Component;class CreatePost extends Component{    public $title = '';    public $content = '';    protected function rules()    {        return [            'title' => Rule::exists('posts', 'title'),            'content' => 'required|min:3',        ];    }    protected function messages()    {        return [            'content.required' => 'The :attribute are missing.',            'content.min' => 'The :attribute is too short.',        ];    }    protected function validationAttributes()    {        return [            'content' => 'description',        ];    }    public function save()    {        $this->validate();        Post::create([            'title' => $this->title,            'content' => $this->content,        ]);        return redirect()->to('/posts');    }    // ...}

```



When defining rules via the `rules()` method, Livewire will only use these validation rules to validate properties when you run `$this->validate()`.This is different than standard `#[Validate]` attributes which are applied every time a field is updated via something like `wire:model`.To apply these validation rules to a property every time it's updated, you can still use `#[Validate]` with no extra parameters.While using Livewire's validation utilities, your component should not have properties or methods named `rules`, `messages`, `validationAttributes` or `validationCustomValues`, unless you're customizing the validation process.

#

# Using Laravel Rule objects

Laravel Rule objects are an extremely powerful way to add advanced validation behavior to your forms.Here is an example of using Rule objects in conjunction with Livewire's `rules()` method to achieve more sophisticated validation:



```php
<?phpnamespace App\Livewire;use App\Models\Post;use Illuminate\Validation\Rule;use Livewire\Form;class UpdatePost extends Form{    public ?Post $post;    public $title = '';    public $content = '';    protected function rules()    {        return [            'title' => [                'required',                Rule::unique('posts')->ignore($this->post),            ],            'content' => 'required|min:5',        ];    }    public function mount()    {        $this->title = $this->post->title;        $this->content = $this->post->content;    }    public function update()    {        $this->validate();        $this->post->update($this->all());        $this->reset();    }    // ...}

```



#

# Manually controlling validation errors

Sometimes you may want full control over the validation messages in your component.Available methods:
- `$this->addError([key], [message])`- `$this->resetValidation([?key])`- `$this->getErrorBag()`When manually adding errors using `$this->addError()` inside of a form object the key will automatically be prefixed with the name of the property the form is assigned to in the parent component. For example, if in your Component you assign the form to a property called `$data`, the key will become `data.key`.

#

# Accessing the validator instance

Sometimes you may want to access the Validator instance that Livewire uses internally in the `validate()` method.This is possible using the `withValidator` method.Example intercepting Livewire's internal validator:



```php
use App\Models\Post;use Livewire\Attributes\Validate;use Livewire\Component;class CreatePost extends Component{    #[Validate('required|min:3')]    public $title = '';    #[Validate('required|min:3')]    public $content = '';    public function boot()    {        $this->withValidator(function ($validator) {            $validator->after(function ($validator) {                if (str($this->title)->startsWith('"')) {                    $validator->errors()->add('title', 'Titles cannot start with quotations');                }            });        });    }    public function save()    {        Post::create($this->all());        return redirect()->to('/posts');    }    // ...}

```



#

# Using custom validators

If you wish to use your own validation system in Livewire, that isn't a problem. Livewire will catch any `ValidationException` exceptions thrown inside of components and provide the errors to the view just as if you were using Livewire's own `validate()` method.Example using a custom validator:



```php
use App\Models\Post;use Illuminate\Support\Facades\Validator;use Livewire\Component;class CreatePost extends Component{    public $title = '';    public $content = '';    public function save()    {        $validated = Validator::make(            // Data to validate...            ['title' => $this->title, 'content' => $this->content],            // Validation rules to apply...            ['title' => 'required|min:3', 'content' => 'required|min:3'],            // Custom validation messages...            ['required' => 'The :attribute field is required'],        )->validate();        Post::create($validated);        return redirect()->to('/posts');    }    // ...}

```



#

# Testing validation

Livewire provides useful testing utilities for validation scenarios, such as the `assertHasErrors()` method.Example:



```php
<?phpnamespace Tests\Feature\Livewire;use App\Livewire\CreatePost;use Livewire\Livewire;use Tests\TestCase;class CreatePostTest extends TestCase{    public function test_cant_create_post_without_title()    {        Livewire::test(CreatePost::class)            ->set('content', 'Sample content...')            ->call('save')            ->assertHasErrors('title');    }}

```



You can narrow down assertions to specific rules:



```php
public function test_cant_create_post_with_title_shorter_than_3_characters(){    Livewire::test(CreatePost::class)        ->set('title', 'Sa')        ->set('content', 'Sample content...')        ->call('save')        ->assertHasErrors(['title' => ['min:3']]);}

```



Assert multiple properties at the same time:



```php
public function test_cant_create_post_without_title_and_content(){    Livewire::test(CreatePost::class)        ->call('save')        ->assertHasErrors(['title', 'content']);}

```



For more information on other testing utilities, see the [testing documentation](../essentials/testing.md).

#

# Accessing errors in Java

ScriptLivewire provides a `$errors` magic property for client-side access to validation errors:



```blade
<form wire:submit="save">    <input type="email" wire:model="email">    <div wire:show="$errors.has('email')">        <span wire:text="$errors.first('email')"></span>    </div>    <button type="submit">Save</button></form>

```



Available methods:- `$errors.has('field')`
- Check if a field has errors- `$errors.first('field')`
- Get the first error message for a field- `$errors.get('field')`
- Get all error messages for a field- `$errors.all()`
- Get all errors for all fields- `$errors.clear()`
- Clear all errors- `$errors.clear('field')`
- Clear errors for a specific fieldWhen using Alpine.js, access `$errors` through `$wire.$errors`.

#

# Deprecated [#Rule] attribute

When Livewire v3 first launched, it used the term "Rule" instead of "Validate" for its validation attributes (`#[Rule]`).Because of naming conflicts with Laravel rule objects, this has since been changed to `#[Validate]`. Both are supported in Livewire v3, however it is recommended that you change all occurrences of `#[Rule]` with `#[Validate]` to stay current.

#

# See also
- [Forms](../essentials/forms.md) Ã¢â‚¬â€ Validate form inputs with real-time feedback- [Properties](../essentials/properties.md) Ã¢â‚¬â€ Validate property values before persisting- [Validate Attribute](../php-attributes/validate.md) Ã¢â‚¬â€ Use #[Validate] for property validation- [Actions](../essentials/actions.md) Ã¢â‚¬â€ Validate data in action methods
