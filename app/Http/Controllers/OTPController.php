<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

use function Symfony\Component\Clock\now;

class OTPController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
        ]);

        $otp = rand(100000, 999999);
        $expiresAt = Carbon::now()->addMinutes(10);

        Otp::updateOrCreate(
            ['email' => $request->email],
            ['otp' => $otp, 'expires_at' => $expiresAt]
        );

        // Send OTP via email
        Mail::raw("Your OTP is $otp. It will expire at " . $expiresAt->format('H:i:s') . " WIB.", function ($message) use ($request) {
            $message->to($request->email)->subject('Your OTP Code');
        });

        return response()->json(['message' => "OTP sent to {$request->email}"]);
    }
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $otpRecord = Otp::where('email', $request->email)->first();

        if (!$otpRecord || $otpRecord->otp !== $request->otp || Carbon::now()->greaterThan($otpRecord->expires_at)) {
            return response()->json(['message' => 'Invalid or expired OTP.'], 400);
        } else {
            $company = Company::create([
                'nm_company' => $request->nm_company,
                'email' => $request->email,
                'telp' => $request->telp,
                'alamat' => $request->alamat
            ]);

            $register = User::create([
                'company_id' => $company->id,
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'alamat' => $company->alamat,
                'telp' => $company->telp,
                'login' => 'Izinkan',
                'tgl_bergabung' => now(),
                'role' => 'Admin',
            ]);

        }

        return response()->json(['message' => 'OTP verified successfully.'], 200);
    }
}
