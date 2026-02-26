<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /** @use HasFactory<\Database\Factories\ExpenseFactory> */
    use HasFactory;


    protected $fillable = [
        'title',
        'amount',
        "colocation_id",
        'member_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function colocation()
    {
        return $this->belongsTo(Colocation::class, "colocation_id");
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'expense_id');
    }
}
