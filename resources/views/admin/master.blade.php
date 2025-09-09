<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title') | Test</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/resources/css/app.css">
</head>

<body class="bg-gray-100 flex h-screen overflow-hidden font-sans antialiased">

    <!-- Sidebar -->
    @include('admin.includes.sider')

    <!-- Main content wrapper -->
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- Header -->
        @include('admin.includes.header')

        <!-- Main content -->
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>

    <script>
        const sidebar = document.getElementById("sidebar");
        const toggleBtn = document.getElementById("sidebarToggle");

        toggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("-translate-x-full");
        });

        function toggleMenu(menuId, btn) {
            const menu = document.getElementById(menuId);
            menu.classList.toggle("hidden");
            btn.querySelector("svg:last-child").classList.toggle("rotate-180");
        }

        document.querySelector('[aria-label="Logout"]').addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm("Are you sure you want to log out?")) {
                document.getElementById('logout-form').submit();
            }
        });
    </script>

</body>

</html>
