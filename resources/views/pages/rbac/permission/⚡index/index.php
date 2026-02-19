<?php

namespace App\Livewire\Pages\RBAC\Permission;

use App\Enums\AuthGuard;
use App\Models\RBAC\Permission;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;
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
        $this->authorize('viewAny', Permission::class);
    }

    public function resetSearch(): void
    {
        $this->search = '';
        $this->guardName = '';
        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedGuardName(): void
    {
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
    public function permissions()
    {
        Log::debug('Fetching permissions', [
            'search_term' => $this->normalizedSearch(),
            'guard_name' => $this->guardName,
            'sort_field' => $this->sortField,
            'sort_direction' => $this->sortDirection,
            'page' => $this->getPage(),
        ]);

        $query = Permission::search($this->normalizedSearch());

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
    public function delete(Permission $permission): void
    {
        try {
            $this->authorize('delete', $permission);

            Log::info('Deleting permission', ['permission_id' => $permission->id, 'user_id' => auth()->id()]);

            DB::transaction(function () use ($permission) {
                $permission->roles()->detach();
                $permission->users()->detach();
                $permission->delete();
            });

            session()->flash('message', 'Permission deleted successfully.');
            Log::info('Permission deleted successfully', ['permission_id' => $permission->id]);
        } catch (AuthorizationException $e) {
            Log::warning('Unauthorized delete attempt', ['permission_id' => $permission->id, 'user_id' => auth()->id()]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error deleting permission', ['permission_id' => $permission->id, 'error' => $e->getMessage()]);
            session()->flash('error', 'Failed to delete permission.');
        }
    }

    public function render(): View
    {
        return $this->view([
            'permissions' => $this->permissions,
        ])->layout('layouts.app', ['sidebar' => 'user'])->title('Permissions');
    }
};
