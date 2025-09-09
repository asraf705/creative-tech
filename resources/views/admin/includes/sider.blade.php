<aside id="sidebar"
    class="bg-white w-64 flex-shrink-0 border-r border-gray-200 flex flex-col fixed inset-y-0 left-0 z-40 transform transition-transform duration-300 ease-in-out md:translate-x-0 -translate-x-full md:static md:inset-0 overflow-y-auto">

    <!-- Logo -->
    <div class="flex items-center justify-center h-16 border-b border-gray-200 px-6">
        <h1 class="text-2xl font-bold text-indigo-600">Admin Panel</h1>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2 text-gray-700 text-sm font-medium">

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-indigo-100 hover:text-indigo-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2 7-7 7 7M13 5v6h6" />
            </svg>
            Dashboard
        </a>

        <!-- Reusable Dropdown Component -->
        <div>
            <button onclick="toggleMenu('category-menu', this)"
                class="flex items-center justify-between w-full px-3 py-2 rounded-md hover:bg-indigo-100 hover:text-indigo-700 transition focus:outline-none">
                <span class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    Category
                </span>
                <svg class="h-4 w-4 text-indigo-500 transition-transform" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="category-menu" class="ml-8 mt-1 space-y-1 hidden">
                <a href="{{ route('categories.index') }}"
                    class="block px-3 py-2 rounded-md hover:bg-indigo-100 hover:text-indigo-700 transition">Manage
                    Category</a>
                <a href="{{ route('categories.create') }}"
                    class="block px-3 py-2 rounded-md hover:bg-indigo-100 hover:text-indigo-700 transition">Add
                    Category</a>
            </div>
        </div>

        <div>
            <button onclick="toggleMenu('product-menu', this)"
                class="flex items-center justify-between w-full px-3 py-2 rounded-md hover:bg-indigo-100 hover:text-indigo-700 transition focus:outline-none">
                <span class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20 13V7a2 2 0 00-2-2h-4l-2-2H6a2 2 0 00-2 2v6m12 4a4 4 0 01-8 0" />
                    </svg>
                    Product
                </span>
                <svg class="h-4 w-4 text-indigo-500 transition-transform" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="product-menu" class="ml-8 mt-1 space-y-1 hidden">
                <a href="{{route('products.index')}}"
                    class="block px-3 py-2 rounded-md hover:bg-indigo-100 hover:text-indigo-700 transition">Manage
                    Product</a>
                <a href="{{route('products.create')}}"
                    class="block px-3 py-2 rounded-md hover:bg-indigo-100 hover:text-indigo-700 transition">Add
                    Product</a>
            </div>
        </div>

    </nav>
</aside>
