<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Mail\Websitemail;
use Illuminate\Http\Request;
use App\Jobs\SendVerificationEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Front\AuthRegisterRequest;

class AuthController extends Controller
{
    public function registration()
    {
        return view('front.registration');
    }



    public function registration_submit(AuthRegisterRequest $request)
    {
        $token = hash('sha256', time());
        $verification_link = route('registration_verify', ['email' => $request->email, 'token' => $token]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'token' => $token,
        ]);

        $subject = 'User Account Verification';
        SendVerificationEmail::dispatch($user->email, $subject, $verification_link)->onQueue('emails');

        return redirect()->back()->with('success', 'Registration is Successful, verify your email to login. it may take few seconds to get the email.');
    }

    public function registration_verify($email, $token)
    {
        $user = User::where('token', $token)->where('email', $email)->first();
        if (!$user) {
            return redirect()->route('login');
        }
        $user->token = '';
        $user->status = 1;
        $user->update();

        return redirect()->route('login')->with('success', 'Your email is verified. You can login now.');
    }

    public function login()
    {
        return view('front.login');
    }

    public function login_submit(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $data = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        if (Auth::guard('web')->attempt($data)) {
            return redirect()->route('user.dashboard')->with('success', 'Login is successful!');
        } else {
            return redirect()->route('login')->with('error', 'The information you entered is incorrect! Please try again!')->withInput();
        }
    }


    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('success', 'Logout is successful!');
    }

    public function forget_password()
    {
        return view('front.forget-password');
    }

    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Email is not found!');
        }

        $token = hash('sha256', time());
        $user->token = $token;
        $user->update();

        $reset_link = route('reset_password', ['token' => $token, 'email' => $request->email]);
        $subject = "Password Reset";
        $message = "To reset password, please click on the link below:<br>";
        $message .= "<a href='" . $reset_link . "'>Click Here</a>";

        Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()->back()->with('success', 'We have sent a password reset link to your email');
    }

    public function reset_password($token, $email)
    {
        $user = User::where('email', $email)->where('token', $token)->first();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Token or email is not correct!');
        }
        return view('front.reset-password', compact('token', 'email'));
    }

    public function reset_password_submit(Request $request, $token, $email)
    {
        $request->validate([
            'password' => ['required'],
            'retype_password' => ['required', 'same:password'],
        ]);

        $user = User::where('email', $request->email)->where('token', $request->token)->first();
        $user->password = Hash::make($request->password);
        $user->token = "";
        $user->update();

        return redirect()->route('login')->with('success', 'Password reset is successful. You can login now.');
    }
}
