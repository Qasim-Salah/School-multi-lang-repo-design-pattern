<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'date',
        'student_id',
        'amount',
        'description',
    ];

    public function student()
    {
        return $this->belongsTo(Section::class, 'student_id');
    }

    public function student_account()
    {
        return $this->hasMany(StudentAccount::class, 'payment_id');
    }

    public function fund_account()
    {
        return $this->hasMany(FundAccount::class, 'payment_id');
    }
}
