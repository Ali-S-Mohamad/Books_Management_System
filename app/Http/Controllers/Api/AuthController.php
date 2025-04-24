<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    protected AuthService $service;
    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }
    public function register(RegisterRequest $request)
    {
        $user = $this->service->register($request->validated());
        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json(['user' => $user, 'token' => $token], Response::HTTP_CREATED);
    }
    public function login(LoginRequest $request)
    {
        $user = $this->service->login($request->email, $request->password);
        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json(['user' => $user, 'token' => $token], Response::HTTP_OK);
    }
    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
