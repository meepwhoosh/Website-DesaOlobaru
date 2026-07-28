@props([
    'name',
    'label' => 'Foto / Gambar (Bisa pilih lebih dari satu, maks 3)',
    'helper' => 'PNG, JPG up to 1MB per file. Maksimal 3 file.',
    'currentImages' => [],
    'required' => false
])

@php
    $id = uniqid('upload_multi_');
@endphp

<div>
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">
            {{ $label }} @if($required) <span class="text-red-500">*</span> @endif
        </label>
    @endif
    
    <label for="{{ $id }}" id="dropzone_{{ $id }}" class="mt-1 flex flex-col justify-center min-h-[120px] rounded-xl border-2 border-dashed border-slate-300 dark:border-slate-600 px-4 py-6 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors relative cursor-pointer group">
        <div class="text-center w-full" id="upload_text_{{ $id }}">
            <svg class="mx-auto h-8 w-8 text-slate-600 dark:text-slate-400 group-hover:text-green-600 transition-colors" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
            </svg>
            <div class="mt-2 flex text-sm leading-6 text-slate-600 dark:text-slate-300 justify-center">
                <span class="font-semibold text-blue-600 dark:text-blue-400 group-hover:text-green-600 transition-colors">Pilih File (Bisa diblok semua)</span>
                <p class="pl-1">atau drag and drop</p>
            </div>
            <p class="text-[11px] leading-5 text-slate-500 dark:text-slate-400 mt-1">{{ $helper }}</p>
        </div>

        <input id="{{ $id }}" name="{{ $name }}[]" type="file" class="sr-only" accept=".jpg,.jpeg,.png,image/jpeg,image/png,image/jpg" multiple {{ $required && empty($currentImages) ? 'required' : '' }}>
    </label>

    <!-- Error message display -->
    <p id="error_msg_{{ $id }}" class="mt-2 text-sm text-red-600 hidden"></p>
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
    @error($name . '.*')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror

    <!-- Previews of selected local files -->
    <div id="preview_container_{{ $id }}" class="mt-4 grid grid-cols-2 sm:grid-cols-3 gap-4" style="display: none;">
        <!-- Javascript will inject image previews here -->
    </div>

    <!-- Existing Images Section -->
    @if(!empty($currentImages))
        <div class="mt-6 border-t border-slate-200 dark:border-slate-700 pt-4" id="existing_images_section_{{ $id }}">
            <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 mb-3">Foto yang sudah ada:</p>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4" id="existing_container_{{ $id }}">
                @foreach($currentImages as $index => $img)
                    <div class="relative group rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm aspect-[4/3] bg-slate-100 dark:bg-slate-800 existing-img-card" data-img="{{ $img }}">
                        <img src="{{ asset('storage/' . $img) }}" class="w-full h-full object-cover">
                        
                        <!-- Remove Button -->
                        <button type="button" title="Hapus Foto Ini" onclick="removeExistingImage('{{ $id }}', this, '{{ $img }}', '{{ $name }}')" class="absolute top-2 right-2 bg-red-600/90 hover:bg-red-700 text-white p-1 rounded-md shadow-sm transition-opacity opacity-0 group-hover:opacity-100 z-10 focus:outline-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                        
                        <div class="absolute top-2 left-2 bg-black/60 text-white text-[10px] font-bold px-2 py-0.5 rounded-full pointer-events-none">
                            Foto {{ $index + 1 }}
                        </div>
                    </div>
                @endforeach
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-3">* Arahkan kursor dan klik tombol silang (X) merah untuk menghapus foto lama.</p>
        </div>
    @endif
</div>

<script>
    function removeExistingImage(id, btn, imgValue, inputName) {
        // Create hidden input to mark as deleted
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'deleted_' + inputName + '[]';
        hiddenInput.value = imgValue;
        
        // Append hidden input to the form
        const container = document.getElementById('existing_images_section_' + id);
        container.appendChild(hiddenInput);
        
        // Remove the visual card
        const card = btn.closest('.existing-img-card');
        card.remove();
        
        // Decrease existingCount globally for that specific upload element
        if (window['existingCount_' + id]) {
            window['existingCount_' + id]--;
        }
    }
    (function() {
        const input = document.getElementById('{{ $id }}');
        const dropZone = document.getElementById('dropzone_{{ $id }}');
        const previewContainer = document.getElementById('preview_container_{{ $id }}');
        const errorMsg = document.getElementById('error_msg_{{ $id }}');
        const maxFiles = 3;
        
        window['existingCount_{{ $id }}'] = {{ count($currentImages) }};
        
        let stagedFiles = [];

        function renderPreviews() {
            previewContainer.innerHTML = '';
            errorMsg.classList.add('hidden');
            
            const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            const initialLength = stagedFiles.length;
            stagedFiles = stagedFiles.filter(f => validTypes.includes(f.type) && f.size <= 1 * 1024 * 1024);
            if (stagedFiles.length < initialLength) {
                alert('Beberapa file dibatalkan karena format tidak sesuai (hanya JPG/PNG) atau ukuran lebih dari 1 MB.');
            }
            
            const totalFiles = stagedFiles.length + (window['existingCount_{{ $id }}'] || 0);
            
            if (totalFiles > maxFiles) {
                errorMsg.textContent = 'Maksimal ' + maxFiles + ' foto secara keseluruhan (termasuk foto lama). Beberapa foto yang baru dipilih dibatalkan agar tidak melebihi batas.';
                errorMsg.classList.remove('hidden');
                
                // Trim staged files to fit the limit
                const allowedNew = maxFiles - (window['existingCount_{{ $id }}'] || 0);
                if (allowedNew > 0) {
                    stagedFiles = stagedFiles.slice(0, allowedNew);
                } else {
                    stagedFiles = [];
                }
            }

            // Sync stagedFiles to input
            const dt = new DataTransfer();
            stagedFiles.forEach(f => dt.items.add(f));
            input.files = dt.files;

            if (stagedFiles.length > 0) {
                previewContainer.style.display = 'grid';
                stagedFiles.forEach((file, index) => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const div = document.createElement('div');
                            div.className = 'relative rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm aspect-[4/3] bg-slate-100 dark:bg-slate-800 group';
                            
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'w-full h-full object-cover';
                            
                            const badge = document.createElement('div');
                            badge.className = 'absolute top-2 left-2 bg-green-600/90 text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-sm pointer-events-none';
                            badge.textContent = 'Baru ' + (index + 1);

                            const removeBtn = document.createElement('button');
                            removeBtn.type = 'button';
                            removeBtn.title = 'Batal Upload Foto Ini';
                            removeBtn.className = 'absolute top-2 right-2 bg-red-600/90 hover:bg-red-700 text-white p-1 rounded-md shadow-sm transition-opacity opacity-0 group-hover:opacity-100 z-10 focus:outline-none';
                            removeBtn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>';
                            removeBtn.onclick = function(event) {
                                event.preventDefault();
                                event.stopPropagation();
                                stagedFiles.splice(index, 1);
                                renderPreviews();
                            };

                            div.appendChild(img);
                            div.appendChild(badge);
                            div.appendChild(removeBtn);
                            previewContainer.appendChild(div);
                        };
                        reader.readAsDataURL(file);
                    }
                });
                dropZone.classList.add('border-green-500', 'bg-green-50/50', 'dark:bg-green-900/20');
                dropZone.classList.remove('border-dashed');
            } else {
                previewContainer.style.display = 'none';
                dropZone.classList.remove('border-green-500', 'bg-green-50/50', 'dark:bg-green-900/20');
                dropZone.classList.add('border-dashed');
            }
        }

        input.addEventListener('change', function() {
            if (input.files.length > 0) {
                const newFiles = Array.from(input.files);
                stagedFiles = stagedFiles.concat(newFiles);
                renderPreviews();
            } else {
                renderPreviews();
            }
        });

        // Drag and Drop Logic
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, function(e) {
                e.preventDefault();
                e.stopPropagation();
            }, false);
        });

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.add('border-green-400', 'bg-green-50');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.remove('border-green-400', 'bg-green-50');
            }, false);
        });

        dropZone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            if (dt.files.length > 0) {
                stagedFiles = stagedFiles.concat(Array.from(dt.files));
                renderPreviews();
            }
        }, false);
    })();
</script>
