<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageofClient extends Model
{
    use HasFactory;
    protected $table = 'buys';
    //protected $primaryKey = 'Client_id';


     protected $fillable = [
        'Buys_id',
         'id',
         'Storge_id'



     ];
}
