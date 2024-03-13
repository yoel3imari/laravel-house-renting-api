<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        event(new Registered($user));

        $device = substr($request->userAgent() ?? '', 0, 255);
        $user->token = $user->createToken($device)->plainTextToken;
        return response()->json([
            'message' => 'UserRegisteredSuccessfully',
            'api_token' => $user->token,
            'data' => new UserResource($user),
        ], Response::HTTP_CREATED);

    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $device = substr($request->userAgent() ?? '', 0, 255);
            $user->token = $user->createToken($device)->plainTextToken;
            return response()->json([
                'message' => 'UserLoggedInSuccessfully',
                'api_token' => $user->token,
                'data' => new UserResource($user),
            ], Response::HTTP_OK);
        }

        // Check if the email is incorrect
        if (!Auth::attempt(['email' => $request->email])) {
            return response()->json(['error' => 'EmailNotFound'], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json(['error' => 'IncorrectPassword'], Response::HTTP_UNAUTHORIZED);
    }

    public function verify_token(Request $request)
    {
        return response()->json([
            'message' => 'SessionVerified',
            'api_token' => $request->bearerToken(),
            'data' => new UserResource(Auth::user()),
        ], Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        Auth::guard('web')->logout();
        return response()->json([
            'message' => 'LoggedOutSuccessfully',
            'status' => Response::HTTP_OK,
        ]);
    }
}
