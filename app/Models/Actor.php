<?php

namespace App\Models;


use Illuminate\Foundation\auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Hash;


class Actor extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guard = 'Actor';
    protected $table = 'actor';

    protected $fillable = [
        'Actor_Name',
        'email',
        'Password',

    ];


    protected $hidden = [
        'Password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


   /*  public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    } */

}
