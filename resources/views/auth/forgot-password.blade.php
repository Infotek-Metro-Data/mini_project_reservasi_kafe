<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Reservasi Cafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 50%, #43e97b 100%);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="max-w-md w-full">

        <div class="mb-6">
            <a href="{{ route('login') }}" class="inline-flex items-center text-white hover:text-blue-200 transition duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Login
            </a>
        </div>


        <div class="text-center mb-8">
            <div class="inline-block bg-gradient-to-br from-blue-500 to-green-500 p-4 rounded-2xl shadow-2xl mb-4">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2">Lupa Password?</h1>
            <p class="text-blue-100">Jangan khawatir, kami akan membantu Anda</p>
        </div>

 
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-green-500 px-8 py-6">
                <h2 class="text-2xl font-bold text-white">Reset Password</h2>
            </div>
            
            <div class="p-8">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium">{{ $errors->first() }}</span>
                        </div>
                    </div>
                @endif

                <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <p class="text-sm text-blue-800">
                        Masukkan alamat email Anda dan kami akan mengirimkan link untuk mereset password Anda.
                    </p>
                </div>

                <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                </svg>
                            </div>
                            <input type="email" name="email" value="{{ old('email') }}" 
                                class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200" 
                                placeholder="nama@email.com"
                                required>
                        </div>
                    </div>

                    <button type="submit" 
                        class="w-full bg-gradient-to-r from-blue-500 to-green-500 hover:from-blue-600 hover:to-green-600 text-white font-bold py-3 px-4 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-300 transform transition duration-200 hover:scale-[1.02] shadow-lg">
                        <span class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Kirim Link Reset Password
                        </span>
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-600">Ingat password Anda? 
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-bold">
                            Login di sini
                        </a>
                    </p>
                </div>
            </div>
        </div>

       
        <div class="mt-6 bg-white/10 backdrop-blur-md rounded-2xl shadow-xl p-6 border border-white/20">
            <div class="flex items-start text-white">
                <svg class="w-6 h-6 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                </svg>
                <div>
                    <p class="font-bold mb-1">Butuh Bantuan?</p>
                    <p class="text-sm text-blue-100">Jika Anda mengalami kesulitan, silakan hubungi administrator sistem untuk bantuan lebih lanjut.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>