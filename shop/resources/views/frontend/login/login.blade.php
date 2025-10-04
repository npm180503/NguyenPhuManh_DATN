<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng nhập - PMSTORE</title>

    {{-- Tailwind 2.x --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    {{-- Inter font cho cảm giác hiện đại hơn --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- jQuery + SweetAlert2 --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- CSRF for AJAX --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, 'Apple Color Emoji', 'Segoe UI Emoji';
        }

        /* Họa tiết subtle background */
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

        .focus-ring:focus {
            box-shadow: 0 0 0 4px rgba(37, 99, 235, .25);
            outline: none;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-600 bg-grid">
    <div class="min-h-screen flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-5xl">
            <!-- Card -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 rounded-3xl overflow-hidden shadow-2xl">
                <!-- Brand / Visual panel -->
                <div class="hidden lg:block relative bg-gradient-to-br from-white to-gray-50">
                    <div class="absolute inset-0 opacity-40"
                        style="background-image: radial-gradient(circle at 20% 20%, #c7d2fe 0, transparent 40%), radial-gradient(circle at 80% 30%, #fde68a 0, transparent 45%), radial-gradient(circle at 30% 80%, #a7f3d0 0, transparent 40%);">
                    </div>
                    <div class="relative h-full flex flex-col justify-between p-10">
                        <div class="flex items-center gap-3">
                            <div
                                class="h-12 w-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white text-2xl font-bold">
                                <img src="/template/admin/dist/img/download.jpg" alt="">
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">PMSTORE</h2>
                                <p class="text-gray-500">Sneakers & Streetwear</p>
                            </div>
                        </div>

                        <div class="flex-1 flex items-center justify-center">
                            <!-- “Minh họa” sneaker -->
                            <svg viewBox="0 0 512 512" class="w-3/4 drop-shadow-xl">
                                <defs>
                                    <linearGradient id="g1" x1="0" y1="0" x2="1"
                                        y2="1">
                                        <stop offset="0%" stop-color="#6366f1" />
                                        <stop offset="100%" stop-color="#8b5cf6" />
                                    </linearGradient>
                                    <linearGradient id="g2" x1="0" y1="0" x2="1"
                                        y2="0">
                                        <stop offset="0%" stop-color="#06b6d4" />
                                        <stop offset="100%" stop-color="#22d3ee" />
                                    </linearGradient>
                                </defs>
                                <path
                                    d="M60 300c40 10 95 10 150-30 60-45 80-30 120 0 40 30 90 30 120 20 20 30 20 60-20 80-40 20-120 30-210 30S60 380 40 340c-10-20 0-30 20-40z"
                                    fill="url(#g1)" />
                                <path
                                    d="M110 290c30 5 70 5 110-20 40-25 55-20 85 0 30 20 70 20 95 10 8 12 8 24-10 32-28 14-92 22-160 22s-120-10-136-24c-6-6-2-12 16-20z"
                                    fill="white" opacity=".9" />
                                <circle cx="190" cy="330" r="10" fill="url(#g2)" />
                                <circle cx="240" cy="330" r="10" fill="url(#g2)" />
                                <circle cx="290" cy="330" r="10" fill="url(#g2)" />
                            </svg>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 2a5 5 0 015 5v1h1a3 3 0 013 3v6a5 5 0 01-5 5H8a5 5 0 01-5-5v-6a3 3 0 013-3h1V7a5 5 0 015-5zm0 2a3 3 0 00-3 3v1h6V7a3 3 0 00-3-3z" />
                                </svg>
                                Bảo vệ tài khoản & giao dịch an toàn
                            </div>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M3 3h18v2H3V3zm0 6h18v8a2 2 0 01-2 2H5a2 2 0 01-2-2V9zm4 2v6h2v-6H7zm4 0v6h2v-6h-2zm4 0v6h2v-6h-2z" />
                                </svg>
                                Kiểm tra đơn & lịch sử mua dễ dàng
                            </div>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 8a4 4 0 014 4v6H8v-6a4 4 0 014-4zm0-6a6 6 0 00-6 6v1H4a2 2 0 00-2 2v7a4 4 0 004 4h12a4 4 0 004-4v-7a2 2 0 00-2-2h-2V8a6 6 0 00-6-6z" />
                                </svg>
                                Ưu đãi thành viên & khuyến mại riêng
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form panel -->
                <div class="glass p-8 sm:p-10 bg-white">
                    {{-- Flash error --}}
                    @if (session('error'))
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Đăng nhập thất bại',
                                    text: @json(session('error')),
                                    confirmButtonColor: '#d33',
                                    confirmButtonText: 'Thử lại'
                                });
                            });
                        </script>
                    @endif

                    <div class="mb-6 text-center lg:text-left">
                        <h1 class="text-2xl font-bold text-gray-900">Chào mừng trở lại 👋</h1>
                        <p class="text-gray-500 text-sm mt-1">Đăng nhập để tiếp tục mua sắm tại <span
                                class="font-semibold">PmouShop</span></p>
                    </div>
                    {{-- Divider --}}
                    <div class="flex items-center my-6">
                        <div class="flex-grow h-px bg-gray-200"></div>
                        <span class="px-3 text-gray-400 text-xs uppercase tracking-wider">hoặc</span>
                        <div class="flex-grow h-px bg-gray-200"></div>
                    </div>

                    <form id="login-form" class="space-y-5" novalidate>
                        @csrf
                        <input type="hidden" name="_fallback" value="ajax" />

                        @php $redirect = request('redirect'); @endphp
                        @if ($redirect)
                            <input type="hidden" name="redirect" value="{{ $redirect }}">
                        @endif

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-gray-700 mb-1 font-medium">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                autocomplete="username email"
                                class="focus-ring w-full px-4 py-3 border border-gray-200 rounded-xl placeholder-gray-400 focus:border-blue-500"
                                placeholder="you@example.com" required />
                            <p id="email-error" class="text-red-600 text-sm mt-1 hidden"></p>
                        </div>

                        {{-- Password --}}
                        <div>
                            <label for="password" class="block text-gray-700 mb-1 font-medium">Mật khẩu</label>
                            <div class="relative">
                                <input type="password" name="password" id="password" autocomplete="current-password"
                                    class="focus-ring w-full px-4 py-3 border border-gray-200 rounded-xl placeholder-gray-400 focus:border-blue-500 pr-12"
                                    placeholder="••••••••" required />
                                <button type="button" id="toggle-password"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none"
                                    aria-label="Hiện/ẩn mật khẩu">
                                    <!-- Eye icon -->
                                    <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                        viewBox="0 0 24 24" fill="none">
                                        <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7z"
                                            stroke="currentColor" stroke-width="1.8" />
                                        <circle cx="12" cy="12" r="3" stroke="currentColor"
                                            stroke-width="1.8" />
                                    </svg>
                                </button>
                            </div>
                            <p id="password-error" class="text-red-600 text-sm mt-1 hidden"></p>
                        </div>

                        <div class="flex items-center justify-between text-sm">
                            <label class="inline-flex items-center select-none">
                                <input type="checkbox" name="remember" id="remember" class="mr-2 rounded">
                                Ghi nhớ đăng nhập
                            </label>
                            {{-- Bật lại nếu có trang quên mật khẩu --}}
                            {{-- <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline font-medium">
                                Quên mật khẩu?
                            </a> --}}
                        </div>

                        <button type="submit" id="submit-btn"
                            class="w-full bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition flex items-center justify-center gap-2 disabled:opacity-70 shadow-lg">
                            <span class="btn-text font-semibold">Đăng nhập</span>
                            <svg id="btn-spinner" class="animate-spin h-5 w-5 hidden"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4" />
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                            </svg>
                        </button>

                        <p id="global-error" class="text-red-600 text-sm mt-1 hidden"></p>
                    </form>

                    <p class="text-center text-sm text-gray-600 mt-8">
                        Chưa có tài khoản?
                        <a href="{{ route('fr.register') }}" class="text-blue-600 hover:underline font-medium">Đăng
                            ký</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function() {
            const $form = $('#login-form');
            const $submit = $('#submit-btn');
            const $btnText = $submit.find('.btn-text');
            const $spinner = $('#btn-spinner');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Toggle password (đổi icon eye -> eye-off)
            $('#toggle-password').on('click', function() {
                const $pwd = $('#password');
                const type = $pwd.attr('type') === 'password' ? 'text' : 'password';
                $pwd.attr('type', type);

                // thay icon
                const $icon = $(this).find('svg');
                if (type === 'text') {
                    $icon.replaceWith(`
                        <svg id="eye-off" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                          <path d="M17.94 17.94A10.94 10.94 0 0112 19c-6.4 0-10-7-10-7a18.4 18.4 0 013.22-3.93M9.9 4.24A10.88 10.88 0 0112 5c6.4 0 10 7 10 7a18.45 18.45 0 01-4.1 4.66M3 3l18 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    `);
                } else {
                    $icon.replaceWith(`
                        <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                          <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7z" stroke="currentColor" stroke-width="1.8"/>
                          <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8"/>
                        </svg>
                    `);
                }
            });

            // Submit form (giữ nguyên logic bạn đã có)
            $form.on('submit', function(e) {
                e.preventDefault();

                $('#email-error').addClass('hidden').text('');
                $('#password-error').addClass('hidden').text('');
                $('#global-error').addClass('hidden').text('');

                const email = $('#email').val().trim();
                const password = $('#password').val().trim();

                let hasClientError = false;
                if (!email) {
                    $('#email-error').removeClass('hidden').text('Vui lòng nhập email.');
                    hasClientError = true;
                } else if (!/^\S+@\S+\.\S+$/.test(email)) {
                    $('#email-error').removeClass('hidden').text('Email không hợp lệ.');
                    hasClientError = true;
                }
                if (!password) {
                    $('#password-error').removeClass('hidden').text('Vui lòng nhập mật khẩu.');
                    hasClientError = true;
                }
                if (hasClientError) return;

                lockButton(true);
                const payload = $form.serialize();

                $.ajax({
                    url: "{{ route('fr.post.login') }}",
                    method: "POST",
                    data: payload,
                    dataType: "json",
                }).done(function(res) {
                    if (res?.status === 'success') {
                        const to = res.redirect || getRedirectFromQuery() ||
                            "{{ route('fr.homepage') }}";
                        window.location.href = to;
                        return;
                    }
                    showGlobalError('Đăng nhập không thành công. Vui lòng thử lại.');
                }).fail(function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON?.errors || {};
                        if (errors.email?.[0]) $('#email-error').removeClass('hidden').text(errors
                            .email[0]);
                        if (errors.password?.[0]) $('#password-error').removeClass('hidden').text(errors
                            .password[0]);
                        if (!errors.email && !errors.password) showGlobalError(xhr.responseJSON
                            ?.message || 'Thông tin không hợp lệ.');
                        return;
                    }
                    if (xhr.status === 401) {
                        showGlobalError(xhr.responseJSON?.message || 'Email hoặc mật khẩu không đúng.');
                        return;
                    }
                    if (xhr.status === 429) {
                        showGlobalError('Bạn đã thử quá nhiều lần. Vui lòng thử lại sau ít phút.');
                        return;
                    }
                    showGlobalError(xhr.responseJSON?.message ||
                        'Có lỗi xảy ra, vui lòng thử lại sau.');
                }).always(function() {
                    lockButton(false);
                });
            });

            $('#email, #password').on('keypress', function(e) {
                if (e.key === 'Enter') $form.trigger('submit');
            });

            function lockButton(locked) {
                if (locked) {
                    $submit.prop('disabled', true);
                    $btnText.text('Đang xử lý…');
                    $spinner.removeClass('hidden');
                } else {
                    $submit.prop('disabled', false);
                    $btnText.text('Đăng nhập');
                    $spinner.addClass('hidden');
                }
            }

            function showGlobalError(message) {
                $('#global-error').removeClass('hidden').text(message);
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: message,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Đóng'
                });
            }

            function getRedirectFromQuery() {
                const params = new URLSearchParams(window.location.search);
                return params.get('redirect');
            }
        })();
    </script>
</body>

</html>
