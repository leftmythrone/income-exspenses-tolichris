<?php

namespace Database\Factories;

use App\Models\Debt;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Debt>
 */
class DebtFactory extends Factory
{    
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
   protected $model = Debt::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // Factory for description
            'debt_description' => $this->faker->sentence(mt_rand(1,3)),
            
            // Factory for category foreign key
            'debt_category_id' => $this->faker->numberBetween($min = 1, $max = 1),
                        
            // Factory for account ID
            'debt_account_id' => $this->faker->numberBetween($min = 1, $max = 4),
                        
            // Factory for slug
            'debt_slug' => $this->faker->numberBetween($min = 50000, $max = 3000000),
                        
            // Factory for nominal
            'nominal' => $this->faker->numberBetween($min = 50000, $max = 3000000),
                        
            // Factory for entry date
            'debt_entry_date' => $this->faker->dateTimeThisMonth()
        ];
    }
}
