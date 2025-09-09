@extends('admin.master')
@section('title', 'Edit Category')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
    <h3 class="text-2xl font-bold text-gray-800 mb-6">Edit Category</h3>

    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea id="description" name="description" rows="4"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('description', $category->description) }}</textarea>
        </div>

        <!-- Image Upload with Preview -->
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Category Image</label>

            <div
                class="relative w-100 h-40 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50 overflow-hidden">
                <img id="preview"
                     src="{{ asset($category->image) }}"
                     alt="Preview"
                     class="{{ $category->image ? 'block' : 'hidden' }} w-full h-full object-cover rounded-lg" />
                <span id="placeholder" class="{{ $category->image ? 'hidden' : 'block' }} text-gray-400 text-sm">
                    No Image
                </span>
            </div>

            <input type="file" id="image" name="image" accept="image/*"
                class="mt-3 block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
                file:rounded-md file:border-0 file:text-sm file:font-semibold
                file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100" />

            <button type="button" id="clearImage" class="mt-2 text-red-600 text-sm hover:underline {{ $category->image ? 'block' : 'hidden' }}">
                Remove Image
            </button>
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <button type="submit"
                class="bg-indigo-600 text-white px-6 py-2 rounded-lg shadow hover:bg-indigo-700 transition">
                Update Category
            </button>
        </div>
    </form>
</div>

<!-- Image Preview Script -->
<script>
    const imageInput = document.getElementById('image');
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('placeholder');
    const clearBtn = document.getElementById('clearImage');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                preview.setAttribute('src', event.target.result);
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
                clearBtn.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    clearBtn.addEventListener('click', function() {
        imageInput.value = '';
        preview.setAttribute('src', '');
        preview.classList.add('hidden');
        placeholder.classList.remove('hidden');
        this.classList.add('hidden');
    });
</script>
@endsection
