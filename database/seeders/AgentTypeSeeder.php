<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agents_type')->truncate();

        $data = [
            ['type_name'=>'SYSTEM', 'type_desc'=> 'System Processes and Functions.', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['type_name'=>'DEVELOPER', 'type_desc'=> 'System Developer Role.', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['type_name'=>'TECHNICAL', 'type_desc'=> 'Administrator access for technical support tools and features.', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['type_name'=>'ADMINISTRATOR', 'type_desc'=> 'Administrator access to configurations.', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['type_name'=>'SUPERVISOR', 'type_desc'=> 'Supervisor access for dashboards and monitoring sessions.', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['type_name'=>'AGENT', 'type_desc'=> 'Agent access performing support to customers.', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ];

        DB::table('agents_type')->insert($data);
    }
}
