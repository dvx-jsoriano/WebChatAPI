<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('auxes')->truncate();

        $data = [
            ['aux_code'=>'LOGOUT', 'aux_name'=> 'LOGOUT', 'fixed'=> 1, 'active'=> 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['aux_code'=>'READY', 'aux_name'=> 'READY', 'fixed'=> 1, 'active'=> 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['aux_code'=>'NOT READY', 'aux_name'=> 'LOGIN', 'fixed'=> 1, 'active'=> 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['aux_code'=>'NOT READY', 'aux_name'=> 'LUNCH BREAK', 'fixed'=> 0, 'active'=> 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ];

        DB::table('auxes')->insert($data);
    }
}

