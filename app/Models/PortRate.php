<?php

namespace App\Models;

use App\Models\BillGenerate;

use Illuminate\Database\Eloquent\Model;

class PortRate extends Model
{

    protected $fillable = [
        'river_duse_20',
        'river_duse_40',
        'river_duse_45',

        'lift_on_20',
        'lift_on_40',
        'lift_on_45',

        'lift_on_20_HQ',
        'lift_on_40_HQ',
        'lift_on_45_HQ',

        'extra_movement_20',
        'extra_movement_40',
        'extra_movement_45',

        'storage_1st_20',
        'storage_1st_40',
        'storage_1st_45',
        'storage_1st_20_dg',
        'storage_1st_40_dg',
        'storage_1st_45_dg',

        'storage_2nd_20',
        'storage_2nd_40',
        'storage_2nd_45',
        'storage_2nd_20_dg',
        'storage_2nd_40_dg',
        'storage_2nd_45_dg',

        'storage_3rd_20',
        'storage_3rd_40',
        'storage_3rd_45',
        'storage_3rd_20_dg',
        'storage_3rd_40_dg',
        'storage_3rd_45_dg',

        // LCL
        'river_duse_lcl',
        'storage_1st_lcl_lock',
        'storage_1st_lcl_lock_dg',
        'storage_1st_lcl_ware',
        'storage_1st_lcl_ware_dg',

        'storage_2nd_lcl_lock',
        'storage_2nd_lcl_lock_dg',
        'storage_2nd_lcl_ware',
        'storage_2nd_lcl_ware_dg',

        'storage_3rd_lcl_lock',
        'storage_3rd_lcl_lock_dg',
        'storage_3rd_lcl_ware',
        'storage_3rd_lcl_ware_dg',

        'rpc',
        'hc',
        'unstuffing',
    ];

    public function bills()
    {
        return $this->hasMany(BillGenerate::class);
    }
}
