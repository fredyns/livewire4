<?php

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

/**
 * @property User $user The user instance
 */
new class extends Component {
    public User $user;

    /**
     * @throws AuthorizationException
     */
    public function mount(User $user): void
    {
        $this->authorize('view', $user);
        $this->user = $user;

        Log::info('Viewing user detail', ['user_id' => $user->id, 'viewed_by' => auth()->id()]);
    }

    #[Computed]
    public function roles()
    {
        return $this->user->webRoles()->get();
    }

    public function render(): View
    {
        return $this->view([
            'user' => $this->user,
        ])->title($this->user->name);
    }
};
