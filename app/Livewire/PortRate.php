<?php

namespace App\Livewire;

use App\Models\PortRate as PortBill;
use Livewire\Component;

class PortRate extends Component
{
    public $river_duse_20 = 5.41;
    public $river_duse_40 = 10.82;
    public $river_duse_45 = 12.18;

    // lift on (8.5)
    public $lift_on_20 = 10;
    public $lift_on_40 = 15;
    public $lift_on_45 = 23.23;

    // lift on (9.5)
    public $lift_on_20_HQ = 20;
    public $lift_on_40_HQ = 30;
    public $lift_on_45_HQ = 46.46;

    public $extra_movement_20 = 45.46;
    public $extra_movement_40 = 68.19;
    public $extra_movement_45 = 76.72;


    public $storage_1st_20 = 6.9;
    public $storage_1st_40 = 13.8;
    public $storage_1st_45 = 15.53;

    public $storage_1st_20_dg = 27.6;
    public $storage_1st_40_dg = 55.2;
    public $storage_1st_45_dg = 62.12;

    public $storage_2nd_20 = 13.8;
    public $storage_2nd_40 = 27.6;
    public $storage_2nd_45 = 31.05;

    public $storage_2nd_20_dg = 55.2;
    public $storage_2nd_40_dg = 110.4;
    public $storage_2nd_45_dg = 124.02;

    public $storage_3rd_20 = 27.6;
    public $storage_3rd_40 = 55.2;
    public $storage_3rd_45 = 62.12;

    public $storage_3rd_20_dg = 110.4;
    public $storage_3rd_40_dg = 220.8;
    public $storage_3rd_45_dg = 248.48;

    // LCL
    public $river_duse_lcl = 0.443;
    public $storage_1st_lcl_lock = 0.681;
    public $storage_1st_lcl_lock_dg = 2.724;

    public $storage_1st_lcl_ware = 0.619;
    public $storage_1st_lcl_ware_dg = 2.476;

    public $storage_2nd_lcl_lock = 2.043;
    public $storage_2nd_lcl_lock_dg = 8.172;

    public $storage_2nd_lcl_ware = 1.857;
    public $storage_2nd_lcl_ware_dg = 7.428;

    public $storage_3rd_lcl_lock = 2.724;
    public $storage_3rd_lcl_lock_dg = 10.896;

    public $storage_3rd_lcl_ware = 2.476;
    public $storage_3rd_lcl_ware_dg = 9.904;

    public $rpc = 7.5;
    public $hc = 5.42;
    public $unstuffing = 5.42;

    public $portRate;


    /**
     * Save
     */
    public function save()
    {
        $portBill = PortBill::first();

        $data = [
            // River Dues
            'river_duse_20' => $this->river_duse_20,
            'river_duse_40' => $this->river_duse_40,
            'river_duse_45' => $this->river_duse_45,

            // Lift On (8.5)
            'lift_on_20' => $this->lift_on_20,
            'lift_on_40' => $this->lift_on_40,
            'lift_on_45' => $this->lift_on_45,
            // Lift On (9.5)
            'lift_on_20_HQ' => $this->lift_on_20_HQ,
            'lift_on_40_HQ' => $this->lift_on_40_HQ,
            'lift_on_45_HQ' => $this->lift_on_45_HQ,

            // Extra Movement
            'extra_movement_20' => $this->extra_movement_20,
            'extra_movement_40' => $this->extra_movement_40,
            'extra_movement_45' => $this->extra_movement_45,

            // Storage (FCL)
            'storage_1st_20' => $this->storage_1st_20,
            'storage_1st_40' => $this->storage_1st_40,
            'storage_1st_45' => $this->storage_1st_45,

            'storage_1st_20_dg' => $this->storage_1st_20_dg,
            'storage_1st_40_dg' => $this->storage_1st_40_dg,
            'storage_1st_45_dg' => $this->storage_1st_45_dg,

            'storage_2nd_20' => $this->storage_2nd_20,
            'storage_2nd_40' => $this->storage_2nd_40,
            'storage_2nd_45' => $this->storage_2nd_45,

            'storage_2nd_20_dg' => $this->storage_2nd_20_dg,
            'storage_2nd_40_dg' => $this->storage_2nd_40_dg,
            'storage_2nd_45_dg' => $this->storage_2nd_45_dg,

            'storage_3rd_20' => $this->storage_3rd_20,
            'storage_3rd_40' => $this->storage_3rd_40,
            'storage_3rd_45' => $this->storage_3rd_45,

            'storage_3rd_20_dg' => $this->storage_3rd_20_dg,
            'storage_3rd_40_dg' => $this->storage_3rd_40_dg,
            'storage_3rd_45_dg' => $this->storage_3rd_45_dg,

            // (LCL)
            'river_duse_lcl' => $this->river_duse_lcl,

            'storage_1st_lcl_lock' => $this->storage_1st_lcl_lock,
            'storage_1st_lcl_ware' => $this->storage_1st_lcl_ware,
            'storage_1st_lcl_lock_dg' => $this->storage_1st_lcl_lock_dg,
            'storage_1st_lcl_ware_dg' => $this->storage_1st_lcl_ware_dg,

            'storage_2nd_lcl_lock' => $this->storage_2nd_lcl_lock,
            'storage_2nd_lcl_ware' => $this->storage_2nd_lcl_ware,
            'storage_2nd_lcl_lock_dg' => $this->storage_2nd_lcl_lock_dg,
            'storage_2nd_lcl_ware_dg' => $this->storage_2nd_lcl_ware_dg,

            'storage_3rd_lcl_lock' => $this->storage_3rd_lcl_lock,
            'storage_3rd_lcl_ware' => $this->storage_3rd_lcl_ware,
            'storage_3rd_lcl_lock_dg' => $this->storage_3rd_lcl_lock_dg,
            'storage_3rd_lcl_ware_dg' => $this->storage_3rd_lcl_ware_dg,

            // Other Charges
            'rpc' => $this->rpc,
            'hc' => $this->hc,
            'unstuffing' => $this->unstuffing,
        ];

        if ($portBill) {
            // ✅ UPDATE ONLY
            $portBill->update($data);
            session()->flash('message', 'Port Bill updated successfully!');
        } else {
            // ✅ CREATE ONLY FIRST TIME
            PortBill::create($data);
            session()->flash('message', 'Port Bill created successfully!');
        }
    }

    public function mount()
    {
        $portBill = PortBill::first();

        if ($portBill) {
            $this->fill($portBill->toArray());
        }
    }


    public function render()
    {
        return view('livewire.port-rate')
            ->layout('layouts.app', ['title' => 'Port Rate']);
    }
}
