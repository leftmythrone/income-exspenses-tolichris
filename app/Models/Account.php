<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public function inaccount()
    {
        return $this->HasMany(Income::class, 'income_account_id');
    }

    public function exaccount()
    {
        return $this->HasMany(Expense::class, 'expense_account_id');
    }

    protected $guarded = ['id'];

}
