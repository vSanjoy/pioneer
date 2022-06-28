<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalysesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analyses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('analysis_season_id')->nullable()->comment('Id from analysis_seasons table');
            $table->integer('distribution_area_id')->nullable()->comment('Id from distribution_areas table');
            $table->integer('distributor_id')->nullable()->comment('Id from users table');
            $table->integer('store_id')->nullable()->comment('Id from stores table');
            $table->timestamp('analysis_date')->nullable();
            $table->enum('status', ['0','1','2'])->default('1')->comment('0=>Inactive, 1=>Active, 2=>Blocked');
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
        Schema::dropIfExists('analyses');
    }
}
