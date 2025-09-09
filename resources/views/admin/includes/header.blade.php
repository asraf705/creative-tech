<header class="flex items-center justify-between bg-white border-b border-gray-200 px-6 h-16 flex-shrink-0">

    <!-- Mobile menu button -->
    <button id="sidebarToggle" aria-label="Toggle sidebar"
        class="md:hidden text-gray-500 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Search bar -->
    <div class="flex-1 max-w-lg mx-6 hidden sm:block">
        <label for="search" class="sr-only">Search</label>
        <div class="relative text-gray-400 focus-within:text-indigo-600">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                </svg>
            </div>
            <input id="search" name="search"
                class="block w-full bg-gray-100 rounded-md py-2 pl-10 pr-3 text-sm placeholder-gray-500 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:text-gray-900"
                placeholder="Search..." type="search" />
        </div>
    </div>

    <!-- Profile & Logout -->
    <div class="flex items-center space-x-4">
        <button aria-label="Profile"
            class="flex items-center space-x-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-md">
            <img src="https://i.pravatar.cc/32" alt="Profile" class="w-8 h-8 rounded-full object-cover" />
            <span class="hidden sm:block text-gray-700 font-medium">Admin</span>
        </button>
        <button aria-label="Logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="text-gray-500 hover:text-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 rounded-md transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
            </svg>
        </button>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>

    </div>
</header>
