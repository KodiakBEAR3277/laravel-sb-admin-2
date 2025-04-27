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
        'Password',
        'DateOfBirth',
        'Course',
        'YearLevel',
        'Section',
        'AcademicStatus',
        'Gender',
        'Address',
        'TelephoneNumber',
        'ContactNumber',
        'EmergencyContact',
        'EmergencyContactNumber',
        'Email'
    ];

    protected $hidden = [
        'Password',
    ];

    protected $table = 'students';

    // Phone number format accessor
    public function getContactNumberAttribute($value)
    {
        return $value ? '0' . substr($value, -10) : null;
    }

    public function setContactNumberAttribute($value)
    {
        $this->attributes['ContactNumber'] = $value ? preg_replace('/[^0-9]/', '', $value) : null;
    }

    public function getEmergencyContactNumberAttribute($value)
    {
        return $value ? '0' . substr($value, -10) : null;
    }

    public function setEmergencyContactNumberAttribute($value)
    {
        $this->attributes['EmergencyContactNumber'] = $value ? preg_replace('/[^0-9]/', '', $value) : null;
    }

    public function getStudentNumberAttribute($value)
    {
        if (!$value) return null;
        // If the value already has the correct format, return it
        if (preg_match('/^\d{4}-\d{5}$/', $value)) return $value;
        // Otherwise, format it
        $numbers = preg_replace('/[^0-9]/', '', $value);
        return substr($numbers, 0, 4) . '-' . str_pad(substr($numbers, 4), 5, '0', STR_PAD_LEFT);
    }

    public function setStudentNumberAttribute($value)
    {
        // Remove any non-numeric characters except dash
        $cleaned = preg_replace('/[^0-9-]/', '', $value);
        // Ensure it follows the pattern YYYY-XXXXX
        if (!preg_match('/^\d{4}-\d{5}$/', $cleaned)) {
            $numbers = preg_replace('/[^0-9]/', '', $cleaned);
            $cleaned = substr($numbers, 0, 4) . '-' . str_pad(substr($numbers, 4), 5, '0', STR_PAD_LEFT);
        }
        $this->attributes['StudentNumber'] = $cleaned;
    }
}
