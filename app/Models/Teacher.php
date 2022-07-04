<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name'];

    protected $table = 'teachers';

    protected $fillable = [
        'email',
        'password',
        'name',
        'specialization_id',
        'gender_id',
        'joining_date',
        'address',
    ];
    public $timestamps = true;

    public function getGender()
    {
        return $this->gender_id == 1 ? __('teacher-trans.male') : __('teacher-trans.female');
    }

    public function getSpecializations()
    {
        if ($this->specialization_id == 1) {
            return __('teacher-trans.specializations.Arabic');

        } elseif ($this->specialization_id == 2) {
            return __('teacher-trans.specializations.Sciences');

        } elseif ($this->specialization_id == 3) {
            return __('teacher-trans.specializations.Computer');

        } elseif ($this->specialization_id == 4) {
            return __('teacher-trans.specializations.English');
        }
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'teacher_sections');
    }

}
