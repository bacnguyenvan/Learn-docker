<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Contracts\AuthContract::class,
            \App\Repositories\AuthRepository::class
        );

        $this->app->bind(
            \App\Contracts\PrefectureContract::class,
            \App\Repositories\PrefectureRepository::class
        );

        $this->app->bind(
            \App\Contracts\AreaContract::class,
            \App\Repositories\AreaRepository::class
        );

        $this->app->bind(
            \App\Contracts\MemberContract::class,
            \App\Repositories\MemberRepository::class
        );

        $this->app->bind(
            \App\Contracts\TrackContract::class,
            \App\Repositories\TrackRepository::class
        );

        $this->app->bind(
            \App\Contracts\TrackPointContract::class,
            \App\Repositories\TrackPointRepository::class
        );

        $this->app->bind(
            \App\Contracts\RouteContract::class,
            \App\Repositories\RouteRepository::class
        );

        $this->app->bind(
            \App\Contracts\ActivityContract::class,
            \App\Repositories\ActivityRepository::class
        );

        $this->app->bind(
            \App\Contracts\TagContract::class,
            \App\Repositories\TagRepository::class
        );

        $this->app->bind(
            \App\Contracts\AppInfoContract::class,
            \App\Repositories\AppInfoRepository::class
        );

        $this->app->bind(
            \App\Contracts\SceneContract::class,
            \App\Repositories\SceneRepository::class
        );

        $this->app->bind(
            \App\Contracts\PointContract::class,
            \App\Repositories\PointRepository::class
        );

        $this->app->bind(
            \App\Contracts\StampContract::class,
            \App\Repositories\StampRepository::class
        );

        $this->app->bind(
            \App\Contracts\LandmarkContract::class,
            \App\Repositories\LandmarkRepository::class
        );

        $this->app->bind(
            \App\Contracts\RegionContract::class,
            \App\Repositories\RegionRepository::class
        );

        $this->app->bind(
            \App\Contracts\NotificationContract::class,
            \App\Repositories\NotificationRepository::class
        );
    }
}
