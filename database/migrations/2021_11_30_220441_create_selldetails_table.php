<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelldetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selldetails', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('sell_id');
            $table->string('product_id');
            $table->integer('unit_price');
            $table->integer('total_unit');
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
        Schema::dropIfExists('selldetails');
    }
}
