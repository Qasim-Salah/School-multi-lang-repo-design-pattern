<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeInvoices extends Model
{
    use HasFactory;

    protected $table = 'fee_invoices';

    protected $fillable = [
        'date',
        'student_id',
        'grade_id',
        'classroom_id',
        'fee_id',
        'amount',
        'description',
    ];

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

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function fees()
    {
        return $this->belongsTo(Fee::class, 'fee_id');
    }

    public function student_account()
    {
        return $this->hasMany(StudentAccount::class,'fee_invoice_id');
    }

}
