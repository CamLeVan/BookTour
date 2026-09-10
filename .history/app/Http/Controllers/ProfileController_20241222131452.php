<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(ProfileUpdateRequest $request)
    {
        try {
            $user = $request->user();
            $user->fill($request->validated());
    
            if ($request->hasFile('avatar')) {
                if ($user->avatar) {
                    $oldPath = public_path($user->avatar);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
    
                $avatar = $request->file('avatar');
                $filename = time() . '_' . $user->id . '.' . $avatar->getClientOriginalExtension();
    
                $avatar->move(public_path('assets/images/users'), $filename);
                $user->avatar = 'assets/images/users/' . $filename;
            }
    
            // Kiểm tra nếu email thay đổi
            if ($user->isDirty('email')) {
                $user->email_verified_at = null; // Đặt lại xác minh email
                $user->sendEmailVerificationNotification(); // Gửi email xác minh địa chỉ email mới
            }
    
            $user->save();
    
            // Phản hồi AJAX
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Cập nhật thông tin thành công. Vui lòng xác minh email mới.',
                    'user' => $user
                ]);
            }
    
            // Chuyển hướng nếu không phải AJAX
            return redirect('/')->with('success', 'Cập nhật thành công. Vui lòng xác minh email mới.');
    
        } catch (\Exception $e) {
            // Xử lý lỗi khi có lỗi trong quá trình cập nhật
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cập nhật thông tin thất bại',
                    'errors' => $e->getMessage()
                ], 422);
            }
            return back()->withErrors(['error' => 'Cập nhật thông tin thất bại']);
        }
    }
    
    public function destroy(Request $request)
    {
        try {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);

            $user = $request->user();
            Auth::logout();
            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Account deleted successfully',
                    'redirect' => '/'
                ]);
            }

            return redirect('/');

        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to delete account'
                ], 422);
            }
            return back()->withErrors(['error' => 'Failed to delete account']);
        }
    }
}
