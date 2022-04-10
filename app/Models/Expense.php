<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class Expense extends Model
{
    use HasFactory;

    // GUARDING IMPORTANT
    protected $guarded = ['id'];

    public function expense_categories()
    {
        return $this->belongsTo(Kategori::class);
    }
}
