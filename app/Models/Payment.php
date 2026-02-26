<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;


    protected $fillable = [
        'expense_id',
        "member_id",
        'amount',
        'is_paied',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function colocations()
    {
        return $this->belongsTo(Colocation::class, "colocation_id");
    }

    public function expense()
    {
        return $this->belongsTo(Expense::class, 'expense_id');
    }
}
