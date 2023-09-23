<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
            'name' => "User",
            'email' => 'fomundi34@gmail.com',
            "role_as"=>"0",
            'password' => Hash::make('12345678'),
            "phone"=>"0100544188",
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),            
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
            'name' => "Admin",
            'email' => 'omundifelix30@gmail.com',
            "role_as"=>"1",
            'password' => Hash::make('12345678'), 
            "phone"=>"0745566505",
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),

            ],
        ];
        DB::table("users")->delete();
        DB::table('users')->insert(
            $data
    );
    }
}
