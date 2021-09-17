<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3'],
            'perangkat' => ['required']
        ]);

        $data['password'] = Hash::make($request->password);
        $data['level'] = $request->level ?? false;

        $user = User::create($data);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $accessToken = Auth::user()->createToken($request->perangkat)->plainTextToken;

        return response()->json([
            'message' => 'success',
            'data' => $user,
            'meta' => [
            'token' => $accessToken
            ]
        ], Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'perangkat' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'message' => ['The provided credentials are incorrect.'],
            ]);
        }

        $accessToken = $user->createToken($request->perangkat)->plainTextToken;

        return response()->json([
            'message' => 'success',
            'data' => $user,
            'meta' => [
            'token' => $accessToken
            ]
        ], Response::HTTP_CREATED);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'log out berhasil'
        ], Response::HTTP_OK);
    }
}