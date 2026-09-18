<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Profile extends Component
{
    use WithFileUploads;

    public $user;
    public $name;
    public $email;
    public $phone;
    public $bio;
    public $profile_image;
    public $new_profile_image;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;
    public $showPasswordForm = false;
    public $successMessage = '';
    public $errorMessage = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . '{{auth()->id()}}',
        'phone' => 'nullable|string|max:20',
        'bio' => 'nullable|string|max:500',
        'new_profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'current_password' => 'required_with:new_password|string|min:8',
        'new_password' => 'nullable|string|min:8|confirmed',
        'new_password_confirmation' => 'nullable|string|min:8',
    ];

    public function mount()
    {
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone ?? '';
        $this->bio = $this->user->bio ?? '';
        $this->profile_image = $this->user->profile_image ?? null;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:500',
            'new_profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $user = User::find(auth()->id());
            $user->name = $this->name;
            $user->email = $this->email;
            $user->phone = $this->phone;
            $user->bio = $this->bio;

            // Handle profile image upload
            if ($this->new_profile_image) {
                // Delete old image if exists
                if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                    Storage::disk('public')->delete($user->profile_image);
                }
                
                $imagePath = $this->new_profile_image->store('profiles', 'public');
                $user->profile_image = $imagePath;
                $this->profile_image = $imagePath;
                $this->new_profile_image = null;
            }

            $user->save();
            
            $this->successMessage = 'Profile updated successfully!';
            $this->errorMessage = '';
            $this->dispatch('profileUpdated');
            
        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to update profile: ' . $e->getMessage();
            $this->successMessage = '';
        }
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|confirmed',
            'new_password_confirmation' => 'required|string|min:8',
        ]);

        $user = User::find(auth()->id());

        // Check current password
        if (!Hash::check($this->current_password, $user->password)) {
            $this->errorMessage = 'Current password is incorrect.';
            $this->successMessage = '';
            return;
        }

        // Update password
        $user->password = Hash::make($this->new_password);
        $user->save();

        $this->current_password = '';
        $this->new_password = '';
        $this->new_password_confirmation = '';
        $this->showPasswordForm = false;
        $this->successMessage = 'Password updated successfully!';
        $this->errorMessage = '';
    }

    public function togglePasswordForm()
    {
        $this->showPasswordForm = !$this->showPasswordForm;
        if (!$this->showPasswordForm) {
            $this->current_password = '';
            $this->new_password = '';
            $this->new_password_confirmation = '';
            $this->errorMessage = '';
        }
    }

    public function removeProfileImage()
    {
        $user = User::find(auth()->id());
        if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
            Storage::disk('public')->delete($user->profile_image);
        }
        $user->profile_image = null;
        $user->save();
        $this->profile_image = null;
        $this->successMessage = 'Profile image removed.';
    }

    public function updated($propertyName)
    {
        // Clear messages when user starts typing
        $this->successMessage = '';
        $this->errorMessage = '';
    }

    // ============================================================
    // PASSWORD STRENGTH METHODS - Add them here
    // ============================================================
    
    public function getPasswordStrength()
    {
        $password = $this->new_password;
        if (empty($password)) return 0;
        
        $strength = 0;
        if (strlen($password) >= 8) $strength += 25;
        if (preg_match('/[a-z]/', $password) && preg_match('/[A-Z]/', $password)) $strength += 25;
        if (preg_match('/[0-9]/', $password)) $strength += 25;
        if (preg_match('/[^a-zA-Z0-9]/', $password)) $strength += 25;
        
        return $strength;
    }

    public function getPasswordStrengthColor()
    {
        $strength = $this->getPasswordStrength();
        if ($strength <= 25) return '#dc3545';
        if ($strength <= 50) return '#ffc107';
        if ($strength <= 75) return '#17a2b8';
        return '#28a745';
    }

    public function getPasswordStrengthText()
    {
        $strength = $this->getPasswordStrength();
        if ($strength <= 25) return 'Weak';
        if ($strength <= 50) return 'Fair';
        if ($strength <= 75) return 'Good';
        return 'Strong';
    }

    // ============================================================
    // RENDER METHOD
    // ============================================================
    
    public function render()
    {
        return view('livewire.user.profile')
            ->layout('components.layouts.app');
    }
}