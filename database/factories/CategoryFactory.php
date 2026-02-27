<?php

namespace Database\Factories;

use App\Models\Colocation;
use App\Models\Membership;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {

        $Membership = Membership::where('status', 'valid')->where("role", "owner")->inRandomOrder()->first() ;
        $colocation_id = $Membership->colocation_id;

        return [
            'name' => fake()->name(),
            'colocation_id' => $colocation_id
        ];
    }
}
