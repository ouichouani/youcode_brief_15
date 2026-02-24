<?php

namespace Database\Factories;

use App\Models\Colocation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $reseaver = User::where('ismember', false)->inRandomOrder()->first() ;
        $colocation = Colocation::inRandomOrder()->first()->id ;
        
        if($reseaver){
            $reseaver->ismember = true ;
            $reseaver->save() ;
        }

        return [
            'reseaver' => $reseaver->id ,
            'colocation' => $colocation ,
            'status' => fake()->randomElement(['pending', 'accepted', 'rejected'])
        ];
    }
}
