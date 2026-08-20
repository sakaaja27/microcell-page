<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microcell - @yield('title', 'Welcome')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans text-slate-900 antialiased" x-data>
    @yield('content')

    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            if(modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            if(modal) {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }
        }
    </script>
</body>
</html>