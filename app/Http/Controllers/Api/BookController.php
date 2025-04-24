<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\BookService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    protected BookService $service;
    public function __construct(BookService $service)
    {
        $this->middleware('auth:sanctum');
        $this->service = $service;
    }
    public function index()
    {
        return response()->json($this->service->list());
    }
    public function store(StoreBookRequest $request)
    {
        $book = $this->service->store($request->validated());
        return response()->json($book, Response::HTTP_CREATED);
    }
    public function show($id)
    {
        return response()->json($this->service->find($id));
    }
    public function update(UpdateBookRequest $request, $id)
    {
        $book = $this->service->update($id, $request->validated());
        return response()->json($book);
    }
    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
