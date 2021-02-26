<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->integer('area_id');
            $table->string('number');
            $table->string('name');
            $table->string('description');
            $table->string('movement');
            $table->integer('stamina_level');
            $table->double('range', 8, 2);
            $table->double('diff_elevation', 8, 2);
            $table->double('total_elevation', 8, 2)->nullable();
            $table->bigInteger('journey_time');
            $table->string('line_color');
            $table->geometry('geometry')->nullable();
            $table->geometry('point_center')->nullable();
            $table->double('zoom_level', 8, 2)->nullable();
            $table->string('thumbnail');
            $table->softDeletes('deleted_at', 0);
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
        Schema::dropIfExists('routes');
    }
}
