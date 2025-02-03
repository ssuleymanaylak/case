<?php

// app/Http/Controllers/Api/LocationController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\YukatechtestRequest;
use App\Services\YukatechtestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class YukatechtestController extends Controller
{
    protected YukatechtestService $locationService;

    public function __construct(YukatechtestService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function store(YukatechtestRequest $request): JsonResponse
    {
        $location = $this->locationService->createLocation($request->validated());
        return response()->json(['message' => 'Location added!', 'data' => $location], 201);
    }

    public function index(): JsonResponse
    {
        return response()->json($this->locationService->getAllLocations());
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->locationService->getLocationById($id));
    }

    public function update(YukatechtestRequest $request, $id): JsonResponse
    {
        $location = $this->locationService->updateLocation($id, $request->validated());
        return response()->json(['message' => 'Location updated!', 'data' => $location]);
    }

    public function route(Request $request): JsonResponse
    {
        $lat = $request->query('lat');
        $lng = $request->query('lng');

        if (!$lat || !$lng) {
            return response()->json(['error' => 'Latitude and longitude are required'], 400);
        }

        return response()->json($this->locationService->getSortedLocationsByDistance($lat, $lng));
    }
}
