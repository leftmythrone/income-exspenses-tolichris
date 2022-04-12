<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    use HasFactory;

    public function expenses()
    {
        return $this->HasMany(Expense::class, 'income_category_id');
    }
    
    // GUARDING IMPORTANT
    protected $guarded = ['id'];
}
