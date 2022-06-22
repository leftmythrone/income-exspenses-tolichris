<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            // Expense ID
            $table->id();

            // For web search
            $table->string('expense_slug')->unique();

            // Detail description for expense
            $table->string('expense_description');

            // Foreign key for category
            $table->foreignId('expense_category_id');

            // Foreign key for account
            $table->foreignId('expense_account_id');

            // Entry date for expense
            $table->date('expense_entry_date')->nullable();

            // Expense total or nominal
            $table->integer('expense_nominal');

            // Expense timestamp
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
};
