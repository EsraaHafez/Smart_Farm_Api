<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users_Phone extends Model
{
    use HasFactory;
    protected $table = 'phone_users';
    public $incrementing = false;
    protected $primarykey = [ 'id', 'Phone'];



    protected $fillable = [

         'id',
        'Phone'



    ];
}
