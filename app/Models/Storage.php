<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;
    protected $table = 'storge';
    protected $primaryKey = 'Storge_id';

    use HasFactory;

    protected $fillable = [
        'Size',
        'Availability'

    ];
}
