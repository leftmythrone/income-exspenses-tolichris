<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;


class Income extends Model
{
    use HasFactory;

    public function income_category()
    {
        return $this->belongsTo(\App\Models\IncomeCategory::class, 'income_category_id');
    }

    // GUARDING IMPORTANT
    protected $guarded = ['id'];
}
