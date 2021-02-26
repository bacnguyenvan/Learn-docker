<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('montbell_login_user_id')->unique();
            $table->string('login_token')->nullable();
            $table->string('device_token')->nullable();
            $table->string('member_mbc_no')->nullable();
            $table->string('member_web_no')->nullable();
            $table->string('member_name')->nullable();
            $table->string('mbc_yukokigen_year_month')->nullable();
            $table->integer('mbc_update_flg')->nullable();
            $table->string('premium_card_name')->nullable();
            $table->string('card_name')->nullable();
            $table->string('card_category_name')->nullable();
            $table->string('card_img')->nullable();
            $table->integer('card_type_renewal_flg')->nullable();
            $table->integer('card_type_reenter_flg')->nullable();
            $table->integer('member_points')->nullable();
            $table->string('support_card_img')->nullable();
            $table->string('barcode_string')->nullable();
            $table->integer('barcode_retention_seconds')->nullable();

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
        Schema::dropIfExists('members');
    }
}
