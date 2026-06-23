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
        Schema::create('port_rates', function (Blueprint $table) {
            $table->id();

            $table->decimal('river_duse_20')->default(5.41);
            $table->decimal('river_duse_40')->default(10.82);
            $table->decimal('river_duse_45')->default(12.18);


            $table->decimal('lift_on_20')->default(10);
            $table->decimal('lift_on_20_HQ')->default(20);

            $table->decimal('lift_on_40')->default(15);
            $table->decimal('lift_on_40_HQ')->default(30);

            $table->decimal('lift_on_45')->default(23.23);
            $table->decimal('lift_on_45_HQ')->default(46.46);


            $table->decimal('extra_movement_20')->default(45.46);
            $table->decimal('extra_movement_40')->default(68.19);
            $table->decimal('extra_movement_45')->default(76.72);


            $table->decimal('storage_1st_20')->default(6.9);
            $table->decimal('storage_1st_40')->default(13.8);
            $table->decimal('storage_1st_45')->default(15.53);

            $table->decimal('storage_1st_20_dg')->default(27.6);
            $table->decimal('storage_1st_40_dg')->default(55.2);
            $table->decimal('storage_1st_45_dg')->default(62.12);


            $table->decimal('storage_2nd_20')->default(13.8);
            $table->decimal('storage_2nd_40')->default(27.6);
            $table->decimal('storage_2nd_45')->default(31.05);

            $table->decimal('storage_2nd_20_dg')->default(55.2);
            $table->decimal('storage_2nd_40_dg')->default(110.4);
            $table->decimal('storage_2nd_45_dg')->default(124.02);


            $table->decimal('storage_3rd_20')->default(27.6);
            $table->decimal('storage_3rd_40')->default(55.2);
            $table->decimal('storage_3rd_45')->default(62.12);

            $table->decimal('storage_3rd_20_dg')->default(110.4);
            $table->decimal('storage_3rd_40_dg')->default(220.8);
            $table->decimal('storage_3rd_45_dg')->default(248.48);

            // LCL 
            $table->decimal('river_duse_lcl')->default(0.443);

            $table->decimal('storage_1st_lcl_lock')->default(.681);
            $table->decimal('storage_1st_lcl_lock_dg')->default(2.724);

            $table->decimal('storage_1st_lcl_ware')->default(.619);
            $table->decimal('storage_1st_lcl_ware_dg')->default(2.476);

            $table->decimal('storage_2nd_lcl_lock')->default(2.043);
            $table->decimal('storage_2nd_lcl_lock_dg')->default(8.172);

            $table->decimal('storage_2nd_lcl_ware')->default(1.857);
            $table->decimal('storage_2nd_lcl_ware_dg')->default(7.428);

            $table->decimal('storage_3rd_lcl_lock')->default(2.724);
            $table->decimal('storage_3rd_lcl_lock_dg')->default(10.896);

            $table->decimal('storage_3rd_lcl_ware')->default(2.476);
            $table->decimal('storage_3rd_lcl_ware_dg')->default(9.904);


            $table->decimal('rpc')->default(7.5);
            $table->decimal('hc')->default(5.42);
            $table->decimal('unstuffing')->default(5.42);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('port_rates');
    }
};
