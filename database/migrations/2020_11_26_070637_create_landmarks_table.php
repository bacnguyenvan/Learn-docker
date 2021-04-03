<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landmarks', function (Blueprint $table) {
            $table->id();
            $table->integer('area_id');
            $table->string('name');
            $table->text('support')->nullable();
            $table->text('description');
            $table->string('thumbnail');
            $table->double('latitude', 10, 6);
            $table->double('longitude', 10, 6);
            $table->string('category');
            $table->string('address');
            $table->string('tel')->nullable();
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
        Schema::dropIfExists('landmarks');
    }
}
