<?php

namespace App\Repositories;

use App\Models\State;
use App\Models\City;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

/**
 *
 */
class StateCitiesRepository
{

    /**
     * @param $uf
     * @return mixed
     */
    public function index($uf = null): mixed
    {
        return State::select('id', 'title', 'letter')->with([
            'cities' => function ($query) {
                $query->select('id', 'state_id', 'title', 'slug');
            }
        ])->when($uf, function ($query, $uf) {
            $query->where('letter', $uf);
        })->get();
    }
    public function states(): mixed
    {
        return State::select('id', 'title', 'letter')->get();
    }
    public function cities($stateId): mixed
    {
        if (!State::find($stateId)) {
            throw new Exception('Estado não encontrado', Response::HTTP_NOT_FOUND);
        }
        return City::select('id', 'state_id', 'title')->when($stateId, function ($query, $stateId) {
            $query->where('state_id', $stateId);
        })->get();
    }
    public function city($latitude, $longitude): mixed
    {
        return City::select('id', 'state_id', 'title')->addSelect(
            DB::raw('ROUND(ST_DISTANCE_SPHERE(POINT(longitude, latitude), POINT(' . $longitude . ', ' . $latitude . ')) / 1000, 2) AS distance')
        )->whereBetween('latitude', [$latitude - 1, $latitude + 1])->whereBetween('longitude', [$longitude - 1, $longitude + 1])->orderBy('distance', 'ASC')->get()->first();
    }
}
