<?php
// https://stackoverflow.com/questions/20030716/change-default-primary-key-in-eloquent
// https://stackoverflow.com/questions/65421967/problem-sqlstate42s02-base-table-or-view-not-found
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class field extends Model
{
    protected $table = 'field';
    protected $primaryKey = 'Field_id';
    use HasFactory;

    protected $fillable = [

        'Name',
        'Last_Harvest_Date',
        'Harvest_id',


    ];

  /*   class User extends Eloquent {

        protected $primaryKey = 'admin_id';

    } */

}
