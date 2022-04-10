<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeCategory extends Model
{
    use HasFactory;

    public function income()
    {
        return $this->HasMany(Income::class);
    }

    // GUARDING IMPORTANT
    protected $guarded = ['id'];
}
