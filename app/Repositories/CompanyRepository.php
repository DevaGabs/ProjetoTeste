<?php

namespace App\Repositories;

use App\Models\City;
use App\Models\Company;
use Exception;
use Illuminate\Http\Response;

/**
 *
 */
class CompanyRepository extends AbstractRepository
{

    /**
     * @return mixed
     */
    public function model(): mixed
    {
        return Company::class;
    }

    /**
     * @return string
     */
    public function messageErrorNotFound(): string
    {
        return 'Empresa não encontrada';
    }

    /**
     * store
     *
     * @param array $data
     * @return mixed
     */
    public function store(array $data): mixed
    {
        $data['state_id'] = City::find($data['city_id'])->state_id;

        $company = $this->model()::create($data);

        return $company->fresh([
            'category',
            'city',
            'state',
        ]);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data): mixed
    {
        $company = $this->model()::find($id);
        
        if (!$company) {
            throw new Exception($this->messageErrorNotFound(), Response::HTTP_NOT_FOUND);
        }
        
        $data['state_id'] = City::find($data['city_id'])->state_id;
        $updated = $company->update($data);

        return $updated;
    }

    /**
     * @param $id
     * @return string
     * @throws Exception
     */
    public function destroy($id): string
    {
        $company = $this->model()::find($id);

        if (!$company) {
            return throw new Exception($this->messageErrorNotFound(), Response::HTTP_NOT_FOUND);
        }

        $company->delete();

        return 'Empresa removida com sucesso!';
    }

    public function show($id): mixed
    {
        $company = $this->model()::find($id);
        
        if (!$company) {
            throw new Exception($this->messageErrorNotFound(), Response::HTTP_NOT_FOUND);
        }
        
        return $company->fresh([
            'category',
            'city',
            'state',
        ]);
    }
}
