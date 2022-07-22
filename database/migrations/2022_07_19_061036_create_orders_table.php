<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller_id')->nullable()->comment('Id from users table');
            $table->integer('analysis_season_id')->nullable()->comment('Id from analysis_seasons table');
            $table->integer('distribution_area_id')->nullable()->comment('Id from distribution_areas table');
            $table->integer('distributor_id')->nullable()->comment('Id from users table');
            $table->integer('beat_id')->nullable()->comment('beat_id foreign key from stores table');
            $table->integer('store_id')->nullable()->comment('Id from stores table');
            $table->timestamp('analysis_date')->nullable();
            $table->integer('analyses_id')->nullable()->comment('Id from analyses table');
            $table->integer('category_id')->nullable()->comment('Id from analyses_details table');
            $table->integer('product_id')->nullable()->comment('Id from analyses_details table');
            $table->integer('qty')->nullable();
            $table->text('why')->nullable();
            $table->text('result')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
