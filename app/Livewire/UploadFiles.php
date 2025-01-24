<?php


namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class UploadFiles extends Component
{
    use WithFileUploads;

    public $files = [];
    public $previews = [];

    public function updatedFiles()
    {
        $this->previews = [];

        foreach ($this->files as $file) {
            if (in_array($file->getClientOriginalExtension(), ['jpeg', 'jpg', 'png', 'gif'])) {
                $this->previews[] = [
                    'type' => 'image',
                    'url' => $file->temporaryUrl(),
                ];
            } elseif (in_array($file->getClientOriginalExtension(), ['txt'])) {
                $this->previews[] = [
                    'type' => 'text',
                    'content' => $file->get(),
                ];
            } else {
                $this->previews[] = [
                    'type' => 'other',
                    'name' => $file->getClientOriginalName(),
                ];
            }
        }
    }

    public function save()
    {
        foreach ($this->files as $file) {
            $file->store('uploads', 'public');
        }

        session()->flash('message', 'Files uploaded successfully!');
        $this->reset('files', 'previews');
    }

    public function render()
    {
        return view('livewire.upload-files');
    }
}
