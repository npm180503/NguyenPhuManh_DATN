<!-- Copy mã này thay cho view register hiện tại của bạn -->

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng ký - PMSTORE</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
        }
        .bg-grid {
            background-image:
                radial-gradient(rgba(255, 255, 255, 0.06) 1px, transparent 1px),
                linear-gradient(135deg, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.02));
            background-size: 14px 14px, 100% 100%;
        }
        .glass {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            background: rgba(255, 255, 255, 0.85);
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-600 bg-grid">
    <div class="min-h-screen flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-5xl">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 rounded-3xl overflow-hidden shadow-2xl">

                <!-- Brand panel (giữ giống login) -->
                <div class="hidden lg:block relative bg-gradient-to-br from-white to-gray-50">
                    <div class="absolute inset-0 opacity-40"
                        style="background-image: radial-gradient(circle at 20% 20%, #c7d2fe 0, transparent 40%), radial-gradient(circle at 80% 30%, #fde68a 0, transparent 45%), radial-gradient(circle at 30% 80%, #a7f3d0 0, transparent 40%);">
                    </div>

                    <div class="relative h-full flex flex-col justify-between p-10">
                        <div class="flex items-center gap-3">
                            <div class="h-12 w-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white text-2xl font-bold">
                                <img src="/template/admin/dist/img/download.jpg" alt="">
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">PMSTORE</h2>
                                <p class="text-gray-500">Sneakers & Streetwear</p>
                            </div>
                        </div>

                        <div class="flex-1 flex items-center justify-center">
                            <p class="text-gray-600 text-center px-6">“Tham gia cùng hàng nghìn thành viên đang nhận ưu đãi mỗi ngày!”</p>
                        </div>

                        <div class="text-gray-600 text-sm text-center">Bảo mật & quyền riêng tư cam kết 100%</div>
                    </div>
                </div>

                <!-- Form panel -->
                <div class="glass p-8 sm:p-10 bg-white">
                    <h1 class="text-2xl font-bold text-gray-900 text-center lg:text-left">Tạo tài khoản mới ✨</h1>
                    <p class="text-gray-500 text-sm mt-1 text-center lg:text-left">Bắt đầu hành trình của bạn tại <span class="font-semibold">PMSTORE</span></p>

                    <form action="{{ route('fr.post.register') }}" method="POST" class="mt-6 space-y-5">
                        @csrf

                        <div>
                            <label class="block text-gray-700 mb-1 font-medium">Tên</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring focus:ring-blue-300">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-1 font-medium">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring focus:ring-blue-300">
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-1 font-medium">Mật khẩu</label>
                            <input type="password" name="password" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring focus:ring-blue-300">
                            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition shadow-lg font-semibold">
                            Đăng ký
                        </button>
                    </form>

                    <p class="text-center text-sm text-gray-600 mt-8">
                        Đã có tài khoản?
                        <a href="{{ route('fr.login') }}" class="text-blue-600 hover:underline font-medium">Đăng nhập</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Đăng ký thành công!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Đăng nhập'
        }).then(() => {
            window.location.href = "{{ route('fr.login') }}";
        });
    </script>
    @endif
</body>

</html>
