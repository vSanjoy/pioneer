<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('distribution_area_id')->nullable()->comment('Id from distribution_areas table');
            $table->string('name_1')->nullable();
            $table->string('name_2')->nullable();
            $table->string('store_name')->nullable();
            $table->string('slug')->nullable();
            $table->string('phone_no_1')->nullable();
            $table->string('whatsapp_no_1')->nullable();
            $table->string('phone_no_2')->nullable();
            $table->string('whatsapp_no_2')->nullable();
            $table->text('street')->nullable();
            $table->string('district_region')->nullable();
            $table->string('zip')->nullable();
            $table->string('beat_name')->nullable();
            $table->string('email')->nullable();
            $table->enum('sale_size_category', ['S','M','L'])->default('S')->comment('S=>Small, M=>Medium, L=>Large');
            $table->enum('integrity', ['A+','A','B','B-','C'])->default('A+')->comment('A+=>A+, A=>A, B=>B, B-=>B-, C=>C');
            $table->text('notes')->nullable();
            $table->integer('sort')->default('0');
            $table->enum('status', ['0','1'])->default('1')->comment('0=>Inactive, 1=>Active');
            $table->enum('progress_status', ['IP','CP'])->default('IP')->comment('IP=>In-Progress, CP=>Complete');
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
        Schema::dropIfExists('stores');
    }
}
