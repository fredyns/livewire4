<?php

use App\Livewire\Forms\Sample\ItemForm;
use App\Models\Sample\SampleItem;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

/**
 * @property string $search
 * @property SampleItem[]|LengthAwarePaginator $items
 */
new class extends Component
{
    use WithPagination;
    use WithFileUploads;

    // properties for index

    public string $search = '';

    public array $columns = [
        'string' => true,
        'email' => true,
        'user_id' => true,
        'color' => true,
        'ip_address' => false,
        'integer' => false,
        'decimal' => false,
        'npwp' => false,
        'datetime' => false,
        'date' => false,
        'time' => false,
        'boolean' => false,
        'enumerate' => false,
        'file' => false, // show as a link
        'image' => false, // show as a preview button
        'created_at' => true,
    ];

    public string $sortField = 'created_at';

    public string $sortDirection = 'desc';

    public array $columnLabels = [
        'string' => 'String',
        'email' => 'Email',
        'user_id' => 'User',
        'color' => 'Color',
        'ip_address' => 'IP Address',
        'integer' => 'Integer',
        'decimal' => 'Decimal',
        'npwp' => 'NPWP',
        'datetime' => 'Datetime',
        'date' => 'Date',
        'time' => 'Time',
        'boolean' => 'Boolean',
        'enumerate' => 'Enumerate',
        'file' => 'File',
        'image' => 'Image',
        'created_at' => 'Created',
    ];

    // properties for model
    public ?SampleItem $model = null;

    public ItemForm $form;

    public ?int $modelId = null;

    public bool $editing = false;

    public bool $showingModalView = false;

    public bool $showingModalForm = false;

    public string $modalWidth = '3xl';

    // component methods

    /**
     * @throws AuthorizationException
     */
    public function mount(): void
    {
        $this->authorize('viewAny', SampleItem::class);
        $this->resetForm();
    }

    public function resetForm(): void
    {
        $this->form->reset();
        $this->form->model = null;
    }

    public function resetModel(): void
    {
        $this->model = null;
        $this->modelId = null;
        $this->resetForm();

        // $this->dispatch('refresh');
    }

    // index methods

    public function resetSearch(): void
    {
        $this->search = '';
        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedColumns(mixed $value, string $key): void
    {
        $selectedCount = count(array_filter($this->columns));

        if ($selectedCount < 1) {
            $this->columns[$key] = true;
            session()->flash('error', 'Select at least one column.');
        }

        if (! array_key_exists($this->sortField, $this->columns) || ! ($this->columns[$this->sortField] ?? false)) {
            if (! in_array($this->sortField, ['id', 'created_at'], true)) {
                $this->sortField = 'created_at';
                $this->sortDirection = 'desc';
            }
        }

        $this->resetPage();
    }

    #[Computed]
    public function selectedColumnKeys(): array
    {
        return array_keys(array_filter($this->columns));
    }

    public function updateSort(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    #[Computed]
    public function normalizedSearch(): string
    {
        if (! $this->search || $this->search === 'null' || strlen($this->search) < 3) {
            return '';
        }

        return $this->search;
    }

    /**
     * @return SampleItem[]|LengthAwarePaginator
     */
    #[Computed]
    public function items(): array|LengthAwarePaginator
    {
        $select = ['id', 'created_at'];

        foreach ($this->selectedColumnKeys() as $key) {
            if (! in_array($key, $select, true)) {
                $select[] = $key;
            }
        }

        $withUser = in_array('user_id', $select, true);

        $query = SampleItem::query()->select($select);

        if ($withUser) {
            $query->with('user');
        }

        if ($this->normalizedSearch()) {
            $query = SampleItem::search($this->normalizedSearch())->select($select);

            if ($withUser) {
                $query->with('user');
            }
        }

        $query->orderBy($this->sortField, $this->sortDirection);

        return $query->paginate(10)->withQueryString();
    }

    /**
     * @throws AuthorizationException
     */
    public function delete(SampleItem $item): void
    {
        try {
            $this->authorize('delete', $item);

            Log::info('Deleting sample item', ['sample_item_id' => $item->id, 'deleted_by' => auth()->id()]);

            $item->deleteUploadedFiles();
            $item->delete();

            session()->flash('message', 'Sample item deleted successfully.');
            Log::info('Sample item deleted successfully', ['sample_item_id' => $item->id]);
        } catch (AuthorizationException $e) {
            Log::warning('Unauthorized delete attempt', ['sample_item_id' => $item->id, 'deleted_by' => auth()->id()]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error deleting sample item', ['sample_item_id' => $item->id, 'error' => $e->getMessage()]);
            session()->flash('error', 'Failed to delete sample item.');
        }
    }

    public function render(): View
    {
        return $this->view(['items' => $this->items])
            ->layout('layouts.app', ['sidebar' => 'sample'])
            ->title('Sample Items');
    }

    // details methods

    public function viewModel(SampleItem $model): void
    {
        // todo: check authorization
        $this->editing = false;
        $this->model = $model;

        // $this->dispatch('refresh');
        $this->showModalView();
    }

    public function showModalView(): void
    {
        $this->resetErrorBag();
        $this->editing = false;
        $this->showingModalView = true;
        $this->showingModalForm = false;
    }

    public function setModalWidth(string $width): void
    {
        $allowed = ['3xl', '5xl', '7xl', 'max'];

        if (! in_array($width, $allowed, true)) {
            $width = '3xl';
        }

        $this->modalWidth = $width;
    }

    #[Computed]
    public function modalDialogClass(): string
    {
        return match ($this->modalWidth) {
            '3xl' => '[:where(&)]:max-w-3xl',
            '5xl' => '[:where(&)]:max-w-5xl',
            '7xl' => '[:where(&)]:max-w-7xl',
            'max' => '[:where(&)]:max-w-[calc(100vw-2rem)]',
            default => '[:where(&)]:max-w-3xl',
        };
    }

    public function createModel(): void
    {
        // todo: check authorization
        $this->editing = false;
        $this->resetModel();
        $this->showModalForm();
    }

    public function showModalForm(): void
    {
        $this->resetErrorBag();
        $this->showingModalView = false;
        $this->showingModalForm = true;
    }

    public function save(): void
    {
        if (! $this->modelId) {
            $this->authorize('create', SampleItem::class);

            $model = $this->form->store();
        } else {
            $model = SampleItem::query()->findOrFail($this->modelId);
            $this->authorize('update', $model);

            $this->form->setModel($model);
            $model = $this->form->update();
        }

        $this->resetModel();
        $this->hideModal();
    }

    public function hideModal(): void
    {
        $this->showingModalView = false;
        $this->showingModalForm = false;
    }

    public function removeImage(): void
    {
        $this->form->image = null;
    }

    public function removeFile(): void
    {
        $this->form->file = null;
    }

    public function editModel(SampleItem $model): void
    {
        $this->editing = true;
        $this->model = $model;
        $this->modelId = $model->id;
        $this->form->setModel($model);

        // $this->dispatch('refresh');
        $this->showModalForm();
    }

};
