<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    /** @use HasFactory<\Database\Factories\RequestFactory> */
    use HasFactory;

    protected $fillable = [
        'state' ,
        "member_id" ,
        "colocation_id"
    ];

    public function users(){
        return $this->belongsTo(User::class , "member_id") ;
    }
    
    public function colocations(){
        return $this->belongsTo(Colocation::class , "colocation_id") ;
    }
}
