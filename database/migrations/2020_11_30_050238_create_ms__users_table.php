<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MsUsers', function (Blueprint $table) {
            $table->increments('UserID');
            $table->string('Username',255);
            $table->string('email',255);
            $table->string('password',1000);
            $table->string('Address',255);
            $table->string('PhoneNumber');
            $table->string('Gender');
            $table->boolean('isAdmin');
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
        Schema::dropIfExists('ms__users');
    }
}
