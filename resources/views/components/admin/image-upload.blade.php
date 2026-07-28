@props([
    'name',
    'label' => 'Foto / Gambar',
    'helper' => 'PNG, JPG up to 1MB.',
    'currentImage' => null,
    'required' => false
])

@php
    $id = uniqid('upload_');
@endphp

<div>
    <input type="hidden" name="remove_{{ $name }}" id="remove_{{ $id }}" value="0">
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">
            {{ $label }} @if($required) <span class="text-red-500">*</span> @endif
        </label>
    @endif
    
    <label for="{{ $id }}" id="dropzone_{{ $id }}" class="mt-1 flex flex-col justify-center min-h-[120px] rounded-xl border-2 border-dashed border-slate-300 px-4 py-3 hover:bg-slate-50 dark:bg-slate-800 transition-colors relative cursor-pointer group">
        <div class="text-center w-full" id="upload_text_{{ $id }}" @if($currentImage) style="display:none;" @endif>
            <svg class="mx-auto h-8 w-8 text-slate-600 group-hover:text-[#2D5A27] transition-colors" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
            </svg>
            
            <div class="mt-2 flex text-sm leading-6 text-slate-600 dark:text-white justify-center">
                <span class="font-semibold text-[#D4A373] group-hover:text-[#2D5A27] transition-colors">Pilih File</span>
                <p class="pl-1">atau drag and drop</p>
            </div>
            <p class="text-[11px] leading-5 text-slate-500 dark:text-white">{{ $helper }}</p>
        </div>

        <input id="{{ $id }}" name="{{ $name }}" type="file" class="sr-only" accept=".jpg,.jpeg,.png,image/jpeg,image/png,image/jpg" {{ $required && !$currentImage ? 'required' : '' }}>

        <!-- Image Preview -->
        <div id="preview_container_{{ $id }}" class="w-full flex flex-col items-center justify-center p-2 z-10" style="display: {{ $currentImage ? 'flex' : 'none' }};">
            <div class="relative w-full flex justify-center">
                <img id="preview_img_{{ $id }}" src="{{ $currentImage ? asset('storage/' . $currentImage) : '#' }}" alt="Preview" class="max-h-24 object-contain rounded-lg shadow-sm border border-slate-200 dark:border-slate-700">
                <!-- Remove Button -->
                <button type="button" onclick="removeImage_{{ $id }}(event)" class="absolute -top-3 -right-3 p-1 bg-red-100 text-red-600 rounded-full hover:bg-red-200 shadow-sm transition-colors z-20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <p id="filename_{{ $id }}" class="text-sm text-slate-600 dark:text-white font-medium truncate max-w-full mt-3 px-4">{{ $currentImage ? 'Gambar Tersimpan' : '' }}</p>
        </div>
    </label>
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<script>
    (function() {
        const input = document.getElementById('{{ $id }}');
        const dropZone = document.getElementById('dropzone_{{ $id }}');
        const previewContainer = document.getElementById('preview_container_{{ $id }}');
        const previewImg = document.getElementById('preview_img_{{ $id }}');
        const uploadText = document.getElementById('upload_text_{{ $id }}');
        const fileName = document.getElementById('filename_{{ $id }}');

        window.removeImage_{{ $id }} = function(event) {
            event.preventDefault();
            event.stopPropagation();
            input.value = '';
            previewImg.src = '#';
            fileName.textContent = '';
            previewContainer.style.display = 'none';
            uploadText.style.display = 'block';
            dropZone.classList.remove('border-[#2D5A27]', 'border-solid');
            dropZone.classList.add('border-dashed');
            document.getElementById('remove_{{ $id }}').value = '1';
        };

        function handleFile(file) {
            const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            if (file && validTypes.includes(file.type)) {
                if (file.size > 1 * 1024 * 1024) {
                    alert('Ukuran foto maksimal 1 MB!');
                    input.value = '';
                    return;
                }
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    fileName.textContent = file.name;
                    previewContainer.style.display = 'flex';
                    uploadText.style.display = 'none';
                    dropZone.classList.add('border-[#2D5A27]', 'border-solid');
                    dropZone.classList.remove('border-dashed');
                    document.getElementById('remove_{{ $id }}').value = '0';
                }
                reader.readAsDataURL(file);
            }
        }

        input.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                handleFile(this.files[0]);
            }
        });

        // Drag and Drop
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, function(e) {
                e.preventDefault();
                e.stopPropagation();
            }, false);
        });

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.add('border-[#2D5A27]', 'bg-green-50');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.remove('border-[#2D5A27]', 'bg-green-50');
            }, false);
        });

        dropZone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            if (files.length > 0) {
                input.files = files;
                handleFile(files[0]);
            }
        }, false);
    })();
</script>
