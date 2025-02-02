<div>
    <form wire:submit.prevent="updateProfilePicture" enctype="multipart/form-data">
        <div class="mb-4">
            @if ($profilePicture)
                <!-- Show the new uploaded image preview -->
                <img src="{{ $profilePicture->temporaryUrl() }}" class="w-32 h-32 rounded-full">
            @elseif(auth()->user()->profile_picture)
                <!-- Force image reload using a timestamp -->
                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}?{{ now()->timestamp }}" 
                     class="w-32 h-32 rounded-full">
            @endif
        </div>

        <input type="file" wire:model="profilePicture" accept="image/*" class="block w-full text-sm text-gray-500" />

        @error('profilePicture') 
            <span class="text-red-500">{{ $message }}</span> 
        @enderror

        <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Update</button>
    </form>

    <!-- Success Message -->
    @if ($successMessage)
        <div class="mt-4 px-4 py-2 bg-green-500 text-white rounded">
            {{ $successMessage }}
        </div>
    @endif
</div>
