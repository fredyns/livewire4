<?php

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

/**
 * @property User $user The user instance
 * @property string $name
 * @property string $email
 */
new class extends Component
{
    #[Validate('required|string|min:3|max:255')]
    public string $name = '';

    #[Validate('required|email|max:255|unique:users,email')]
    public string $email = '';

    public User $user;

    /**
     * @throws AuthorizationException
     */
    public function mount(User $user): void
    {
        $this->authorize('update', $user);

        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function save(): void
    {
        try {
            $rules = [
                'name' => 'required|string|min:3|max:255',
                'email' => 'required|email|max:255|unique:users,email,'.$this->user->id,
            ];

            $data = $this->validate($rules);

            Log::info('Updating user', ['user_id' => $this->user->id, 'updated_by' => Auth::id()]);

            $this->user->fill($data);
            $this->user->save();

            session()->flash('message', 'User updated successfully.');
            Log::info('User updated successfully', ['user_id' => $this->user->id, 'updated_by' => Auth::id()]);

            $this->redirectRoute('user.show', ['user' => $this->user]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation failed on user update', ['user_id' => $this->user->id, 'errors' => $e->errors()]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error updating user', ['user_id' => $this->user->id, 'error' => $e->getMessage()]);
            session()->flash('error', 'Failed to update user. Please try again.');
        }
    }

    public function render(): View
    {
        return $this->view([
            'user' => $this->user,
        ])->title('Edit '.$this->user->name);
    }
};
