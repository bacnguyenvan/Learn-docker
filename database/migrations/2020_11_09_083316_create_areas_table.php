<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->integer('prefecture_id');
            $table->integer('number');
            $table->string('name');
            $table->string('thumbnail');
            $table->string('slogan');
            $table->text('description');
            $table->double('latitude', 10, 6);
            $table->double('longtitude', 10, 6);
            $table->integer('zoom_level')->nullable();
            $table->string('catalog_file')->nullable();
            $table->string('map_file')->nullable();
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
        Schema::dropIfExists('areas');
    }
}
