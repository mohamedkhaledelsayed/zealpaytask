<?php

namespace Database\Factories;

use App\Models\ParentBaby;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Baby>
 */
class BabyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name(),
            'parent_id'=>ParentBaby::inRandomOrder()->first()->id,

        ];
    }
}
