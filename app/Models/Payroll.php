<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payroll extends Model
{
    protected $table = 'payroll';
    protected $fillable = [
        'employee_id',
        'basic_salary',
        'status',
        'payment_date'
    ];

    protected $casts = [
        'payment_date' => 'date',
        'basic_salary' => 'decimal:2'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
} 