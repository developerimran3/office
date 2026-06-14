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
        Schema::create('registers', function (Blueprint $table) {
            $table->id();


            // Copied Data (from Received)
            $table->string('importer_name');
            $table->string('total_quantity')->nullable();
            $table->string('pkgs_code')->nullable();
            $table->string('vessel')->nullable();
            $table->string('bl_no')->nullable();
            $table->string('lc_number')->nullable();
            $table->date('lc_date')->nullable();
            $table->decimal('gross_weight', 15, 3)->nullable();
            $table->date('arrival_date')->nullable();

            // FROM ENTY
            $table->json('items')->nullable();
            $table->json('containers')->nullable();
            // RECEIVED ONLY
            $table->date('document_receiver')->nullable();
            $table->string('rot_no')->nullable();
            $table->string('invoice_value')->nullable();
            $table->string('invoice_no')->nullable();
            $table->date('invoice_date')->nullable();

            // Register fields
            $table->string('be_no')->nullable();
            $table->date('be_date')->nullable();
            $table->string('be_lane')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registers');
    }
};
