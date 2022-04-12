<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class Debt extends Model
{
    use HasFactory;

    public function debt_category()
    {
        return $this->belongsTo(\App\Models\DebtCategory::class, 'debt_category_id');
    }

    // GUARDING IMPORTANT
    protected $guarded = ['id'];
}
