<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebtCategory extends Model
{
    use HasFactory;

    public function debts()
    {
        return $this->HasMany(Debt::class, 'debt_category_id');
    }

    // GUARDING IMPORTANT
    protected $guarded = ['id'];
}
