<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->integer('distributor_id')->nullable()->comment('Id from users table');
            $table->integer('distribution_area_id')->nullable()->comment('Id from distribution_areas table');
            $table->integer('beat_id')->nullable()->comment('Id from beats table');
            $table->integer('store_id')->nullable()->comment('Id from stores table');
            $table->timestamp('date')->nullable();
            $table->double('total_amount',10,2)->nullable()->comment('Total amount');
            $table->string('payment_mode')->nullable();
            $table->text('payment_details')->nullable();
            $table->longText('note')->nullable();
            $table->string('password')->nullable()->comment('Password to update payment details');

            $table->integer('single_step_order_id')->nullable()->comment('Id from single_step_orders table');
            $table->integer('invoice_id')->nullable()->comment('Id from invoices table');
            $table->string('unique_order_id')->nullable()->comment('Unique order id from single_step_orders table');
            $table->string('unique_invoice_id')->nullable()->comment('Newly created unique invoice id');
            $table->string('pdf')->nullable()->comment('Name of the generated invoiced pdf');

            $table->enum('status', ['CR','DR'])->default('CR')->comment('CR=>Credit, DR=>Debit');
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
        Schema::dropIfExists('payments');
    }
}
