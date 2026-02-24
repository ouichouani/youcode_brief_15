<?php

namespace Database\Factories;

use App\Models\Membership;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $membership = Membership::inRandomOrder()->first();
        $colocation = $membership->colocation()->id ;
        $member = $membership->member()->id ;

        return [
            "colocation_id" => $colocation ,
            "member_id" => $member ,
            "amount" => fake()->randomFloat(2 , 10 , 1000) 
        ];
    }
}
