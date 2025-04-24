<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    protected UserService $service;
    public function __construct(UserService $service)
    {
        $this->middleware('auth:sanctum')->except(['store']);
        $this->service = $service;
    }
    public function index()
    {
        return response()->json($this->service->list());
    }
    public function store(StoreUserRequest $request)
    {
        $user = $this->service->store($request->validated());
        return response()->json($user, Response::HTTP_CREATED);
    }
    public function show($id)
    {
        return response()->json($this->service->find($id));
    }
    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->service->update($id, $request->validated());
        return response()->json($user);
    }
    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
