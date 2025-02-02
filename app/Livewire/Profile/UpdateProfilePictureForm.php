<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateProfilePictureForm extends Component
{
    use WithFileUploads;

    public $profilePicture;
    public $successMessage = '';

    public function updateProfilePicture()
    {
        $this->validate([
            'profilePicture' => 'image|max:2048', // 2MB max
        ]);

        $user = Auth::user();

        // Delete old profile picture if it exists
        if ($user->profile_picture) {
            Storage::delete('public/' . $user->profile_picture);
        }

        // Store the new image
        $path = $this->profilePicture->store('profile_pictures', 'public');

        // Update user profile
        $user->update([
            'profile_picture' => $path,
        ]);

        // Clear file input & show success message
        $this->profilePicture = null;
        $this->successMessage = 'Profile picture updated successfully!';

        // Dispatch an event to refresh the image
        $this->dispatch('profilePictureUpdated');
    }

    public function render()
    {
        return view('livewire.profile.update-profile-picture-form');
    }
}
