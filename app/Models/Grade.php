<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use  HasFactory, HasTranslations;

    protected $table = 'grades';

    protected $fillable = [
        'name',
        'notes',
    ];

    public $timestamps = true;

    public $translatable = ['name'];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

}
