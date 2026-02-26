<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Membership extends Pivot
{
    /** @use HasFactory<\Database\Factories\MembershipFactory> */
    use HasFactory;

    protected $table = 'memberships' ;

    protected $fillable = [
        
        'member_id',
        "colocation_id",
        'status',
        'role'
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function colocation()
    {
        return $this->belongsTo(Colocation::class, "colocation_id");
    }
}
