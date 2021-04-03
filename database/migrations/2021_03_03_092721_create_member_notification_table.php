<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_notification', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id');
            $table->foreignId('notification_id');
            $table->unsignedTinyInteger('status')
                ->default(0)
                ->comment('0: Unsent | 1: Sent | 2: Error');
            $table->softDeletes();
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
        Schema::dropIfExists('member_notification');
    }
}
