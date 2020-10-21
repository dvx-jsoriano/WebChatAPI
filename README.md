<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Introduction

This is a project WebChatAPI built in Laravel 8 from scratch. Development installation, configurations and steps on how this was built were written below for reference.

## Create New App
- `laravel new WebChatAPI`

## Install Laravel UI with Authentication
1. `composer require laravel/ui`
2. `php artisan ui vue --auth`
3. `npm install`
4. `npm run dev`

## JWT Authentication

- Install JWT
1. `composer require tymon/jwt-auth`
2. `php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"`
3. `php artisan jwt:secret`

- Update your User Model

```
<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
```

- Configure the Auth guard

```
'defaults' => [
    'guard' => 'api',
    'passwords' => 'users',
],

...

'guards' => [
    'api' => [
        'driver' => 'jwt',
        'provider' => 'users',
    ],
],
```

## Migrations

* `php artisan make:migration create_agents_table`
* `php artisan make:migration create_agents_type_table`
* `php artisan make:migration create_auxes_table`
* `php artisan make:migration create_campaigns_table`
* `php artisan make:migration create_templates_table`
* `php artisan make:migration create_customers_table`
* `php artisan make:migration create_chat_sessions_table`
* `php artisan make:migration create_chat_live_table`
* `php artisan make:migration create_agents_type_table`
* `php artisan make:migration create_tickets_table`

## Create Model
* `php artisan make:model Agent`
* `php artisan make:resource Agent`
* `php artisan make:resource Agents --collection`
* `php artisan make:resource AgentCollection`

## Controller
`php artisan make:controller --api`

## Adding API Resource (Controller) in API Route --Laravel 8 new way
```
// Not working anymore
Route::apiResource('<route-name>', '<controller-name>');
// Working
Route::apiResource('<route-name>', 'App\Http\Controllers\<controller-name>');
```

## Create and Run Seeder
* `php artisan make:seeder AgentMainSeeder`
* `php artisan db:seed --class=AgentMainSeeder`

## Factory Command using Tinker
`Agent::factory()->count(10)->create();`

