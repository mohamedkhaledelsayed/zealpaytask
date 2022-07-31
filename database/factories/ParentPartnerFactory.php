<?php

namespace Database\Factories;

use App\Models\ParentBaby;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ParentPartner>
 */
class ParentPartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'parent_id'=>ParentBaby::inRandomOrder()->first()->id,
            'partner_id'=>$this->faker->randomDigitNot(1,10)
        ];
    }
}
