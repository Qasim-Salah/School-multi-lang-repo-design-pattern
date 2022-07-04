<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $table = 'promotions';

    protected $fillable = [
        'student_id',
        'from_grade',
        'from_classroom',
        'from_section',
        'to_grade',
        'to_classroom',
        'to_section',
        'academic_year',
        'academic_year_new',
    ];
    public $timestamps = true;

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function from_grade_r()
    {
        return $this->belongsTo(Grade::class, 'from_grade');
    }

    public function from_classroom_r()
    {
        return $this->belongsTo(Classroom::class, 'from_classroom');
    }

    public function from_section_r()
    {
        return $this->belongsTo(Section::class, 'from_section');
    }

    public function to_grade_r()
    {
        return $this->belongsTo(Grade::class, 'to_grade');
    }

    public function to_classroom_r()
    {
        return $this->belongsTo(Classroom::class, 'to_classroom');
    }

    public function to_section_r()
    {
        return $this->belongsTo(Section::class,'to_section');
    }

}
