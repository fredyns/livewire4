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
 * @property SampleItem $item The sample item instance
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

    public SampleItem $item;

    /**
     * @throws AuthorizationException
     */
    public function mount(SampleItem $item): void
    {
        $this->authorize('update', $item);

        $this->item = $item;

        $this->string = $item->string;
        $this->user_id = $item->user_id;
        $this->enumerate = $item->enumerate?->value;
        $this->text = $item->text;
        $this->email = $item->email;
        $this->npwp = $item->npwp;
        $this->color = $item->color;
        $this->integer = $item->integer;
        $this->decimal = $item->decimal;
        $this->datetime = $item->datetime?->format('Y-m-d\\TH:i');
        $this->date = $item->date?->format('Y-m-d');
        $this->time = $item->time?->format('H:i:s');
        $this->ip_address = $item->ip_address;
        $this->boolean = $item->boolean;
        $this->markdown_text = $item->markdown_text;
        $this->wysiwyg = $item->wysiwyg;
        $this->latitude = $item->latitude;
        $this->longitude = $item->longitude;
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

            Log::info('Updating sample item', ['sample_item_id' => $this->item->id, 'updated_by' => Auth::id()]);

            $this->item->fill($data);
            $this->item->save();

            session()->flash('message', 'Sample item updated successfully.');
            Log::info('Sample item updated successfully', ['sample_item_id' => $this->item->id, 'updated_by' => Auth::id()]);

            $this->redirectRoute('sample.item.show', ['item' => $this->item]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation failed on sample item update', ['sample_item_id' => $this->item->id, 'errors' => $e->errors()]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error updating sample item', ['sample_item_id' => $this->item->id, 'error' => $e->getMessage()]);
            session()->flash('error', 'Failed to update sample item. Please try again.');
        }
    }

    public function render(): View
    {
        return $this->view([
            'item' => $this->item,
        ])->layout('layouts.app', ['sidebar' => 'apps'])->title('Edit '.$this->item->string);
    }
};
