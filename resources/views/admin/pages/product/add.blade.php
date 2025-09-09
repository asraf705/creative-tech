@extends('admin.master')
@section('title', 'New Product')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-gray-800">Create New Product</h3>
            <a class="bg-red-600 text-white px-6 py-2 rounded-lg shadow hover:bg-red-700 transition"
               href="{{ route('products.index') }}">Back</a>
        </div>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Category -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Select Category</label>
                <select id="category_id" name="category_id" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Product Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Product Name</label>
                <input type="text" id="name" name="name" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
            </div>

            <!-- Product Code -->
            <div>
                <label for="code" class="block text-sm font-medium text-gray-700 mb-2">Product Code</label>
                <input type="text" id="code" name="code"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
            </div>

            <!-- Short Description -->
            <div>
                <label for="short_description" class="block text-sm font-medium text-gray-700 mb-2">Short Description</label>
                <textarea id="short_description" name="short_description" rows="3"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"></textarea>
            </div>

            <!-- Long Description -->
            <div>
                <label for="long_description" class="block text-sm font-medium text-gray-700 mb-2">Long Description</label>
                <textarea id="long_description" name="long_description" rows="5"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"></textarea>
            </div>

            <!-- Main Image Upload -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Main Product Image</label>
                <div
                    class="relative w-100 h-40 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50 overflow-hidden">
                    <img id="preview" src="" alt="Preview"
                        class="hidden w-full h-full object-cover rounded-lg" />
                    <span id="placeholder" class="text-gray-400 text-sm">No Image</span>
                </div>
                <input type="file" id="image" name="image" accept="image/*"
                    class="mt-3 block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0 file:text-sm file:font-semibold
                    file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100" />
                <button type="button" id="clearImage" class="mt-2 text-red-600 text-sm hidden hover:underline">
                    Remove Image
                </button>
            </div>

            <!-- Other Images -->
            <div>
                <label for="other_image" class="block text-sm font-medium text-gray-700 mb-2">Other Images (Multiple)</label>
                <input type="file" id="other_image" name="other_image[]" multiple accept="image/*"
                    class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0 file:text-sm file:font-semibold
                    file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100" />
            </div>

            <!-- Video Link -->
            <div>
                <label for="video_link" class="block text-sm font-medium text-gray-700 mb-2">Video Link</label>
                <input type="url" id="video_link" name="video_link"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
            </div>

            <!-- Pricing -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="regular_price" class="block text-sm font-medium text-gray-700 mb-2">Regular Price</label>
                    <input type="number" step="0.01" id="regular_price" name="regular_price"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                </div>
                <div>
                    <label for="selling_price" class="block text-sm font-medium text-gray-700 mb-2">Selling Price</label>
                    <input type="number" step="0.01" id="selling_price" name="selling_price"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                </div>
                <div>
                    <label for="stock_amount" class="block text-sm font-medium text-gray-700 mb-2">Stock Amount</label>
                    <input type="number" id="stock_amount" name="stock_amount"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                </div>
            </div>

            <!-- Discount -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="discount_type" class="block text-sm font-medium text-gray-700 mb-2">Discount Type</label>
                    <select id="discount_type" name="discount_type"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        <option value="">-- Select Type --</option>
                        <option value="percent">Percent</option>
                        <option value="amount">Fixed Amount</option>
                    </select>
                </div>
                <div>
                    <label for="discount_amount" class="block text-sm font-medium text-gray-700 mb-2">Discount Amount</label>
                    <input type="number" step="0.01" id="discount_amount" name="discount_amount"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                </div>
            </div>

            <!-- Meta Info -->
            <div>
                <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                <input type="text" id="meta_title" name="meta_title"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
            </div>
            <div>
                <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                <textarea id="meta_description" name="meta_description" rows="3"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"></textarea>
            </div>

            <!-- Submit -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg shadow hover:bg-indigo-700 transition">
                    Save Product
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
