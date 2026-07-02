<?php

namespace App\Livewire;


use Carbon\Carbon;
use Livewire\Component;
use App\Models\PortRate;
use App\Models\BillGenerate;




class PortBillGenarate extends Component
{
    public $cl_date;
    public $unstf_date;
    public $wr_date;
    public $upto_date;
    public $ado_dt;
    public $qty;
    public $rate;

    public $extra_mov;
    public $extra_mov_qty;

    public $rpc;
    public $rpc_qty;

    public $hc;
    public $hc_qty;

    public $dg_status;
    public $cont_select;
    public $lift_type;
    public $days;
    public $usd_rate;

    public $cont; // 20fcl, 40fcl, lockfast, warehouse
    public $portRates;


    public $calculated = []; // Calculated table values

    // CL_DT বা UNSTF_DT পরিবর্তন হলে W/R এবং ADO সেট করার জন্য

    public function updatedClDate($value)
    {
        $this->setWrAndAdo($value);
    }

    public function updatedUnstDate($value)
    {
        $this->setWrAndAdo($value);
    }

    public function setWrAndAdo($value)
    {
        if ($value) {
            $this->wr_date = Carbon::parse($value)
                ->addDays(3)
                ->format('Y-m-d');

            $this->ado_dt = $this->wr_date;
        }
    }

    public function updatedUptoDate($value)
    {
        if ($this->wr_date && $value) {
            $from = Carbon::parse($this->wr_date);
            $to   = Carbon::parse($value);

            $this->days = $from->diffInDays($to);
        }
    }


    public function updatedQty($value)
    {
        $this->syncRpc($value);
    }


    public function syncRpc($value)
    {
        if ($value) {
            // auto set rpc = qty
            $this->rpc = (int) $value;
        }
    }

    public function updatedRpc($value)
    {
        if ($value < $this->qty) {
            $this->rpc = $this->qty;
        }
    }


    // Form submit
    public function createEnty()
    {

        $this->validate([
            'cl_date'     => 'required|date',
            'upto_date'   => 'required|date',
            'qty'         => 'required|numeric|min:1',
            'cont_select' => 'required|string',
            'lift_type'   => 'required'
        ]);

        $this->calculate();


        // BillGenerate::create([
        //     'port_rate_id' => $this->portRates->id,


        //     'cl_date'       => $this->cl_date,
        //     'wr_date'       => $this->wr_date,
        //     'upto_date'     => $this->upto_date,
        //     'unstf_date'    => $this->unstf_date ?? null,
        //     'extra_mov_qty' => $this->extra_mov_qty ?? 0,
        //     'hc_qty'        => $this->hc_qty ?? 0,
        //     'rpc_qty'       => $this->rpc_qty ?? 0,
        //     'qty'           => $this->qty ?? 1,
        //     'usd_rate'      => $this->usd_rate ?? 123.50,
        //     'cont_select'   => $this->cont_select,
        //     'dg_status'     => $this->dg_status ?? 0,
        // ]);

        session()->flash('message', 'Port Bill Generated Successfully');
    }


    public function updated($field)
    {
        if (
            in_array($field, [
                'cont_select',
                'qty',
                'days',
                'dg_status',
                'extra_mov',
                'hc',
                'rpc'
            ])
        ) {
            $this->calculate();
        }
    }




    // Calculation logic
    public function calculate()
    {
        if (!$this->portRates) {
            return;
        }

        $usd_rate = (float) ($this->portRates->usd_rate ?? 1);

        $is20 = $this->cont_select == '20fcl';
        $is40 = $this->cont_select == '40fcl';
        $is45 = $this->cont_select == '45fcl';
        $isDg = $this->dg_status == 1;





        // Container Rate
        if ($is40) {
            $rate = $this->portRates->river_duse_40;
        } elseif ($is45) {
            $rate = $this->portRates->river_duse_45;
        } elseif ($is20) {
            $rate = $this->portRates->river_duse_20;
        } else {
            $rate = $this->portRates->river_duse_lcl;
        }



        // Lift on rate select

        if ($this->lift_type == 8.5) {

            if ($is40) {
                $lift = $this->portRates->lift_on_40;
            } elseif ($is45) {
                $lift = $this->portRates->lift_on_45;
            } else {
                $lift = $this->portRates->lift_on_20;
            }
        } else {

            if ($is40) {
                $lift = $this->portRates->lift_on_40_HQ;
            } elseif ($is45) {
                $lift = $this->portRates->lift_on_45_HQ;
            } else {
                $lift = $this->portRates->lift_on_20_HQ;
            }
        }




        if ($is40) {
            $extra_mov = $this->portRates->extra_movement_40;
        } elseif ($is45) {
            $extra_mov = $this->portRates->extra_movement_45;
        } else {
            $extra_mov = $this->portRates->extra_movement_20;
        }






        // Storage Rate 1

        if ($is40) {

            if ($isDg) {
                $storage_1 = $this->portRates->storage_1st_40_dg;
            } else {
                $storage_1 = $this->portRates->storage_1st_40;
            }
        } elseif ($is45) {

            if ($isDg) {
                $storage_1 = $this->portRates->storage_1st_45_dg;
            } else {
                $storage_1 = $this->portRates->storage_1st_45;
            }
        } else {

            if ($isDg) {
                $storage_1 = $this->portRates->storage_1st_20_dg;
            } else {
                $storage_1 = $this->portRates->storage_1st_20;
            }
        }


        // Storage Rate 2
        if ($is40) {

            if ($isDg) {
                $storage_2 = $this->portRates->storage_2nd_40_dg;
            } else {
                $storage_2 = $this->portRates->storage_2nd_40;
            }
        } elseif ($is45) {

            if ($isDg) {
                $storage_2 = $this->portRates->storage_2nd_45_dg;
            } else {
                $storage_2 = $this->portRates->storage_2nd_45;
            }
        } else {

            if ($isDg) {
                $storage_2 = $this->portRates->storage_2nd_20_dg;
            } else {
                $storage_2 = $this->portRates->storage_2nd_20;
            }
        }

        // Storage Rate 3
        if ($is40) {

            if ($isDg) {
                $storage_3 = $this->portRates->storage_3rd_40_dg;
            } else {
                $storage_3 = $this->portRates->storage_3rd_40;
            }
        } elseif ($is45) {

            if ($isDg) {
                $storage_3 = $this->portRates->storage_3rd_45_dg;
            } else {
                $storage_3 = $this->portRates->storage_3rd_45;
            }
        } else {

            if ($isDg) {
                $storage_3 = $this->portRates->storage_3rd_20_dg;
            } else {
                $storage_3 = $this->portRates->storage_3rd_20;
            }
        }



        // $storage_2 = $is40
        //     ? ($isDg ? $this->portRates->storage_2nd_40_dg : $this->portRates->storage_2nd_40)
        //     : ($isDg ? $this->portRates->storage_2nd_20_dg : $this->portRates->storage_2nd_20);


        // $storage_3 = $is40
        //     ? ($isDg ? $this->portRates->storage_3rd_40_dg : $this->portRates->storage_3rd_40)
        //     : ($isDg ? $this->portRates->storage_3rd_20_dg : $this->portRates->storage_3rd_20);


        $qty  = (float) $this->qty;
        $days = (int) $this->days;




        // River Dues
        $river_dues = $qty * $rate;


        // Lift On
        $lift_on = $qty * $lift;


        // RPC

        $rpc_rate = (float) ($this->portRates->rpc ?? 0);
        $rpc = (float) $this->rpc;

        // Extra Charges
        $extra_mov_rate = $extra_mov;
        $extra_mov = (float) ($this->extra_mov);

        $hc_rate = (float) ($this->portRates->hc ?? 0);
        $hc = (float) ($this->hc ?? 0);



        // Storage Calculation
        $store_rent_1_days = 0;
        $store_rent_2_days = 0;
        $store_rent_3_days = 0;


        $store_rent_1_amount = 0;
        $store_rent_2_amount = 0;
        $store_rent_3_amount = 0;

        // 1st slab (1-7)
        if ($days > 0) {

            $store_rent_1_days = min($days, 7);

            $store_rent_1_amount =
                $storage_1 * $qty * $store_rent_1_days;
        }

        // 2nd slab (8-20)
        // আবার 1 থেকে count হবে

        if ($days > 7) {


            $store_rent_2_days = min($days - 7, 13);


            $store_rent_2_amount =
                $storage_2 * $qty * $store_rent_2_days;
        }

        // 3rd slab (21+)
        // আবার 1 থেকে count হবে

        if ($days > 20) {

            $store_rent_3_days = ($days - 20) + 4;

            $store_rent_3_amount =
                $storage_3 * $qty * $store_rent_3_days * 4;
        } else {

            $store_rent_3_days = 0;
            $store_rent_3_amount = 0;
        }




        $store_rent_total =
            $store_rent_1_amount
            +
            $store_rent_2_amount
            +
            $store_rent_3_amount;




        // Total
        $total_port =
            (float) ($river_dues * (float)$this->usd_rate)
            + (float)($lift_on  * (float)$this->usd_rate)
            + (float) $rpc_rate * $rpc
            + (float)($store_rent_total * (float)$this->usd_rate)
            + (float)($extra_mov_rate * (float)$this->extra_mov * (float)$this->usd_rate)
            + (float)$hc_rate * (float)$this->hc * (float)$this->usd_rate;

        $vat = $total_port * 0.15;
        $mlwf = $river_dues * (float)$this->usd_rate * 0.04;

        $gross =  $total_port + $vat +  $mlwf;





        $display_days = $days;

        if ($days > 20) {
            $display_days = ($days - 20) + 4 + 20;
        }


        $this->calculated = [


            'display_days' => $display_days,
            'river_dues' => $river_dues,

            'lift_on' => $lift_on,

            'store_rent_1' => $storage_1,
            'store_rent_2' => $storage_2,
            'store_rent_3' => $storage_3,

            'hc' => $hc,
            'hc_rate' => $hc_rate,

            'usd_rate' => $usd_rate,   // <-- add this

            'total_port' => $total_port,
            'vat' => $vat,
            'mlwf' => $mlwf,
            'gross' => $gross,

            'extra_mov' => $extra_mov,
            'extra_mov_rate' => $extra_mov_rate,

            'rpc' => $rpc,
            'rpc_rate' => $rpc_rate,


            'days' => $this->days,

            'store_rent_1_days' => $store_rent_1_days,
            'store_rent_2_days' => $store_rent_2_days,
            'store_rent_3_days' => $store_rent_3_days,

            'store_rent_1_amount' => $store_rent_1_amount,
            'store_rent_2_amount' => $store_rent_2_amount,
            'store_rent_3_amount' => $store_rent_3_amount,
        ];
    }


    public function mount()
    {
        $this->portRates = PortRate::first(); // DB থেকে rate load
    }

    public function render()
    {
        return view('livewire.port-bill-genarate')
            ->layout('layouts.app', ['title' => 'Bill Genarate']);
    }
}
