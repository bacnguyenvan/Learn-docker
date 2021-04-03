<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\DownloadRoute;

class DownloadRouteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:downloadRoute {routeID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to download route';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $routeID = $this->argument('routeID');
        $route = \App\Models\Route::find($routeID);
        if(empty($route)){
            echo "Route ID not found!\n";
            return;
        }
        //Job download route
        echo "Start download. It take a period time to finish download. Thank you!\n";
        dispatch(new DownloadRoute($route))->onQueue("low");
    }
}
