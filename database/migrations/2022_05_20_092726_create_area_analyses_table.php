<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaAnalysesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_analyses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('season_id')->nullable()->comment('Id from seasons table');
            $table->integer('year')->nullable();
            $table->timestamp('analysis_date')->nullable();
            $table->integer('distribution_area_id')->nullable()->comment('Id from distribution_areas table');
            $table->integer('distributor_id')->nullable()->comment('Id from distributors table');
            $table->integer('store_id')->nullable()->comment('Id from stores table');
            $table->integer('category_id')->nullable()->comment('Id from categories table');
            $table->integer('product_id')->nullable()->comment('Id from products table');
            $table->string('target_monthly_sales')->nullable();
            $table->text('type_of_analysis')->nullable();
            $table->text('action')->nullable();
            $table->text('result')->nullable();
            $table->text('why')->nullable();
            $table->longText('comment')->nullable();
            $table->enum('status', ['0','1'])->default('1')->comment('0=>Inactive, 1=>Active');
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
        Schema::dropIfExists('area_analyses');
    }
}
