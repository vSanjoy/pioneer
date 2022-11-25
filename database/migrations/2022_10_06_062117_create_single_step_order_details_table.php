<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSingleStepOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('single_step_order_details', function (Blueprint $table) {
            $table->id();
            $table->integer('single_step_order_id')->nullable()->comment('Id from users table');
            $table->integer('category_id')->nullable()->comment('Id from analyses_details table');
            $table->integer('product_id')->nullable()->comment('Id from analyses_details table');
            $table->string('qty')->nullable();
            $table->text('why')->nullable();
            $table->text('result')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('single_step_order_details');
    }
}
