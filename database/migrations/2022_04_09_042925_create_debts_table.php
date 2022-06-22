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
        Schema::create('debts', function (Blueprint $table) {
            // Debt ID
            $table->id();

            // For web search
            $table->string('debt_slug')->unique();

            // Detail description for debt
            $table->string('debt_description');

            // Foreign key for category
            $table->foreignId('debt_category_id');

            // Foreign key for account
            $table->foreignId('debt_account_id');

            // Entry date for debt
            $table->date('debt_entry_date')->nullable();

            // Debt total or nominal
            $table->integer('debt_nominal');

            // Debt timestamp
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
        Schema::dropIfExists('debts');
    }
};
