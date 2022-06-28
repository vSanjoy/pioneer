<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalysesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analyses_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('analyses_id')->nullable()->comment('Id from analyses table');
            $table->integer('category_id')->nullable()->comment('Id from categories table');
            $table->integer('product_id')->nullable()->comment('Id from products table');
            $table->string('target_monthly_sales')->nullable();
            $table->text('type_of_analysis')->nullable();
            $table->text('action')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('analyses_details');
    }
}
