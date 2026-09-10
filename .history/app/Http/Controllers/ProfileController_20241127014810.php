<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function update(ProfileUpdateRequest $request)
    {
        try {
            // Validate input
            $validated = $request->validated();
            
            // Sanitize name input to allow Vietnamese characters
            $validated['name'] = htmlspecialchars($validated['name'], ENT_QUOTES, 'UTF-8');
            
            $request->user()->fill($validated);

            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }

            $request->user()->save();

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Profile updated successfully',
                    'redirect' => '/'
                ]);
            }

            return redirect('/')->with('success', 'Profile updated successfully');

        } catch (\Exception $e) {
            \Log::error('Profile update error: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to update profile: ' . $e->getMessage()
                ], 422);
            }
            return back()->withErrors(['error' => 'Failed to update profile']);
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
