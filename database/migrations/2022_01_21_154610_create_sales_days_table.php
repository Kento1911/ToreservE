<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainer_profile_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('monday_open');
            $table->string('monday_close');
            $table->string('tuesday_open');
            $table->string('tuesday_close');
            $table->string('wednesday_open');
            $table->string('wednesday_close');
            $table->string('thursday_open');
            $table->string('thursday_close');
            $table->string('friday_open');
            $table->string('friday_close');
            $table->string('saturday_open');
            $table->string('saturday_close');
            $table->string('sunday_open');
            $table->string('sunday_close');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_days');
    }
}
