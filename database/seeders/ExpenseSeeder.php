<?php

namespace Database\Seeders;

use App\Http\Controllers\PaymentController;
use App\Models\Expense;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    public function run(): void
    {
        $expenses = Expense::factory(10)->create();

        foreach ($expenses as $exp) {
            $members = $exp->colocation->users;
            $count = $members->count(); 
            $share = $exp->amount / $count; 

            foreach ($members as $member) {
                Payment::create([
                    'expense_id' => $exp->id,
                    'member_id'  => $member->id,
                    'amount'     => $share,
                    'is_paied'   => $member->id === $exp->member_id ? true : false, // optional: mark creator as paid
                ]);
            }
        }
    }
}