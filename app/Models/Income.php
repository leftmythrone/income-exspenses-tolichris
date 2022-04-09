<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;


class Income extends Model
{
    use HasFactory;


    // GUARDING IMPORTANT
    protected $guarded = ['id'];
}
