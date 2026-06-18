<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('janatas', function (Blueprint $table) {
            $table->id();
            // For Cash/B/E type
            $table->string('type'); // CASH বা BE            
            // B/E fields
            $table->json('items')->nullable();
            $table->string('importer_name')->nullable();
            $table->string('be_no')->nullable();
            $table->date('be_date')->nullable();
            $table->decimal('debit', 15, 2)->default(0);
            // Cash fields
            $table->decimal('credit', 15, 2)->default(0);
            $table->date('credit_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('janatas');
    }
};
