<?php

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
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

    public function mount(): void
    {
        abort_unless(! app()->isProduction(), 403, 'Login As feature is only available in non-production environment.');
    }

    public function resetSearch(): void
    {
        $this->search = '';
        $this->resetPage();
    }

    public function updatedSearch(): void
    {
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
        return User::search($this->normalizedSearch())
            ->paginate(15)
            ->withQueryString();
    }

    public function loginAs(string $userId): void
    {
        $user = User::query()->findOrFail($userId);

        Auth::login($user, remember: false);
        session()->regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    public function render(): View
    {
        return $this->view([
            'users' => $this->users,
        ])->layout('layouts.auth')->title('Login As');
    }
};
