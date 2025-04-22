<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Students extends Model
{
    use SoftDeletes;
    
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'StudentNumber',
        'FirstName',
        'LastName',
        'MiddleName',
        'DateOfBirth',
        'Course',
        'YearLevel',
        'Section',
        'AcademicStatus',
        'Gender',
        'Address',
        'ContactNumber',
        'EmergencyContact',
        'EmergencyContactNumber',
        'Email'
    ];

    protected $table = 'students';
}
