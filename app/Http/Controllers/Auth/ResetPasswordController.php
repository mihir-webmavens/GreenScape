<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ResetPasswordController extends Controller
{
    // Show the reset password form
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // Handle the reset password logic
    public function reset(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'token' => 'required',
        ]);

        // Check if the token exists in the database
        $passwordReset = DB::table('password_reset_tokens')
            ->where('token', $request->token)
            ->where('email', $request->email)
            ->first();

        if (!$passwordReset) {
            return back()->withErrors(['token' => 'Invalid or expired reset token.']);
        }

        // Update the user's password
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the reset token after successful password reset
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Your password has been reset!');
    }
}
