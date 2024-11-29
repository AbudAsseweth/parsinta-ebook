<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    public function notice(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended("/");
        }
        return view('auth.verify-email');
    }

    public function resendEmailVerification(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended("/");
        }

        $request->user()->sendEmailVerificationNotification();

        return back();
    }
}
