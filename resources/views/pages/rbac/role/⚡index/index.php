<?php

namespace App\Livewire\Pages\RBAC\Role;

use App\Enums\AuthGuard;
use App\Models\RBAC\Role;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public string $search = '';
    public string $guardName = '';
    public string $sortField = 'created_at';
    public string $sortDirection = 'desc';

    /**
     * @throws AuthorizationException
     */
    public function mount(): void
    {
        $this->authorize('viewAny', Role::class);
    }

    public function resetSearch(): void
    {
        $this->search = '';
        $this->guardName = '';
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

    #[Computed]
    public function guards()
    {
        return AuthGuard::cases();
    }

    #[Computed]
    public function roles()
    {
        Log::debug('Fetching roles', [
            'search_term' => $this->normalizedSearch(),
            'guard_name' => $this->guardName,
            'sort_field' => $this->sortField,
            'sort_direction' => $this->sortDirection,
            'page' => $this->getPage(),
        ]);

        $query = Role::search($this->normalizedSearch());

        if ($this->guardName) {
            if (in_array($this->guardName, AuthGuard::values())) {
                $query->where('guard_name', $this->guardName);
            } else {
                $this->guardName = '';
            }
        }

        $query->orderBy($this->sortField, $this->sortDirection);

        return $query->paginate(10)->withQueryString();
    }

    /**
     * @throws AuthorizationException
     */
    public function delete(Role $role): void
    {
        try {
            $this->authorize('delete', $role);

            Log::info('Deleting role', ['role_id' => $role->id, 'user_id' => auth()->id()]);

            $role->delete();
            session()->flash('message', 'Role deleted successfully.');
            Log::info('Role deleted successfully', ['role_id' => $role->id]);
        } catch (AuthorizationException $e) {
            Log::warning('Unauthorized delete attempt', ['role_id' => $role->id, 'user_id' => auth()->id()]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error deleting role', ['role_id' => $role->id, 'error' => $e->getMessage()]);
            session()->flash('error', 'Failed to delete role.');
        }
    }

    public function render(): View
    {
        return $this->view([
            'roles' => $this->roles,
        ]);
    }
};
