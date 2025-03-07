<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\ResetPasswordEmail;

class ForgotPasswordController extends Controller
{
    // Show the form to request a password reset link
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    // Send the password reset link to the user's email
    public function sendResetLinkEmail(Request $request)
    {
        // Validate the email
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No account found with that email address.']);
        }

        // Create a unique token
        $token = Str::random(60);

        $useremail = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        
        if ($useremail) { 
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        }else{
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
            ]);
        }


        // Send the reset link via email
        Mail::to($user->email)->send(new ResetPasswordEmail($token));

        return view('emails.reset-password',compact('token'));
    }
}
