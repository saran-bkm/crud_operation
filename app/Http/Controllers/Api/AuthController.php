<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SendWelcomeMailJob;
use App\Jobs\SendOtpJob;
use App\Models\EmailOtp;
use Carbon\Carbon;

class AuthController extends Controller
{
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:customers,email',
            'phone'   => 'required|string|unique:customers,phone',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $Customer = Customer::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'   => $request->phone,
        ]);

        $this->sendMail($Customer->email, $Customer->name);

        

        return response()->json([
            'status' => true,
            'message' => 'Registered Successfully',
            'Customer' => $Customer
        ], 200);
    }

    public function sendMail($email, $name)
    {
        $data = [
            'title' => 'Welcome to Our Service 🎉',
            'body' => "Hi $name,\n\nThank you for registering with us! We're excited to have you on board.\n\nIf you ever need help, feel free to reach out.\n\nBest regards,\nTeam Support"
        ];

        dispatch(new SendWelcomeMailJob($email, $data));
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $otp = rand(100000, 999999);

        EmailOtp::updateOrCreate(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(5)
            ]
        );


        dispatch(new SendOtpJob($request->email, $otp));

        return response()->json([
            'message' => 'OTP sent successfully!'
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required'
        ]);

        $otpData = EmailOtp::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$otpData) {
            return response()->json(['message' => 'Invalid or expired OTP'], 401);
        }

        $otpData->delete();

        $Customer = Customer::where('email',$request->email)->first();

        $token = $Customer->createToken('CustomerToken')->plainTextToken;

        return response()->json([
            'message' => 'OTP Verified Successfully!',
            'data'=>$Customer,
            'token'=>$token
        ]);
    }

}
