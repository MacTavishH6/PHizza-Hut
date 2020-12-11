<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('msusers')->insert([
            'Username'=>'Admin',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('123456'),
            'Address'=>'admin address',
            'PhoneNumber'=>'0123456789',
            'Gender'=>'Male',
            'isAdmin' => '1',//1 for admin, 2 for superadmin (but we only use admin XD)
            'AuditUsername'=>'LaravelSeeder',
            'AuditTime'=>Carbon::now()->toDateTimeString(),
            'AuditActivity'=>'I',
        ]);
    }
}
