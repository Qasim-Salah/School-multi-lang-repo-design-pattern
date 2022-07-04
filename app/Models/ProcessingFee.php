<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessingFee extends Model
{
    use HasFactory;

    protected $table = 'processing_fees';

    protected $fillable = [
        'date',
        'student_id',
        'amount',
        'description',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function student_account()
    {
        return $this->hasMany(StudentAccount::class, 'processing_id');
    }
}
