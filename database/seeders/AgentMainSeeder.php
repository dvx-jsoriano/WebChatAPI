<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class AgentMainSeeder extends Seeder
{
    public $faker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $faker = Faker::create();

        DB::table('agents')->truncate();

        DB::table('agents')->insert([
            'agent_username' => $faker->userName,
            'agent_password' => Hash::make('P@ssw0rd'),
            'agent_handle' => $faker->name,
            'agent_first' => $faker->firstName,
            'agent_last' => $faker->lastName,
            'agent_type' => 'SYSTEM',
        ]);

        DB::table('agents')->insert([
            'agent_username' => $faker->userName,
            'agent_password' => Hash::make('P@ssw0rd'),
            'agent_handle' => $faker->name,
            'agent_first' => $faker->firstName,
            'agent_last' => $faker->lastName,
            'agent_type' => 'ADMIN',
        ]);

        DB::table('agents')->insert([
            'agent_username' => $faker->userName,
            'agent_password' => Hash::make('P@ssw0rd'),
            'agent_handle' => $faker->name,
            'agent_first' => $faker->firstName,
            'agent_last' => $faker->lastName,
            'agent_type' => 'ADMIN',
        ]);

        //Factory::create(App\Models\Agent::class, 10);
        //(App\Models\Agent::class, 10)->create();
        \App\Models\Agent::factory(10)->create();
    }
}
