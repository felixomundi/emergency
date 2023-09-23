<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\County;
use Illuminate\Support\Carbon;
class SubCountySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("sub_counties")->delete();
        $cId = County::pluck("id")->all();
        $data = [
            [ "name"=> "Nyamache",
             "county_id"=> $cId[1],
             'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            ],
            ["name" => "Nyacheki", "county_id"=>$cId[1],
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),],

            [ "name"=> "Kaloleni", "county_id"=> $cId[2],
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),],

            ["name" => "Kilifi", "county_id"=>$cId[2],
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),],
        ];
        DB::table("sub_counties")->insert($data);
    }
}
