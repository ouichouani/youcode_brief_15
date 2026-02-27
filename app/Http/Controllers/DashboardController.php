<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Membership;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // $user = User::inRandomOrder()->first();
        $membershipe = Membership::where('member_id' , $user->id )->orderBy('created_at')->first()?->status ;
        $colocations = $user->colocations;
        $total_users = User::count();
        $total_expense = Expense::sum('amount');
        $total_payment = Payment::where('is_paied', true)->sum('amount');
        $avg_rate = User::avg("reputation");

        foreach ($colocations as $colocation) {
            $colocation->owner_user = User::find($colocation->owner);
        }

        return view('dashboard', compact('colocations', 'total_users', 'total_expense', 'total_payment', 'avg_rate' , 'membershipe'));
    }
}
