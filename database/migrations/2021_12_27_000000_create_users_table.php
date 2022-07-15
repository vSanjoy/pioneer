<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job_title_1')->nullable()->comment('Job title 1');
            $table->string('nickname')->nullable();
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('full_name')->nullable()->comment('Name 1');
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('company')->nullable()->comment('Company');
            $table->string('phone_no')->nullable()->comment('Phone 1');
            $table->string('password')->nullable();
            $table->string('profile_pic')->nullable();
            $table->enum('gender', ['M','F'])->default('M')->comment('M=>Male, F=>Female');
            $table->dateTime('dob')->nullable()->comment('Date of birth');
            $table->integer('distribution_area_id')->nullable()->comment('Id from distribution_areas table');
            $table->integer('role_id')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('auth_token')->nullable();
            $table->enum('type', ['SA','A','U','D','S'])->default('U')->comment('SA=>Super Admin, A=>Sub Admin, U=>User, D=>Distributor, S=>Seller');
            $table->enum('agree', ['N','Y'])->default('Y')->comment('N=>No, Y=>Yes');
            $table->enum('status', ['0','1'])->default('1')->comment('0=>Inactive, 1=>Active');
            $table->integer('lastlogintime')->nullable();
            $table->enum('sample_login_show', ['N','Y'])->default('N')->comment('Y=>Yes, N=>No');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
