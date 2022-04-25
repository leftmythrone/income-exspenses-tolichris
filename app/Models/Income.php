<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class Income extends Model
{
    use HasFactory;

    // public static function inc_token($token)
    // {

    //     $setoken = IncomeCategory::where('nominal', 'LIKE', '%1817910%');
    //     return ;
    // }

    public function income_category()
    {
        return $this->belongsTo(\App\Models\IncomeCategory::class, 'income_category_id');
    }

    // GUARDING IMPORTANT
    protected $guarded = ['id'];
}
