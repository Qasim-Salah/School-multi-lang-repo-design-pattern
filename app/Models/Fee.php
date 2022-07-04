<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fee extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'fees';

    public $translatable = ['title'];

    protected $fillable = [
        'title',
        'amount',
        'grade_id',
        'classroom_id',
        'year',
        'description',
        'type'
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
}
