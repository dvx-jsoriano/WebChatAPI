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

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agent_username', 
        'agent_password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'agent_password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
* `php artisan make:seeder DatabaseSeeder`
* `php artisan db:seed --class=DatabaseSeeder`

## Factory Command using Tinker
`Agent::factory()->count(10)->create();`

## Customized Class
- Custom Class created in App\Custom named `WebChat`
- `WebChat->GenerateSessionID($code)` used to generate a randomized 16 digit number and a parameterized single letter in the first character.

## Database Design
- The database structure can be found [here](https://dbdesigner.page.link/kfHidtAzk8k4ndGT8).

## Configure JWT Auth Guard To Point To Another Eloquent Model
- This will make use of Agent eloquent instead of the default User eloquent

- In `config/auth.php`
```
'defaults' => [
        'guard' => 'api',
        'passwords' => 'agent',
    ],
'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'api' => [
            'driver' => 'jwt',
            'provider' => 'agents',
        ],
    ],
 'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'agents' => [
            'driver' => 'eloquent',
            'model' => App\Models\Agent::class,
        ],
    ],
'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        'agents' => [
            'provider' => 'agents',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],
```

- In `App\Models\Agent`,

```
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
```

In `App\Controllers\AuthController`,

```
<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login']]);
    }

    /**
     * Register a user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $user = Agent::create([
             'agent_username' => $request->agent_username,
             'agent_password' => bcrypt($request->agent_password),
         ]);

        $token = auth()->login($user);

        return $this->respondWithToken($token);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            $credentials = $request->only(['username', 'password']);

            if (!$token = auth()->attempt(['agent_username' => $request->agent_username, 'password' => $request->agent_password])) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            return $this->respondWithToken($token);
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 404);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
```

In `routes/api.php`,

```
use App\Http\Controllers\AuthController;
...
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/refresh', [AuthController::class, 'refresh']);
Route::post('/me', [AuthController::class, 'me']);
```