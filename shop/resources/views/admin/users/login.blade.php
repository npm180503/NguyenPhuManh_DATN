<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.head')
</head>

<body
    class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 via-gray-800 to-black font-sans">
    <div class="bg-white/10 backdrop-blur-lg shadow-2xl rounded-3xl p-8 w-full max-w-md border border-white/20">
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <img src="/template/admin/dist/img/download.jpg" alt="PMSTORE" class="w-16 h-16 rounded-full shadow-lg">
            </div>
            <h1 class="text-3xl font-extrabold text-white tracking-wide">PMSTORE</h1>
            <p class="text-gray-300 text-sm mt-2">Đăng nhập để tiếp tục hành trình của bạn</p>
        </div>

        @include('admin.alert')

        <form action="/admin/users/login/store" method="post" class="space-y-6">
            @csrf
            <div class="relative">
                <input type="email" name="email" placeholder="Email"
                    class="w-full bg-white/10 text-white placeholder-gray-400 px-4 py-3 rounded-lg outline-none focus:ring-2 focus:ring-indigo-400 transition" />
                <span class="absolute right-4 top-3.5 text-gray-400">
                    <i class="fas fa-envelope"></i>
                </span>
            </div>

            <div class="relative">
                <input type="password" name="password" placeholder="Mật khẩu"
                    class="w-full bg-white/10 text-white placeholder-gray-400 px-4 py-3 rounded-lg outline-none focus:ring-2 focus:ring-indigo-400 transition" />
                <span class="absolute right-4 top-3.5 text-gray-400">
                    <i class="fas fa-lock"></i>
                </span>
            </div>

            <div class="flex items-center justify-between text-sm text-gray-300">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="accent-indigo-500 mr-2">
                    Nhớ đăng nhập
                </label>
                <a href="#" class="text-indigo-400 hover:text-indigo-300 transition">Quên mật khẩu?</a>
            </div>

            <button type="submit"
                class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-3 rounded-lg shadow-lg transition transform hover:-translate-y-1 hover:shadow-indigo-700">
                Đăng nhập
            </button>
        </form>

        <div class="mt-6 text-center text-gray-400 text-sm">
            <p>Chưa có tài khoản? <a href="#" class="text-indigo-400 hover:text-indigo-300 font-medium">Đăng ký
                    ngay</a></p>
        </div>
    </div>

    <footer class="absolute bottom-4 text-center w-full text-gray-500 text-xs">
        © 2025 PMSTORE. All rights reserved.
    </footer>

    {{-- FontAwesome --}}
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
</body>


</html>
