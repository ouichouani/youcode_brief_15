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

        // $reseaver = User::where('ismember', false)->inRandomOrder()->first() ;
        $reseaver = User::inRandomOrder()->first() ; // test
        if(empty($reseaver)) dd("no free users left ...") ;
        // $colocation_id = Colocation::inRandomOrder()->first()->id ;
        $colocation_id = 127 ; // test
        
        // if($reseaver){
        //     $reseaver->ismember = true ;
        //     $reseaver->save() ;
        // }

        return [
            'user_id' => $reseaver->id ,
            'colocation_id' => $colocation_id ,
            // 'status' => fake()->randomElement(['pending', 'accepted', 'rejected'])
            'status' => 'pending'
        ];
    }
}
