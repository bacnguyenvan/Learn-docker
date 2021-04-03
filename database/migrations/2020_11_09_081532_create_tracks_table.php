<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->integer('route_id');
            $table->integer('member_id');
            $table->string('name');
            $table->string('description');
            $table->double('total_time');
            $table->double('total_distance');
            $table->double('total_elevation');
            $table->string('type');
            $table->tinyInteger('is_finished')->comment('0: 無 , 1: 有')->default(1);
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
        Schema::dropIfExists('tracks');
    }
}
