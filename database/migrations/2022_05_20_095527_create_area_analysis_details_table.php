<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaAnalysisDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_analysis_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('area_analysis_id')->nullable()->comment('Id from area_analysis table');
            $table->integer('distributor_id')->nullable()->comment('Id from distributors table');
            $table->text('result')->nullable();
            $table->text('why')->nullable();
            $table->enum('commented_by', ['D','SA','A','S'])->default('D')->comment('D=>Distributor, SA=>Super Admin, A=>Admin, S=>Store Manager');
            $table->enum('is_viewed', ['N','Y'])->default('N')->comment('N=>No, Y=>Yes');
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
        Schema::dropIfExists('area_analysis_details');
    }
}
