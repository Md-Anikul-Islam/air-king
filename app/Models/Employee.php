<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_section_id',
        'name',
        'designation',
        'joining_date',
        'email',
        'phone',
        'address',
        'salary',
        'status',
    ];

    public function employeeSection()
    {
        return $this->belongsTo(EmployeeSection::class);
    }
}
