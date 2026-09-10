<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        try {
            // Log request data để debug
            Log::info('Profile update request:', $request->all());

            $user = $request->user();
            
            // Basic validation
            if (empty($request->name) || empty($request->email)) {
                throw new \Exception('Name and email are required');
            }

            // Update user
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $saved = $user->save();

            if (!$saved) {
                throw new \Exception('Failed to save user');
            }

            Log::info('Profile updated successfully for user: ' . $user->id);

            return response()->json([
                'status' => 'success',
                'message' => 'Cập nhật thông tin thành công!'
            ]);

        } catch (\Exception $e) {
            Log::error('Profile update error: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 422);
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
