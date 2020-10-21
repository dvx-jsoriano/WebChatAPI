<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campaigns')->truncate();

        $data = [
            ['campaign_name'=>'VIP', 'campaign_chat_weight'=> 1000, 'fixed'=> 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['campaign_name'=>'Billing', 'campaign_chat_weight'=> 1, 'fixed'=> 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['campaign_name'=>'Programming', 'campaign_chat_weight'=> 1, 'fixed'=> 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['campaign_name'=>'Sales', 'campaign_chat_weight'=> 1, 'fixed'=> 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['campaign_name'=>'Technical', 'campaign_chat_weight'=> 1, 'fixed'=> 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['campaign_name'=>'Account Status', 'campaign_chat_weight'=> 1, 'fixed'=> 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ];

        DB::table('campaigns')->insert($data);
    }
}
