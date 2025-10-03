<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Services\About\AboutAdminService;
use App\Http\Services\Menu\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\User;
use App\Http\Services\UploadService;

class UserController extends Controller
{
    // Hiển thị hồ sơ cá nhân
    public function profile(AboutAdminService $aboutAdminService, MenuService $menuService)
    {
        $user = auth('frontend')->user();
        $menus  = $menuService->getParent();
        $abouts = $aboutAdminService->get();

        return view("frontend.user.profile", [
            "user"  => $user,
            "title"  => "Hồ sơ cá nhân",
            'menus'  => $menus,
            'abouts' => $abouts
        ]);
    }

    // Cập nhật hồ sơ cá nhân
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\Customer $user */

        $user = auth('frontend')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'current_password' => 'required_with:password',
            'password' => 'nullable|confirmed|min:6',
        ], [
            'password.confirmed' => 'Mật khẩu mới và xác nhận mật khẩu không trùng nhau!',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'current_password.required_with' => 'Bạn phải nhập mật khẩu cũ để thay đổi mật khẩu mới.',
        ]);


        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Mật khẩu cũ không đúng!']);
            }
            $user->password = Hash::make($request->password);
        }

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $thumb = $user->thumb;

        if ($request->hasFile('thumb')) {
            $fileUploaded = app(UploadService::class)->store($request, "thumb");

            if ($fileUploaded["error"]) {
                throw new \Exception('Không thể upload file');
            }

            $user->thumb = $fileUploaded["url"];
        }


        $user->save();

        return redirect()->route('fr.user.profile')->with('success', 'Cập nhật hồ sơ thành công!');
    }
}
