<?php

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

/**
 * @property User $user The user instance
 * @property string $password
 * @property string $password_confirmation
 */
new class extends Component
{
    #[Validate('required|string|min:8|confirmed')]
    public string $password = '';

    #[Validate('required|string|min:8')]
    public string $password_confirmation = '';

    public User $user;

    /**
     * @throws AuthorizationException
     */
    public function mount(User $user): void
    {
        $this->authorize('update', $user);
        $this->user = $user;
    }

    public function save(): void
    {
        try {
            $data = $this->validate();

            Log::info('Updating user password', ['user_id' => $this->user->id, 'updated_by' => Auth::id()]);

            $this->user->forceFill([
                'password' => Hash::make($data['password']),
            ])->save();

            session()->flash('message', 'Password updated successfully.');
            Log::info('User password updated successfully', ['user_id' => $this->user->id, 'updated_by' => Auth::id()]);

            $this->redirectRoute('user.show', ['user' => $this->user]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation failed on user password update', ['user_id' => $this->user->id, 'errors' => $e->errors()]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error updating user password', ['user_id' => $this->user->id, 'error' => $e->getMessage()]);
            session()->flash('error', 'Failed to update password. Please try again.');
        }
    }

    public function render(): View
    {
        return $this->view([
            'user' => $this->user,
        ])->title('Edit Password ' . $this->user->name);
    }
};
