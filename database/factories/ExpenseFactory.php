<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{    
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */

   protected $model = Expense::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            // Factory for description
            'expense_description' => $this->faker->sentence(mt_rand(1,3)),
            
            // Factory for category foreign key
            'expense_category_id' => $this->faker->numberBetween($min = 1, $max = 1),
                        
            // Factory for account ID
            'expense_account_id' => $this->faker->numberBetween($min = 1, $max = 4),
                        
            // Factory for slug
            'expense_slug' => $this->faker->numberBetween($min = 50000, $max = 3000000),
                        
            // Factory for nominal
            'expense_nominal' => $this->faker->numberBetween($min = 50000, $max = 3000000),
                        
            // Factory for entry date
            'expense_entry_date' => $this->faker->dateTimeThisMonth() 
        ];
    }
}
