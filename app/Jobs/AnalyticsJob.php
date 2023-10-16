<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AnalyticsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public string $model,
        public int    $id,
        public string $analytic_type
    )
    {

    }

    public function handle(): void
    {
        resolve(\App\Singletons\AnalyticsSingleton::class)->makeHit(
            $this->model,
            $this->id,
            $this->analytic_type,
            auth()->user()?->id()
        );
    }
}
