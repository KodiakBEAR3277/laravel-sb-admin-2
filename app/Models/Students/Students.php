<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Students extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id', 'FirstName', 'LastName', 'MiddleName', 'DateOfBirth'
    ];

    protected $table = 'students';
}
