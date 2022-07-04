<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MyParent extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'my_parents';

    public $translatable = ['name_father', 'job_father', 'name_mother', 'job_mother'];

    protected $fillable = [
        'email',
        'password',
        'name_father',
        'job_father',
        'phone_father',
        'blood_type_father_id',
        'address_father',
        'name_mother',
        'job_mother',
        'phone_mother',
        'blood_type_mother_id',
        'address_mother',
    ];

    public $timestamps = true;

    public function attachment()
    {
        return $this->hasMany(ParentAttachment::class, 'parent_id', 'id');
    }
}
