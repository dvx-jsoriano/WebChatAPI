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
            'agent_username' => 'system',
            'agent_password' => Hash::make('P@ssw0rd'),
            'agent_handle' => $faker->name,
            'agent_first' => $faker->firstName,
            'agent_last' => $faker->lastName,
            'agent_type' => 'SYSTEM',
        ]);

        DB::table('agents')->insert([
            'agent_username' => 'jsoriano',
            'agent_password' => Hash::make('P@ssw0rd'),
            'agent_handle' => $faker->name,
            'agent_first' => $faker->firstName,
            'agent_last' => $faker->lastName,
            'agent_type' => 'DEVELOPER',
        ]);

        DB::table('agents')->insert([
            'agent_username' => 'technical',
            'agent_password' => Hash::make('P@ssw0rd'),
            'agent_handle' => $faker->name,
            'agent_first' => $faker->firstName,
            'agent_last' => $faker->lastName,
            'agent_type' => 'TECHNICAL',
        ]);

        DB::table('agents')->insert([
            'agent_username' => 'administrator',
            'agent_password' => Hash::make('P@ssw0rd'),
            'agent_handle' => $faker->name,
            'agent_first' => $faker->firstName,
            'agent_last' => $faker->lastName,
            'agent_type' => 'ADMINISTRATOR',
        ]);

        DB::table('agents')->insert([
            'agent_username' => 'super001',
            'agent_password' => Hash::make('P@ssw0rd'),
            'agent_handle' => $faker->name,
            'agent_first' => $faker->firstName,
            'agent_last' => $faker->lastName,
            'agent_type' => 'SUPERVISOR',
        ]);

        DB::table('agents')->insert([
            'agent_username' => 'agent002',
            'agent_password' => Hash::make('P@ssw0rd'),
            'agent_handle' => $faker->name,
            'agent_first' => $faker->firstName,
            'agent_last' => $faker->lastName,
            'agent_type' => 'AGENT',
        ]);

        //Factory::create(App\Models\Agent::class, 10);
        //(App\Models\Agent::class, 10)->create();
        \App\Models\Agent::factory(10)->create();
    }
}
