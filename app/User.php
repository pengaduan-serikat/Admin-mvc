<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()    {
        $accessType = DB::table('access_types')->where('name', 'Admin')->first();
        // const ADMIN_TYPE = $accessType->id;
        return $this->access_type_id === $accessType->id;
    }

    public function isUser() {
        $accessType = DB::table('access_types')->where('name', 'User')->first();
        // const ADMIN_TYPE = $accessType->id;
        return $this->access_type_id === $accessType->id;
    }

    public function isExecutor() {
        $accessType = DB::table('access_types')->where('name', 'Executor')->first();
        // const ADMIN_TYPE = $accessType->id;
        return $this->access_type_id === $accessType->id;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
