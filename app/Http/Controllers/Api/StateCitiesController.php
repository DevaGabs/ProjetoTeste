<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StateCitiesRequest;
use Illuminate\Http\Request;
use App\Repositories\StateCitiesRepository;
use Illuminate\Http\JsonResponse;

/**
 *
 */
class StateCitiesController extends Controller
{
    /**
     * @var StateCitiesRepository
     */
    private StateCitiesRepository $stateCitiesRepository;

    /**
     * @param StateCitiesRepository $stateCitiesRepository
     */
    public function __construct(StateCitiesRepository $stateCitiesRepository)
    {
        $this->stateCitiesRepository = $stateCitiesRepository;
    }

    /**
     * @return JsonResponse
     */
    public function states(): mixed
    {
        return response()->json($this->stateCitiesRepository->states());
    }
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function cities(Request $request): JsonResponse
    {
        $stateId = $request->input('state_id') ?? null;
        try{
            return response()->json($this->stateCitiesRepository->cities($stateId));
        } catch (\Exception $e) {

            return $this->checkStatusCodeError($e);
        }
    }
    /**
     * @param StateCitiesRequest $request
     * @return JsonResponse
     */
    public function city(StateCitiesRequest $request): JsonResponse
    {
        $latitude = $request->input('latitude') ?? null;
        $longitude = $request->input('longitude') ?? null;

        try{
            return response()->json($this->stateCitiesRepository->city($latitude, $longitude));
        } catch (\Exception $e) {
            return $this->checkStatusCodeError($e);
        }
    }
}
