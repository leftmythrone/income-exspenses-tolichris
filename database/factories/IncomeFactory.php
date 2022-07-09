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
            // Factory for description
            'income_description' => $this->faker->sentence(mt_rand(1,3)),
            
            // Factory for category foreign key
            'income_category_id' => $this->faker->numberBetween($min = 1, $max = 3),
            
            // Factory for account ID
            'income_account_id' => $this->faker->numberBetween($min = 1, $max = 4),
            
            // Factory for slug
            'income_slug' => uniqid('gfg', true),
            
            // Factory for nominal
            'income_nominal' => $this->faker->numberBetween($min = 50000, $max = 3000000),
            
            // Factory for entry date
            'income_entry_date' => $this->faker->dateTimeThisMonth()
        ];
    }
}
