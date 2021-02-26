<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->integer('area_id');
            $table->string('support');
            $table->string('name');
            $table->integer('number');
            $table->string('category');
            $table->string('title');
            $table->text('description');
            $table->string('address');
            $table->string('tel');
            $table->double('latitude', 10, 6);
            $table->double('longitude', 10, 6);
            $table->double('elevation', 8, 2);
            $table->string('thumbnail');
            $table->double('distance_to_next', 8, 2);
            $table->double('time_to_next', 8, 2);
            $table->string('site_url');
            $table->string('montbell_friend_shop');
            $table->string('other');
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
        Schema::dropIfExists('points');
    }
}
