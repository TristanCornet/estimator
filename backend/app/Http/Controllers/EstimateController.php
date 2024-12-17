<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertEstimateRequest;
use App\Models\Estimate;
use App\Services\EstimateService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EstimateController extends Controller
{
    /**
     * Get all the estimates and load the lines.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return Estimate::orderby('created_at', 'desc')->with('lines')->get();
    }

    /**
     * Store a newly created estimate in the database.
     *
     * @param UpsertEstimateRequest $request
     * @param EstimateService $service
     * @return Estimate
     */
    public function store(UpsertEstimateRequest $request, EstimateService $service): Estimate
    {
        // The validation is done by the request class.
        $estimate = $service->create($request->all());
        return $estimate->load('lines');
    }

    /**
     * Get the specified estimate and load the lines.
     *
     * @param Estimate $estimate
     * @return Estimate
     */
    public function show(Estimate $estimate): Estimate
    {
        return $estimate->load('lines');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        return response()->json(["name" => "PUT|PATCH /api/estimates/{estimate} : Mise à jour d'une estimation."]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        return response()->json(["name" => "DELETE /api/estimates/{estimate} : Suppression d'une estimation."]);
    }
}
