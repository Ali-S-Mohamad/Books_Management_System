<?php

namespace App\Http\Controllers\Api;

use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Services\PublisherService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Publisher\StorePublisherRequest;
use App\Http\Requests\Publisher\UpdatePublisherRequest;

class PublisherController extends Controller
{
    protected PublisherService $service;
    public function __construct(PublisherService $service) {
        $this->middleware('auth:sanctum');
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->getAll());
    }

    public function store(StorePublisherRequest $request)
    {
        return response()->json($this->service->store($request->validated()), 201);
    }

    public function update(UpdatePublisherRequest $request, Publisher $publisher)
    {
        return response()->json($this->service->update($publisher, $request->validated()));
    }

    public function destroy(Publisher $publisher)
    {
        $this->service->delete($publisher);
        return response()->json(['message' => 'Publisher deleted successfully']);
    }
}
