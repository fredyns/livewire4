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
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $password_confirmation
 */
new class extends Component
{
    #[Validate('required|string|min:3|max:255')]
    public string $name = '';

    #[Validate('required|email|max:255|unique:users,email')]
    public string $email = '';

    #[Validate('required|string|min:8|confirmed')]
    public string $password = '';

    #[Validate('required|string|min:8')]
    public string $password_confirmation = '';

    /**
     * @throws AuthorizationException
     */
    public function mount(): void
    {
        $this->authorize('create', User::class);
    }

    public function save(): void
    {
        try {
            $data = $this->validate();

            Log::info('Creating new user', ['created_by' => Auth::id()]);

            $data['password'] = Hash::make($data['password']);
            unset($data['password_confirmation']);

            $user = User::create($data);

            session()->flash('message', 'User created successfully.');
            Log::info('User created successfully', ['user_id' => $user->id, 'created_by' => Auth::id()]);

            $this->redirectRoute('user.show', ['user' => $user]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation failed on user creation', ['errors' => $e->errors()]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error creating user', ['error' => $e->getMessage(), 'created_by' => Auth::id()]);
            session()->flash('error', 'Failed to create user. Please try again.');
        }
    }

    public function render(): View
    {
        return $this->view()->layout('layouts.app', ['sidebar' => 'apps'])->title('Create User');
    }
};