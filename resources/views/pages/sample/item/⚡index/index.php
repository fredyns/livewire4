<?php

namespace App\Livewire\Pages\Sample\Item;

use App\Models\Sample\SampleItem;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * @property string $search
 * @property SampleItem[]|LengthAwarePaginator $items
 */
new class extends Component
{
    use WithPagination;

    public string $search = '';
    public string $sortField = 'created_at';
    public string $sortDirection = 'desc';

    /**
     * @throws AuthorizationException
     */
    public function mount(): void
    {
        $this->authorize('viewAny', SampleItem::class);
    }

    public function resetSearch(): void
    {
        $this->search = '';
        $this->resetPage();
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
        $query = SampleItem::query()->with('user');

        if ($this->normalizedSearch()) {
            $query = SampleItem::search($this->normalizedSearch())->with('user');
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
            ->layout('layouts.app', ['sidebar' => 'apps'])
            ->title('Sample Items');
    }
};
