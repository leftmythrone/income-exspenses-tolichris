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
        Schema::create('incomes', function (Blueprint $table) {
            // Income ID
            $table->id();

            // For web search
            $table->string('income_slug')->unique();

            // Detail description for income
            $table->string('income_description');

            // Foreign key for category
            $table->foreignId('income_category_id');

            // Foreign key for account
            $table->foreignId('income_account_id');

            // Entry date for income
            $table->date('income_entry_date')->nullable();

            // Income total or nominal
            $table->integer('income_nominal');

            // Income Timestamp
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
        Schema::dropIfExists('incomes');
    }
};
