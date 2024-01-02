<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_id')->nullable()->comment('Id from payments table');
            $table->integer('invoice_id')->nullable()->comment('Id from invoices table');
            $table->integer('invoice_details_id')->nullable()->comment('Id from invoice_details table');
            $table->integer('category_id')->nullable()->comment('Id from categories table');
            $table->string('category')->nullable();
            $table->integer('product_id')->nullable()->comment('Id from products table');
            $table->string('product')->nullable();
            $table->float('qty',10,2)->default(0)->comment('Product quantity');
            $table->double('unit_price',10,2)->nullable()->comment('Unit price');
            $table->double('discount_percent',10,2)->nullable()->comment('Discount percent');
            $table->double('discount_amount',10,2)->nullable()->comment('Discount amount');
            $table->double('total_price',10,2)->nullable()->comment('Total amount');
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
        Schema::dropIfExists('payment_details');
    }
}
