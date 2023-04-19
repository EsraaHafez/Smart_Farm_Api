<?php


namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\auth\User as CheckActoreToken;
use Illuminate\Notifications\Notifiable;
 //use Tymon\JWTAuth\Contracts\JWTSubject;
// use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;
use Hash;

class Actor extends CheckActoreToken
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];
    //protected $guarded = array();
    //protected $guard = 'Actor';
    protected $table = 'actor';
    //public $incrementing = false;
    protected $primaryKey = 'Actor_Name';


    protected $fillable = [
        'Actor_Name',
        'email',
        'Password'

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
