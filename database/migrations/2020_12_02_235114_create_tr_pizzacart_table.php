<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrPizzacartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_pizzacart', function (Blueprint $table) {
            $table->increments('CartID');
            $table->integer('UserID');
            $table->integer('PizzaID');
            $table->integer('PizzaQty');
            $table->double('TotalPrice');
            $table->string('AuditUsername');
            $table->dateTime('AuditTime');
            $table->char('AuditActivity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_pizzacart');
    }
}
