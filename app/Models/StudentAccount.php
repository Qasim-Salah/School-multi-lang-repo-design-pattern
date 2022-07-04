<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAccount extends Model
{
    use HasFactory;

    protected $table = 'student_accounts';

    protected $fillable = [
        'date',
        'type',
        'fee_invoice_id',
        'receipt_id',
        'processing_id',
        'payment_id',
        'student_id',
        'debit',
        'credit',
        'description',
    ];
}
