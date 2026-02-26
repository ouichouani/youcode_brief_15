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
        $category = null ;
        do{
            $membership = Membership::inRandomOrder()->first();
            $colocation = $membership->colocation->id ;
            $member = $membership->user->id ;
            $category = $membership->colocation->categories()->inRandomOrder()->first()?->id ;
        }while(empty($category)) ;


        return [
            "title" => fake()->word() ,
            "colocation_id" => $colocation ,
            "member_id" => $member ,
            "category_id" => $category ,
            "amount" => fake()->randomFloat(2 , 10 , 1000) 
        ];
    }
}
