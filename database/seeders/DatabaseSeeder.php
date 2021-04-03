<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Set the path of your .sql file
        // $script = database_path() . '/jet.sql';

        // $username = config('database.connections.mysql.username');
        // $password = config('database.connections.mysql.password');
        // $database = config('database.connections.mysql.database');
        // $host = config('database.connections.mysql.host');

        // $command = "mysql -u $username -p$password -h$host $database < $script";

        // exec($command);

        Model::unguard();
        $this->call([
            AreasTableSeeder::class,
            RoutesTableSeeder::class,
            MembersTableSeeder::class,
            MemberStampTableSeeder::class,
            TagsTableSeeder::class,
            PrefecturesTableSeeder::class,
            ActivitiesTableSeeder::class,
            TracksTableSeeder::class,
            AppInfoTableSeeder::class,
            RegionsTableSeeder::class,
            ScenesTableSeeder::class,
            PointsTableSeeder::class,
            RoutePointTableSeeder::class,
            RouteSceneTableSeeder::class,
            RouteActivityTableSeeder::class,
            RouteTagTableSeeder::class,
            // TrackPointsTableSeeder::class,
            LandmarksTableSeeder::class,
            RouteLandmarkTableSeeder::class,
            StampsTableSeeder::class,
            RouteStampTableSeeder::class,
            NewsTableSeeder::class,
            MemberNewsTableSeeder::class,
            GeometriesTableSeeder::class,
            WarningsTableSeeder::class,
            RouteWarningTableSeeder::class,
            AreaPhotoTableSeeder::class,
            NotificationTableSeeder::class,
            MemberNotificationTableSeeder::class,
            AdminSeeder::class,
            UserDeviceTableSeeder::class,
            IconsSeeder::class
        ]);
        Model::reguard();
    }
}
