<?php

namespace App\Observers;

use App\Models\Company;
use Illuminate\Support\Facades\DB;

/**
 *
 */
class CompanyObserver
{
    /**
     * Handle the Company "creating" event.
     */
    public function creating(Company $company): void
    {
    }

    /**
     * Handle the Company "updating" event.
     */
    public function updating(Company $company): void
    {
    }

    /**
     * @param Company $company
     * @return void
     */
    private function createUpdateCordinates(Company $company): void
    {
    }
}
