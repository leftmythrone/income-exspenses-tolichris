<?php

namespace Database\Factories;

use App\Models\Income;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Income>
 */

$catuid = uniqid('gfg', true);

class IncomeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    protected $model = Income::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'income_description' => $this->faker->sentence(mt_rand(1,3)),
            'income_category_id' => $this->faker->numberBetween($min = 1, $max = 3),
            'income_slug' => $this->faker->numberBetween($min = 50000, $max = 3000000),
            'nominal' => $this->faker->numberBetween($min = 50000, $max = 3000000), 
        ];
    }
}
