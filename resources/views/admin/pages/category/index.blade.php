@extends('admin.master')
@section('title', 'Manage Categories')

@section('content')
    <div class="p-6">
        <!-- Page Title -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Manage Categories</h2>

        <!-- Table Wrapper -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-4 flex flex-col sm:flex-row items-center justify-between gap-3">
                <!-- Search -->
                <div class="w-full sm:w-1/3">
                    <input type="text" id="searchInput"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Search categories...">
                </div>
                <!-- Add Button -->
                <a href="{{ route('categories.create') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow">
                    + Add Category
                </a>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table id="categoryTable" class="min-w-full text-sm text-left text-gray-600">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Description</th>
                            <th class="px-4 py-3">Image</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="divide-y divide-gray-200">
                        @foreach ($categories as $index => $category)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 font-medium text-gray-800">{{ $category->name }}</td>
                                <td class="px-4 py-3">{{ Str::limit($category->description, 40) }}</td>
                                <td class="px-4 py-3">
                                    <img src="{{ asset($category->image) }}"
                                        class="w-12 h-12 rounded object-cover border" alt="Category">
                                </td>
                                <td class="px-4 py-3">
                                    @if ($category->status == 1)
                                        <span
                                            class="px-2 py-1 text-xs font-semibold text-green-600 bg-green-100 rounded-full">Active</span>
                                    @else
                                        <span
                                            class="px-2 py-1 text-xs font-semibold text-red-600 bg-red-100 rounded-full">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right space-x-2">
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                        class="text-indigo-600 hover:text-indigo-800 font-medium">Edit</a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
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
