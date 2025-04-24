<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\CopyService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Copy\StoreCopyRequest;
use App\Http\Requests\Copy\UpdateCopyRequest;
use Symfony\Component\HttpFoundation\Response;

class CopyController extends Controller
{
    protected CopyService $service;
    public function __construct(CopyService $service)
    {
        $this->middleware('auth:sanctum');
        $this->service = $service;
    }
    public function index()
    {
        return response()->json($this->service->list());
    }
    public function store(StoreCopyRequest $request)
    {
        $copy = $this->service->store($request->validated());
        return response()->json($copy, Response::HTTP_CREATED);
    }
    public function show($id)
    {
        return response()->json($this->service->find($id));
    }
    public function update(UpdateCopyRequest $request, $id)
    {
        $copy = $this->service->update($id, $request->validated());
        return response()->json($copy);
    }
    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
