<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authenticate with Google</title>
    <!-- Tailwind CSS (Pastikan sudah di-setup jika menggunakan Tailwind) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-2xl font-semibold text-center mb-4">Login with Google</h1>
            <p class="text-center mb-4">Please click the button below to authenticate with your Google account and grant access to Google Drive.</p>
            
            <!-- Tombol login Google -->
            <div class="flex justify-center">
                <a href="{{ $authUrl }}" class="px-6 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition duration-200">
                    Login with Google
                </a>
            </div>

            <!-- Pesan error jika ada -->
            @if(session('error'))
                <div class="mt-4 text-red-500 text-center">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
</body>
</html>
