<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerRegister extends Component
{
    public string $name             = '';
    public string $email            = '';
    public string $password         = '';
    public string $password_confirmation = '';

    protected function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];
    }

    protected function messages(): array
    {
        return [
            'name.required'      => 'Naam zaroori hai.',
            'email.required'     => 'Email zaroori hai.',
            'email.email'        => 'Sahi email format daalo.',
            'email.unique'       => 'Yeh email pehle se registered hai.',
            'password.required'  => 'Password zaroori hai.',
            'password.min'       => 'Password kam az kam 8 characters ka hona chahiye.',
            'password.confirmed' => 'Password confirm nahi hua.',
        ];
    }

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
        ]);

        Auth::login($user);
        session()->regenerate();

        return $this->redirect(route('products'), navigate: true);
    }

    public function render()
    {
        return view('livewire.frontend.customer-register')
            ->layout('layouts.frontend');
    }
}