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
        Schema::create('expense_categories', function (Blueprint $table) {
            // Category account ID
            $table->id();

            // Category account slug
            $table->string('excat_slug')->nullable();

            // Category account name 
            $table->string('name')->unique();

            // Category entry date
            $table->date('excat_entry_date')->nullable();

            // Category timestamps
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
        Schema::dropIfExists('expense_categories');
    }
};
