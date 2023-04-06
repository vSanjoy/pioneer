<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id')->nullable()->comment('Id from invoices table');
            $table->integer('category_id')->nullable()->comment('Id from categories table');
            $table->integer('product_id')->nullable()->comment('Id from products table');
            $table->float('qty',10,2)->default(0)->comment('Product quantity');
            $table->double('unit_price',10,2)->nullable()->comment('Unit price');
            $table->double('discount_percent',10,2)->nullable()->comment('Discount percent');
            $table->double('discount_amount',10,2)->nullable()->comment('Discount amount');
            $table->double('total_price',10,2)->nullable()->comment('Total amount after discount');
            $table->enum('status', ['IS','H'])->default('IS')->comment('IS=>Invoice/Shipped, H=>On Hold');
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
        Schema::dropIfExists('invoice_details');
    }
}
