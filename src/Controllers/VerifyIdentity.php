<?php
declare(strict_types=1);

namespace Viezel\OTP\Controllers;

use Illuminate\Http\Request;
use Viezel\OTP\Actions\SendVerifyIdentityEmailAction;
use Viezel\OTP\OTP;

class VerifyIdentity
{
    public function __invoke(Request $request)
    {
        $url = request()->getUri();
        $email = auth()->user()->email;

        if (OTP::shouldGenerateCode($url)) {
            (new SendVerifyIdentityEmailAction)->handle($email, $url);
        }

        return view('otp::verify-identity');
    }
}
