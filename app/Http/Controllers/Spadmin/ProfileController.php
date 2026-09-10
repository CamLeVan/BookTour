<?php

namespace App\Http\Controllers\Spadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        try {
            $user = $request->user();

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
            ]);

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                try {
                    $avatarName = time() . '-' . Str::slug(pathinfo($request->avatar->getClientOriginalName(), PATHINFO_FILENAME))
                        . '.' . $request->avatar->getClientOriginalExtension();

                    // Ensure directory exists
                    File::ensureDirectoryExists(public_path('frontend/img/users'), 0777);

                    // Delete old avatar if exists
                    if ($user->avatar && File::exists(public_path($user->avatar))) {
                        File::delete(public_path($user->avatar));
                    }

                    // Save new avatar
                    File::copy(
                        $request->avatar->getRealPath(),
                        public_path('frontend/img/users/' . $avatarName)
                    );

                    $user->avatar = 'frontend/img/users/' . $avatarName;

                } catch (\Exception $e) {
                    Log::error('Lỗi xử lý avatar: ' . $e->getMessage());
                    return redirect()->back()->with('error', 'Không thể lưu ảnh avatar');
                }
            }

            $user->name = $validated['name'];
            $user->phone = $validated['phone'];
            $user->save();

            return redirect()->back()->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            Log::error('Lỗi cập nhật profile: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật profile');
        }
    }

    public function edit(Request $request): View
    {
        return view('spadmin.profile.edit', [
            'user' => $request->user(),
        ]);
    }
}