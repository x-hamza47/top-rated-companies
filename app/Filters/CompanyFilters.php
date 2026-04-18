<?php
namespace App\Filters;
use App\Http\Requests\CompanyFilterRequest;

class CompanyFilters{
    public function __construct(protected CompanyFilterRequest $request) {}

    public function apply($query){
        return $query
                ->filterDetails(
                    $this->request->only(['location', 'budget', 'hourly'])
                )
                ->filterAdditionalServices($this->request->get('services'));
    }

}