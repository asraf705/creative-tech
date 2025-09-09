@extends('admin.master')
@section('title', 'Manage Products')

@section('content')
    <div class="p-6">
        <!-- Page Title -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Manage Products</h2>

        <!-- Table Wrapper -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-4 flex flex-col sm:flex-row items-center justify-between gap-3">
                <!-- Search -->
                <div class="w-full sm:w-1/3">
                    <input type="text" id="searchInput"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Search products...">
                </div>
                <!-- Add Button -->
                <a href="{{ route('products.create') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow">
                    + Add Product
                </a>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table id="productTable" class="min-w-full text-sm text-left text-gray-600">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Image</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Code</th>
                            <th class="px-4 py-3">Regular Price</th>
                            <th class="px-4 py-3">Selling Price</th>
                            <th class="px-4 py-3">Stock</th>
                            <th class="px-4 py-3">Category</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="divide-y divide-gray-200">
                        @foreach ($products as $index => $product)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">
                                    <img src="{{ asset($product->image) }}" alt="Product"
                                        class="w-12 h-12 rounded object-cover border">
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-800">{{ $product->name }}</td>
                                <td class="px-4 py-3">{{ $product->code }}</td>
                                <td class="px-4 py-3">{{ number_format($product->regular_price, 2) }} ৳</td>
                                <td class="px-4 py-3">
                                    @if ($product->selling_price)
                                        <span class="text-green-600 font-semibold">
                                            {{ number_format($product->selling_price, 2) }} ৳
                                        </span>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    {{ $product->stock_amount > 0 ? $product->stock_amount : 'Out of stock' }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $product->category->name ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-3 text-right space-x-2">
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="text-indigo-600 hover:text-indigo-800 font-medium">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')"
                                            class="text-red-600 hover:text-red-800 font-medium">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div id="pagination" class="flex justify-end items-center p-4 text-sm text-gray-600"></div>
        </div>
    </div>

    <!-- Simple DataTable Script -->
    <script>
        const rowsPerPage = 5;
        let currentPage = 1;

        const searchInput = document.getElementById("searchInput");
        const tableBody = document.getElementById("tableBody");
        const pagination = document.getElementById("pagination");
        const rows = [...tableBody.querySelectorAll("tr")];

        function renderTable() {
            const searchTerm = searchInput.value.toLowerCase();
            let filteredRows = rows.filter(row =>
                row.innerText.toLowerCase().includes(searchTerm)
            );

            const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
            currentPage = Math.min(currentPage, totalPages || 1);

            tableBody.innerHTML = "";
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            filteredRows.slice(start, end).forEach(row => tableBody.appendChild(row));

            pagination.innerHTML = `
            <div class="flex gap-2">
                <button onclick="changePage(${currentPage - 1})" ${currentPage === 1 ? "disabled" : ""}
                    class="px-3 py-1 border rounded ${currentPage === 1 ? "text-gray-400 cursor-not-allowed" : "hover:bg-indigo-50"}">
                    Prev
                </button>
                <span class="px-3 py-1">Page ${currentPage} of ${totalPages || 1}</span>
                <button onclick="changePage(${currentPage + 1})" ${currentPage === totalPages ? "disabled" : ""}
                    class="px-3 py-1 border rounded ${currentPage === totalPages ? "text-gray-400 cursor-not-allowed" : "hover:bg-indigo-50"}">
                    Next
                </button>
            </div>
        `;
        }

        function changePage(page) {
            currentPage = page;
            renderTable();
        }

        searchInput.addEventListener("input", () => {
            currentPage = 1;
            renderTable();
        });

        renderTable();
    </script>
@endsection
