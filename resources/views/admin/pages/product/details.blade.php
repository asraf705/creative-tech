@extends('admin.master')
@section('title', 'Product Details')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Product Details</h2>
        <a href="{{ route('products.index') }}"
           class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg shadow">
            Back
        </a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
            <div>
                <div class="relative">
                    <img id="mainImage" src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                         class="w-full h-80 object-cover rounded-lg border cursor-pointer transition duration-300 hover:scale-105">
                </div>

                @if ($product->images && $product->images->count() > 0)
                    <div class="flex gap-3 mt-4 overflow-x-auto">
                        @foreach ($product->images as $img)
                            <img src="{{ asset($img->other_images) }}"
                                 class="thumbnail w-20 h-20 rounded object-cover border cursor-pointer transition duration-200 hover:scale-110">
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="space-y-4">
                <h3 class="text-2xl font-semibold text-gray-900">{{ $product->name }}</h3>
                <p class="text-sm text-gray-500">Code: {{ $product->code ?? 'N/A' }}</p>
                <p class="text-gray-700">{{ $product->short_description }}</p>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-500 text-sm">Regular Price</p>
                        <p class="text-lg font-medium">{{ number_format($product->regular_price, 2) }} ৳</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Selling Price</p>
                        <p class="text-lg font-medium text-green-600">
                            {{ $product->selling_price ? number_format($product->selling_price, 2) . ' ৳' : '—' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Stock</p>
                        <p class="text-lg font-medium">
                            {{ $product->stock_amount > 0 ? $product->stock_amount : 'Out of stock' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Category</p>
                        <p class="text-lg font-medium">{{ $product->category->name ?? 'N/A' }}</p>
                    </div>
                </div>

                @if ($product->discount_type && $product->discount_amount)
                    <div>
                        <p class="text-gray-500 text-sm">Discount</p>
                        <p class="text-lg font-medium">
                            {{ ucfirst($product->discount_type) }} - {{ $product->discount_amount }}
                            {{ $product->discount_type === 'percent' ? '%' : '৳' }}
                        </p>
                    </div>
                @endif

                @if ($product->video_link)
                    <div>
                        <p class="text-gray-500 text-sm">Video</p>
                        <a href="{{ $product->video_link }}" target="_blank"
                           class="text-indigo-600 hover:underline">
                            Watch Video
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="border-t p-6 space-y-4">
            <div>
                <h4 class="text-lg font-semibold text-gray-800 mb-2">Long Description</h4>
                <p class="text-gray-700 leading-relaxed">{{ $product->long_description }}</p>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-gray-800 mb-2">Meta Information</h4>
                <p class="text-sm text-gray-500">Title: {{ $product->meta_title ?? '—' }}</p>
                <p class="text-sm text-gray-500">Description: {{ $product->meta_description ?? '—' }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-75 hidden justify-center items-center z-50">
    <img id="lightboxImage" src="" class="max-h-[90%] max-w-[90%] rounded-lg shadow-lg">
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const mainImage = document.getElementById("mainImage");
        const thumbnails = document.querySelectorAll(".thumbnail");
        const lightbox = document.getElementById("lightbox");
        const lightboxImage = document.getElementById("lightboxImage");

        thumbnails.forEach(thumb => {
            thumb.addEventListener("click", () => {
                mainImage.src = thumb.src;
                thumbnails.forEach(t => t.classList.remove("ring-2", "ring-indigo-500"));
                thumb.classList.add("ring-2", "ring-indigo-500");
            });
        });

        mainImage.addEventListener("click", () => {
            lightboxImage.src = mainImage.src;
            lightbox.classList.remove("hidden");
            lightbox.classList.add("flex");
        });

        lightbox.addEventListener("click", () => {
            lightbox.classList.add("hidden");
            lightbox.classList.remove("flex");
        });
    });
</script>
@endsection
