<?php

namespace App\Observers;

use App\Jobs\DownloadRoute;
use App\Models\Route;

class RouteObserve
{
    /**
     * Handle the Route "created" event.
     *
     * @param  \App\Models\Route  $route
     * @return void
     */
    public function created(Route $route)
    {
        $route = Route::findOrFail($route->id);
        dispatch(new DownloadRoute($route))->onQueue("low");
    }

    /**
     * Handle the Route "updated" event.
     *
     * @param  \App\Models\Route  $route
     * @return void
     */
    public function updated(Route $route)
    {
        
    }

    /**
     * Handle the Route "deleted" event.
     *
     * @param  \App\Models\Route  $route
     * @return void
     */
    public function deleted(Route $route)
    {
        //
    }

    /**
     * Handle the Route "restored" event.
     *
     * @param  \App\Models\Route  $route
     * @return void
     */
    public function restored(Route $route)
    {
        //
    }

    /**
     * Handle the Route "force deleted" event.
     *
     * @param  \App\Models\Route  $route
     * @return void
     */
    public function forceDeleted(Route $route)
    {
        //
    }
}
