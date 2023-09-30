<?php

namespace App\Singletons;

use App\Models\Service;

class AnalyticsSingleton
{
        public function makeHit(
        string $modelName,
        int    $modelId,
        string $analyticDataType,
        ?int   $userId = null
    ): void
    {
//        dd('make hit', $modelName, $modelId, $analyticDataType, $userId);
        // if model name is service and is a view
        if ($modelName === 'Service' && $analyticDataType === 'view') {
            // make a service hit
            $this->makeServiceHit($modelId, $userId);
        }

    }

    private function makeServiceHit(int $serviceId, ?int $userId = null): void
    {
//        dd('make service hit', $serviceId, $userId);
        $serviceHit = new \App\Models\ServiceHit();
        $serviceHit->service_id = $serviceId;
        $serviceHit->hit_time = now();
        $serviceHit->analytic_data_type = 'view';
        $serviceHit->user_id = $userId;
        $serviceHit->save();

    }



}
