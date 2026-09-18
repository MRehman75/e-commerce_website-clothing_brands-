<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CustomerLogin extends Component
{
    public string $email    = '';
    public string $password = '';
    public bool   $remember = false;

    protected function rules(): array
    {
        return [
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ];
    }

    protected function messages(): array
    {
        return [
            'email.required'    => 'Email zaroori hai.',
            'email.email'       => 'Sahi email format daalo.',
            'password.required' => 'Password zaroori hai.',
            'password.min'      => 'Password kam az kam 6 characters ka hona chahiye.',
        ];
    }

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();
            return $this->redirect(route('products'), navigate: true);
        }

        $this->addError('email', 'Email ya password galat hai.');
    }

    public function render()
    {
        return view('livewire.frontend.customer-login')
            ->layout('components.layouts.app');
    }
}