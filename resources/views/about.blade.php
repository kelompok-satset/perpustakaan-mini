<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang Pengembang - Pustaka Kampus</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-900 font-sans">

    <nav class="bg-white shadow-sm fixed w-full z-50 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-4">
                    <a href="{{ url('/') }}" class="text-gray-500 hover:text-indigo-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </a>
                    <span class="font-bold text-xl tracking-tight text-gray-800">Tim<span class="text-indigo-600">Pengembang</span></span>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ url('/') }}" class="text-sm font-semibold text-gray-600 hover:text-indigo-600">Home</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-indigo-600 text-white text-sm font-bold rounded-full hover:bg-indigo-700 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 bg-gray-800 text-white text-sm font-bold rounded-full hover:bg-gray-700 transition">Login</a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="pt-32 pb-12 text-center px-4 bg-indigo-700">
        <h1 class="text-4xl font-extrabold text-white mb-4">Meet Our Team</h1>
        <p class="text-indigo-100 text-lg max-w-2xl mx-auto">
            Orang-orang hebat di balik layar yang membangun Sistem Informasi Perpustakaan Kampus ini dengan dedikasi tinggi.
        </p>
    </div>

    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8 -mt-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:-translate-y-2 transition duration-300 text-center p-6 border border-gray-100">
                <img class="w-40 h-40 rounded-full mx-auto object-cover border-4 border-indigo-50 mb-4 shadow-md" 
                     style="width: 150px; height: 150px;"
                     src="{{ asset('images/dev1.jpg') }}" 
                     onerror="this.src='https://ui-avatars.com/api/?name=Pengembang+1&background=6366f1&color=fff&size=128'"
                     alt="Dev 1">
                <h3 class="text-xl font-bold text-gray-900">SYAIFUS SHOLIHIN PUTRA ADITAMA</h3>
                <p class="text-indigo-600 text-sm font-semibold mb-2">Project Manager</p>
                <p class="text-gray-500 text-sm">Bertanggung jawab atas manajemen proyek dan alur sistem.</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:-translate-y-2 transition duration-300 text-center p-6 border border-gray-100">
                <img class="w-40 h-40 rounded-full mx-auto object-cover border-4 border-indigo-50 mb-4 shadow-md" 
                     style="width: 150px; height: 150px;"
                     src="{{ asset('images/dev2.jpg') }}" 
                     onerror="this.src='https://ui-avatars.com/api/?name=Pengembang+2&background=ec4899&color=fff&size=128'"
                     alt="Dev 2">
                <h3 class="text-xl font-bold text-gray-900">RIYAN SUBHAN AKBAR</h3>
                <p class="text-indigo-600 text-sm font-semibold mb-2">Backend Developer</p>
                <p class="text-gray-500 text-sm">Merancang database, API, dan logika server Laravel.</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:-translate-y-2 transition duration-300 text-center p-6 border border-gray-100">
                <img class="w-40 h-40 rounded-full mx-auto object-cover border-4 border-indigo-50 mb-4 shadow-md" 
                     style="width: 150px; height: 150px;"
                     src="{{ asset('images/dev3.jpg') }}" 
                     onerror="this.src='https://ui-avatars.com/api/?name=Pengembang+3&background=10b981&color=fff&size=128'"
                     alt="Dev 3">
                <h3 class="text-xl font-bold text-gray-900">Moh Ferdiansyah Brawijayanto</h3>
                <p class="text-indigo-600 text-sm font-semibold mb-2">Frontend Developer</p>
                <p class="text-gray-500 text-sm">Mengurus tampilan antarmuka pengguna (UI/UX) dan Tailwind.</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:-translate-y-2 transition duration-300 text-center p-6 border border-gray-100">
                <img class="w-40 h-40 rounded-full mx-auto object-cover border-4 border-indigo-50 mb-4 shadow-md" 
                     style="width: 150px; height: 150px;"
                     src="{{ asset('images/dev4.jpg') }}" 
                     onerror="this.src='https://ui-avatars.com/api/?name=Pengembang+4&background=f59e0b&color=fff&size=128'"
                     alt="Dev 4">
                <h3 class="text-xl font-bold text-gray-900">sakinah hidayati</h3>
                <p class="text-indigo-600 text-sm font-semibold mb-2">Quality Assurance</p>
                <p class="text-gray-500 text-sm">Melakukan testing dan memastikan sistem berjalan tanpa bug.</p>
            </div>

        </div>
    </div>

    <footer class="text-center py-8 text-gray-500 text-sm">
        &copy; {{ date('Y') }} Tim Pengembang Pustaka Kampus.
    </footer>

</body>
</html>