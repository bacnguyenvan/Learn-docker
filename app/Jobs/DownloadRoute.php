<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Route;
use App\Http\Helpers\Helper;
class DownloadRoute implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;
    private $route;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $route = $this->route;
        $helpers = new Helper();
        for ($zoom = 15; $zoom <= 18; $zoom++) {
            $data = $helpers->calculatorTiles($route, $zoom);
            $helpers->getTiles($data, $zoom, $route->id);
        }
        //download elevation for zoom = 14 
        $data = $helpers->calculatorTiles($route, $zoom = 14);
        $helpers->getElevations($data, 14, $route->id);

        $helpers->zipFiles($route->id);
        \Illuminate\Support\Facades\File::deleteDirectory(public_path("route_data/route_$route->id/tiles"));
    }
}
