<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create()
    {
        return view('payment.create');
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|min:3|max:50',
                'owner' => 'required|int|min:1',
            ]);

            Payment::created([
                'name' => $request->name,
                'owner' => $request->colocation_id,
            ]);
        } catch (Exception $e) {
            dd('error');
        }
    }


    public function delete(int $id)
    {
        return Expense::find($id)->delete();
    }
}
