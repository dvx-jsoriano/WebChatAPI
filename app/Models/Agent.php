<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use App\Models\User as Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_username',
        'agent_password'
    ];

    public function getAuthPassword()
    {
        return $this->agent_password;
    }
}
