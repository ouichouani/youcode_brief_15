<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Colocation>
 */
class ColocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $owner = User::where("ismember" , false)->inRandomOrder()->first() ;
        if($owner){
            $owner->ismember = true ;
            $owner->save() ;
        }

        return [
            "owner" => $owner?->id ,
            "name" => fake()->name() ,
            "status" => "active" ,
        ];
    }
}
