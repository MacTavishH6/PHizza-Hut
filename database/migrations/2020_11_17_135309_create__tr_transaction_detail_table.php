<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrTransactionDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TrTransactionDetail', function (Blueprint $table) {
            $table->increments("TransactionID");
            $table->integer("HTransactionID");
            $table->integer("PizzaID");
            $table->double("SubTotal");
            $table->integer("Qty");
            $table->string('AuditUsername');
            $table->datetime('AuditTime');
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
        Schema::dropIfExists('_tr_transaction_detail');
    }
}
