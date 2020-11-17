<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MsStaff', function (Blueprint $table) {
            $table->string('StaffID');
            $table->string('StaffName',255);
            $table->string('Password',20);
            $table->string('Address',255);
            $table->string('PhoneNumber');
            $table->string('Gender');
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
        Schema::dropIfExists('_ms_staff');
    }
}
