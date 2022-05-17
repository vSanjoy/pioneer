<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->comment('Id from users table');
            $table->string('job_title_2')->nullable()->comment('Job title 2');
            $table->string('full_name_2')->nullable()->comment('Full name 2');
            $table->string('phone_no_2')->nullable()->comment('Phone 2');
            $table->string('whatsapp_no')->nullable()->comment('Whats App');
            $table->text('street')->nullable();
            $table->string('city')->nullable()->comment('City');
            $table->string('district_region')->nullable()->comment('District/Region');
            $table->string('state_province')->nullable()->comment('State/Province');
            $table->string('zip')->nullable()->comment('Zip');
            $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}
