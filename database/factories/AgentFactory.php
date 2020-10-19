<?php

namespace Database\Factories;

use App\Models\Agent;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AgentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Agent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'agent_username' => $this->faker->userName,
            'agent_password' => Hash::make('P@ssw0rd'),
            'agent_handle' => $this->faker->name,
            'agent_first' => $this->faker->firstName,
            'agent_last' => $this->faker->lastName,
            'agent_type' => $this->faker->randomElement(['SUPERVISOR', 'AGENT']),
        ];
    }
}
