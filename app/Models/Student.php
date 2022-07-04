<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    public $translatable = ['name'];

    protected $table = 'students';

    protected $fillable = [
        'name',
        'email',
        'password',
        'gender_id',
        'blood_id',
        'date_birth',
        'grade_id',
        'classroom_id',
        'section_id',
        'parent_id',
        'academic_year',
    ];
    public $timestamps = true;

    public function getGender()
    {
        return $this->gender_id == 1 ? __('teacher-trans.male') : __('teacher-trans.female');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function myparent()
    {
        return $this->belongsTo(MyParent::class, 'parent_id');
    }

    public function student_account()
    {
        return $this->hasMany(StudentAccount::class, 'student_id');
    }
}
