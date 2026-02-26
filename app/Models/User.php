<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'image',
        'ismember'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function colocations()
    {
        return $this->belongsToMany(Colocation::class , "memberships" , "member_id" ,"colocation_id"  )
        ->using(Membership::class)
        ->withPivot(['status' , 'role'])
        ->withTimestamps()
        ->as('memberships') ;
    }

    public function expenses(){
        return $this->hasMany(Expense::class , 'member_id') ;
    }

    
    public function payments()
    {
        return $this->hasMany(Payment::class, 'member_id');
    }

}
