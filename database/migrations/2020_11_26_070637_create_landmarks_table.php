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
            $table->string('name');
            $table->string('support');
            $table->text('description');
            $table->string('thumbnail');
            $table->string('icon');
            $table->double('latitude', 10, 6);
            $table->double('longitude', 10, 6);
            $table->string('category');
            $table->string('address');
            $table->string('tel');
            $table->string('site_url');
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
