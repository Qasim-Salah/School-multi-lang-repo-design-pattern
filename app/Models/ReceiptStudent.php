<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptStudent extends Model
{
    use HasFactory;

    protected $table = 'receipt_students';

    protected $fillable = [

        'date',
        'student_id',
        'debit',
        'description',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function student_account()
    {
        return $this->hasMany(StudentAccount::class, 'receipt_id');
    }

    public function fund_account()
    {
        return $this->hasMany(FundAccount::class, 'receipt_id');
    }
}
