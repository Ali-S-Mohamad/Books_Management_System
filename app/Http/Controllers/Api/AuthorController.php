<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\AuthorService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Author\StoreAuthorRequest;
use App\Http\Requests\Author\UpdateAuthorRequest;

class AuthorController extends Controller
{
    protected AuthorService $service;
    public function __construct(AuthorService $service)
    {
        $this->middleware('auth:sanctum');
        $this->service = $service;
    }
    public function index()
    {
        return response()->json($this->service->list());
    }
    public function store(StoreAuthorRequest $request)
    {
        $author = $this->service->store($request->validated());
        return response()->json($author, Response::HTTP_CREATED);
    }
    public function show($id)
    {
        return response()->json($this->service->find($id));
    }
    public function update(UpdateAuthorRequest $request, $id)
    {
        $author = $this->service->update($id, $request->validated());
        return response()->json($author);
    }
    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
