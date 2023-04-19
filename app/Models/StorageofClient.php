<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageofClient extends Model
{
    use HasFactory;
    protected $table = 'buys';
    //protected $primaryKey = Null;
    // protected $primaryKey = array('id', 'Storge_id');
    protected $primarykey = [ 'id', 'Storge_id'];


     public $incrementing = false;

     protected $fillable = [
        //'Buys_id',
         'id',
         'Storge_id'



     ];



}
