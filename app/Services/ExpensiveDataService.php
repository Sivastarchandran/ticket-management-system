<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class ExpensiveDataService
{
    public function getExpensiveData()
    {
        return Cache::remember('expensive_data', 120, function () {
            // Perform the expensive computation or API call
            return $this->performExpensiveComputation();
        });
    }

    private function performExpensiveComputation()
    {
        // Example computation or API call
        return ['data' => 'computed value'];
    }
}
