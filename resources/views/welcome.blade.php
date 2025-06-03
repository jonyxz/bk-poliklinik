<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Poliklinik</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-blue-50 text-gray-800 flex items-center justify-center min-h-screen">
        <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
            <header class="text-center mb-8">
                <h1 class="text-3xl font-bold text-blue-600">Selamat Datang di Poliklinik</h1>
                <p class="text-gray-600 mt-2">Silakan login sebagai dokter atau daftar sebagai pasien untuk memulai.</p>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Login Dokter -->
                <div class="bg-blue-100 p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold text-blue-600">Login sebagai Dokter</h2>
                    <p class="text-gray-600 mt-2">Masuk untuk mengelola jadwal periksa </p>
                    <a href="{{ route('login') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Login Dokter
                    </a>
                </div>

                <!-- Daftar Pasien -->
                <div class="bg-blue-100 p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold text-blue-600">Daftar sebagai Pasien</h2>
                    <p class="text-gray-600 mt-2">Buat akun untuk mendaftar sebagai pasien dan mengakses layanan poliklinik.</p>
                    <a href="{{ route('register') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Daftar Pasien
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
