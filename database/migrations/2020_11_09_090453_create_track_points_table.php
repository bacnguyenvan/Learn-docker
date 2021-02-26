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
            $table->double('latitude', 10, 6);
            $table->double('longitude', 10, 6);
            $table->double('elevation', 8, 2);
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
