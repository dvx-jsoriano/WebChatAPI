<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('templates')->truncate();

        $data = [
            [
                'temp_title' => 'Billing Statement', 'temp_content' => 'This is a sample Billing Statement.', 'active' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'temp_title' => 'Account Status', 'temp_content' => 'This is a sample Account.', 'active' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];

        DB::table('templates')->insert($data);
    }
}
