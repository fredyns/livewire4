<?php

use App\Models\Sample\SampleItem;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Component;

/**
 * @property SampleItem $item The sample item instance
 */
new class extends Component {
    public SampleItem $item;

    /**
     * @throws AuthorizationException
     */
    public function mount(SampleItem $item): void
    {
        $this->authorize('view', $item);

        $this->item = $item->load('user');

        Log::info('Viewing sample item detail', ['sample_item_id' => $item->id, 'viewed_by' => auth()->id()]);
    }

    public function render(): View
    {
        return $this->view([
            'item' => $this->item,
        ])->title($this->item->string ?: 'Sample Item');
    }
};
