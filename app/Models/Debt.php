<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class Debt extends Model
{
    use HasFactory;

    public function debt_cat()
    {
        return $this->belongsTo(DebtCategory::class, 'debt_category_id', 'id');
    }

    // GUARDING IMPORTANT
    protected $guarded = ['id'];
}
