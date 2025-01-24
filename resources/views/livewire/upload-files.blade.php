<div class="p-4 border rounded">
    <h2 class="mb-4">Upload Files</h2>

    @if (session()->has('message'))
        <div class="text-green-600">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="uploadFiles" class="space-y-4">
        <div>
            {{-- File input --}}
            <input type="file" id="files" wire:model="files" class="border p-2 w-full" multiple>
            @error('files.*')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            {{-- Progress Bar --}}
            <div class="w-full bg-gray-200 rounded h-6 overflow-hidden">
                <div class="h-full bg-blue-500 transition-all duration-500" style="width: {{ $progress }}%;">
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded" {{ $progress === 100 ? 'disabled' : '' }}>
                Upload
            </button>
            <div id="preview" class="flex flex-wrap gap-2 mt-4">
                {{-- Preview area for images and text --}}
                @foreach ($previews as $file)
                    @if ($file['type'] === 'image')
                        <img src="{{ $file['url'] }}" alt="Preview" class="w-20 h-20 object-cover rounded border p-1">
                    @elseif ($file['type'] === 'text')
                        <div class="bg-gray-200 p-2 text-sm w-48 rounded">{{ Str::limit($file['content'], 50) }}</div>
                    @else
                        <div class="bg-gray-200 p-2 text-sm w-48 rounded">{{ $file['name'] }}</div>
                    @endif
                @endforeach
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('files').addEventListener('change', function(event) {
        const preview = document.getElementById('preview');
        preview.innerHTML = ''; // Clear existing previews

        Array.from(event.target.files).forEach(file => {
            const reader = new FileReader();

            if (file.type.startsWith('image/')) {
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '150px'; // Adjust size as needed
                    img.style.margin = '5px';
                    img.classList.add('rounded', 'border', 'p-1'); // Add Tailwind styling
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            } else if (file.type === 'text/plain') {
                reader.onload = function(e) {
                    const textPreview = document.createElement('div');
                    textPreview.textContent = e.target.result;
                    textPreview.classList.add('bg-gray-200', 'p-2', 'text-sm', 'w-48', 'rounded');
                    preview.appendChild(textPreview);
                };
                reader.readAsText(file);
            } else {
                // For other file types (e.g., PDFs, Word docs), you could show the file name
                const fileName = document.createElement('div');
                fileName.textContent = file.name;
                fileName.classList.add('bg-gray-200', 'p-2', 'text-sm', 'w-48', 'rounded');
                preview.appendChild(fileName);
            }
        });
    });
</script>
