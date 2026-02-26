<?php

namespace Database\Factories;

use App\Models\Colocation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Membership>
 */
class MembershipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $member = User::where('ismember', false)->inRandomOrder()->first() ;
        $colocation = Colocation::inRandomOrder()->first()->id ;


        if($member){
            $member->ismember = true ;
            $member->save() ;
        }

        return [
            "colocation_id" => $colocation ,
            "member_id" => $member->id ,
            "role" => fake()->randomElement(['owner' , 'member']) ,
            "status" => "valid" ,
        ];
    }
}
