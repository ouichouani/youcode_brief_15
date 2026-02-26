<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    public function store(Expense $expense){

        foreach ($expense->users()->where('id' , '<>' , $expense->member_id)->pluck('users.id') as $member_id )
        {
            echo $member_id ;
            // return ;
        }
        // Payment::create([
        //     'expanse_id' => $expanse->id ,
        //     'amount' => $expanse->amount ,
        //     'member_id' => $member_id,
        // ])
    }
}
