<?php

namespace App\Models;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_id', 
        'name',       
        'email',      
        'phone',      
        'position',   
        'department', 
        'start_date' 
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'employee_id', 'employee_id');  // Ensure correct foreign key
    }
}
