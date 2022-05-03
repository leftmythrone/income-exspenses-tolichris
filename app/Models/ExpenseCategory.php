<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;


class ExpenseCategory extends Model
{
    use HasFactory;

    public function expenses()
    {
        return $this->HasMany(Expense::class, 'expense_category_id', 'id');
    }
    
    // GUARDING IMPORTANT
    protected $guarded = ['id'];
}
