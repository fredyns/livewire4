<?php

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * @property string $search
 * @property User[]|LengthAwarePaginator $users
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
        $this->authorize('viewAny', User::class);
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
     * @return User[]|LengthAwarePaginator
     */
    #[Computed]
    public function users(): array|LengthAwarePaginator
    {
        $query = User::search($this->normalizedSearch());

        $query->orderBy($this->sortField, $this->sortDirection);

        return $query->paginate(10)->withQueryString();
    }

    /**
     * @throws AuthorizationException
     */
    public function delete(User $user): void
    {
        try {
            $this->authorize('delete', $user);

            Log::info('Deleting user', ['user_id' => $user->id, 'deleted_by' => auth()->id()]);

            $user->delete();
            session()->flash('message', 'User deleted successfully.');
            Log::info('User deleted successfully', ['user_id' => $user->id]);
        } catch (AuthorizationException $e) {
            Log::warning('Unauthorized delete attempt', ['user_id' => $user->id, 'deleted_by' => auth()->id()]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error deleting user', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            session()->flash('error', 'Failed to delete user.');
        }
    }

    public function render(): View
    {
        return $this->view([
            'users' => $this->users,
        ])->layout('layouts.app', ['sidebar' => 'user'])->title('Users');
    }
};
