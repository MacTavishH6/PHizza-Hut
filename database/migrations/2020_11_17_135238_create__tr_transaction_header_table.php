<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrTransactionHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TrTransactionHeader', function (Blueprint $table) {
            $table->id();
            $table->string('UserID');
            $table->string('TotalPrice');
            $table->datetime('TransactionDate');
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
        Schema::dropIfExists('_tr_transaction_header');
    }
}
