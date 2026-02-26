<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    /** @use HasFactory<\Database\Factories\ColocationFactory> */
    use HasFactory;

    protected $fillable = [
        "name",
        "status"
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, "memberships", "colocation_id", "member_id")
            ->using(Membership::class)
            ->withPivot(['status', 'role'])
            ->withTimestamps()
            ->as('memberships');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'colocation_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'member_id');
    }
    
    public function categories(){
        return $this->hasMany(Category::class , 'colocation_id');
    }


}
