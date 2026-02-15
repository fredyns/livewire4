<?php

use App\Enums\Sample\SampleItemEnumerate;
use App\Models\Sample\SampleItem;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

/**
 * @property string $string
 * @property string|null $user_id
 * @property string|null $enumerate
 * @property string|null $text
 * @property string|null $email
 * @property string|null $npwp
 * @property string|null $color
 * @property int|null $integer
 * @property float|null $decimal
 * @property string|null $datetime
 * @property string|null $date
 * @property string|null $time
 * @property string|null $ip_address
 * @property bool|null $boolean
 * @property string|null $markdown_text
 * @property string|null $wysiwyg
 * @property float|null $latitude
 * @property float|null $longitude
 */
new class extends Component
{
    #[Validate('required|string|min:3|max:255')]
    public string $string = '';

    #[Validate('nullable|uuid|exists:users,id')]
    public ?string $user_id = null;

    #[Validate('nullable|in:enabled,disabled')]
    public ?string $enumerate = null;

    #[Validate('nullable|string')]
    public ?string $text = null;

    #[Validate('nullable|email|max:255')]
    public ?string $email = null;

    #[Validate('nullable|string|max:20')]
    public ?string $npwp = null;

    #[Validate('nullable|string|max:20')]
    public ?string $color = null;

    #[Validate('nullable|integer')]
    public ?int $integer = null;

    #[Validate('nullable|numeric')]
    public $decimal = null;

    #[Validate('nullable|date')]
    public ?string $datetime = null;

    #[Validate('nullable|date')]
    public ?string $date = null;

    #[Validate('nullable|date_format:H:i:s')]
    public ?string $time = null;

    #[Validate('nullable|ip')]
    public ?string $ip_address = null;

    #[Validate('nullable|boolean')]
    public ?bool $boolean = null;

    #[Validate('nullable|string')]
    public ?string $markdown_text = null;

    #[Validate('nullable|string')]
    public ?string $wysiwyg = null;

    #[Validate('nullable|numeric')]
    public $latitude = null;

    #[Validate('nullable|numeric')]
    public $longitude = null;

    /**
     * @throws AuthorizationException
     */
    public function mount(): void
    {
        $this->authorize('create', SampleItem::class);
    }

    #[Computed]
    public function users()
    {
        return User::query()->orderBy('name')->get(['id', 'name']);
    }

    #[Computed]
    public function enumerates()
    {
        return SampleItemEnumerate::cases();
    }

    public function save(): void
    {
        try {
            $data = $this->validate();

            Log::info('Creating new sample item', ['created_by' => Auth::id()]);

            $item = SampleItem::create($data);

            session()->flash('message', 'Sample item created successfully.');
            Log::info('Sample item created successfully', ['sample_item_id' => $item->id, 'created_by' => Auth::id()]);

            $this->redirectRoute('sample.item.show', ['item' => $item]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation failed on sample item creation', ['errors' => $e->errors()]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error creating sample item', ['error' => $e->getMessage(), 'created_by' => Auth::id()]);
            session()->flash('error', 'Failed to create sample item. Please try again.');
        }
    }

    public function render(): View
    {
        return $this->view()->layout('layouts.app', ['sidebar' => 'apps'])->title('Create Sample Item');
    }
};
