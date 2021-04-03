<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_points', function (Blueprint $table) {
            $table->id();
            $table->integer('track_id');
            $table->text('movement');
            $table->double('range', 8, 2);
            $table->double('elevation', 8, 2);
            $table->double('distance_per_point', 8, 2);
            $table->double('elevation_per_point', 8, 2);
            $table->integer('journey_time_per_point');
            $table->double('total_elevation', 8, 2);
            $table->integer('journey_time');
            $table->double('latitude', 10, 6);
            $table->double('longitude', 10, 6);
            $table->tinyInteger('is_finished')->comment('0: 無 , 1: 有')->default(1);
            $table->text('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('track_points');
    }
}
