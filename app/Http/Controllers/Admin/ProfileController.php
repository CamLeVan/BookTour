<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function edit(Request $request): View
    {
        return view('admin.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(AdminProfileUpdateRequest $request): RedirectResponse
    {
        try {
            $user = $request->user();
            $validated = $request->validated();

            // Chỉ cập nhật avatar nếu có file mới
            if ($request->hasFile('photo')) {
                try {
                    $avatarName = time() . '-' . Str::slug(pathinfo($request->photo->getClientOriginalName(), PATHINFO_FILENAME))
                        . '.' . $request->photo->getClientOriginalExtension();

                    File::ensureDirectoryExists(public_path('frontend/img/users'), 0777);

                    // Delete old avatar if exists
                    if ($user->avatar && File::exists(public_path($user->avatar))) {
                        File::delete(public_path($user->avatar));
                    }

                    File::copy(
                        $request->photo->getRealPath(),
                        public_path('frontend/img/users/' . $avatarName)
                    );

                    $validated['avatar'] = 'frontend/img/users/' . $avatarName;
                } catch (\Exception $e) {
                    Log::error('Lỗi xử lý avatar: ' . $e->getMessage());
                    return redirect()->back()->with('error', 'Không thể lưu ảnh avatar');
                }
            } else {
                // Nếu không có file mới, giữ nguyên avatar cũ
                unset($validated['avatar']); // Loại bỏ avatar khỏi validated data nếu không có file mới
            }

            $user->fill($validated);
            $user->save();

            return redirect()->back()->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            Log::error('Lỗi cập nhật profile: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật profile');
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/admin/login');
    }
}
