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
            $table->string('name');
            $table->integer('number');
            $table->string('start_finish')->nullable();
            $table->text('description');
            $table->text('heading')->nullable();
            $table->string('address');
            $table->string('tel')->nullable();
            $table->double('latitude', 10, 6);
            $table->double('longitude', 10, 6);
            $table->string('thumbnail');
            $table->text('support')->nullable();
            $table->integer('distance_get_stamp')->nullable();
            $table->double('distance_to_next', 8, 2)->nullable();
            $table->double('time_to_next', 8, 2)->nullable();
            $table->tinyInteger('is_member_benefit')->comment('0: 無 , 1: 有')->default(0)->nullable();
            $table->string('site_url')->nullable();
            $table->string('montbell_friend_shop')->nullable();
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
