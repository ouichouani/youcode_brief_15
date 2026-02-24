<?php

namespace Database\Factories;

use App\Models\Colocation;
use App\Models\Expense;
use App\Models\Membership;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $expense = null ;
        $member = null ;

        while (1) {

            $membership = Membership::inRandomOrder()->first();
            $member = $membership->member()->id;
            $colocation = $membership->colocation()->id;

            $expense = Expense::where('colocation', $colocation)->pluck('id');
            if (!empty($expense)) {
                foreach ($expense as $exp) {
                    if (Payment::where('expense_id', $exp)->where("member" , $member)->where('colocation', $colocation)->exists()) {
                        $expense = $exp ;
                        break ;
                    }
                }
            }
        }


        return [
            "expense_id" => $expense,
            "member" => $member 
        ];
    }
}
