<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StoreTargetSummaryLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_target_summary_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->nullable()->comment('Id from stores table');
            $table->timestamp('date')->nullable();
            $table->integer('credit_days')->nullable();
            $table->double('current_target',10,2)->nullable();
            $table->double('weekly_payment',10,2)->nullable();
            $table->string('visit_cycle')->nullable();
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
        Schema::dropIfExists('store_target_summary_logs');
    }
}
