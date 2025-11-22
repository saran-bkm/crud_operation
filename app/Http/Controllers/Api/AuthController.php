<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SendWelcomeMailJob;

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

        $token = $Customer->createToken('CustomerToken')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Registered Successfully',
            'Customer' => $Customer,
            'access_token' => $token
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

}
