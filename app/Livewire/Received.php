<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Received as ReceiveDocument;
use App\Models\Register;



class Received extends Component
{
    public $items = [];
    public $containers = [];
    public $receiveds = '';
    public $receivedId = '';
    public $total_quantity = '';
    public $initial_total = '';
    public $pkgs_code = '';

    public $remainingValue = 0;
    public $invoice_value = '';
    public $invoice_no = '';
    public $invoice_date = '';
    public $rot_no = '';
    public $vessel = '';
    public $bl_no = '';
    public $total_nw = '';

    public $initial_gw = '';
    public $gross_weight = '';
    public $item_gross_weight = '';
    public $container_location = '';




    public function mount()
    {
        $this->receiveds = ReceiveDocument::get();
    }

    /**
     * Form Steps
     * Step 1: Basic Information
     * Step 2: Items
     * Step 3: Containers
     * Step 4: Review & Submit
     */
    public $step = 1;
    public function nextStep()
    {
        $this->step++;
    }

    public function prevStep()
    {
        $this->step--;
    }


    /**
     * Edit  
     */
    public function editToReceived($id)
    {
        $receive = ReceiveDocument::findOrFail($id);

        $this->receivedId = $id;

        // Load basic fields
        $this->invoice_value  = $receive->invoice_value;
        $this->invoice_no     = $receive->invoice_no;
        $this->invoice_date   = $receive->invoice_date;

        $this->rot_no         = $receive->rot_no;

        $this->total_quantity = $receive->total_quantity;
        $this->initial_total  = $receive->total_quantity;

        $this->gross_weight   = $receive->gross_weight;
        $this->initial_gw     = $receive->gross_weight;

        $this->pkgs_code      = $receive->pkgs_code;
        $this->vessel         = $receive->vessel;
        $this->bl_no          = $receive->bl_no;

        // Load items JSON
        $this->items      = $receive->items ?? [];
        $this->containers = $receive->containers ?? [];
    }





    public $warningMessage = '';

    public function updatedItems()
    {
        // Total Net Weight Sum
        $this->total_nw = collect($this->items)->sum(function ($item) {
            return (int) ($item['net_weight'] ?? 0);
        });



        // Used Quantity
        $usedQuantity = 0;

        foreach ($this->items as $item) {
            $usedQuantity += (int) ($item['item_quantity'] ?? 0);
        }

        $remainingQuantity = $this->initial_total - $usedQuantity;

        if ($remainingQuantity < 0) {
            $this->warningMessage = '⚠️ Quantity cannot be more than total!';
            return;
        }
        $this->total_quantity = $remainingQuantity;




        // Used Gross Weight
        $usedGrossWeight = 0;

        foreach ($this->items as $item) {
            $usedGrossWeight += (int) ($item['item_gross_weight'] ?? 0);
        }

        $remainingGrossWeight = $this->initial_gw - $usedGrossWeight;

        if ($remainingGrossWeight < 0) {
            $this->warningMessage = '⚠️ Gross Weight cannot be more than total!';
            return;
        }
        $this->gross_weight = $remainingGrossWeight;





        $items = collect($this->items);
        // TOTAL USED VALUE (sum of item_value)
        $usedValue = $items->sum(function ($item) {
            return (int) ($item['item_value'] ?? 0);
        });

        // REMAINING VALUE = INVOICE - USED
        $this->remainingValue = (int) $this->invoice_value - $usedValue;

        // WARNING if over limit
        if ($this->remainingValue < 0) {
            $this->warningMessage = '⚠️ Item Value cannot exceed Invoice Value!';
            return;
        }


        // Clear Warning
        $this->warningMessage = '';
    }



    /**
     * Update Data (Create aj jonno data)
     */
    public function updateReceived()
    {
        $this->validate([
            'invoice_value' => 'required',
            'invoice_no'    => 'required',
            'invoice_date'  => 'required',
            'rot_no'        => 'required',
        ]);

        $receive = ReceiveDocument::findOrFail($this->receivedId);

        $receive->update([
            'invoice_value' => $this->invoice_value,
            'invoice_no'    => $this->invoice_no,
            'invoice_date'  => $this->invoice_date,
            'rot_no'        => $this->rot_no,
            'vessel'        => $this->vessel,
            'bl_no'         => $this->bl_no,

            'containers'    => $this->containers,
            'items'         => $this->items, // JSON saved automatically
        ]);

        session()->flash('success', 'Document updated successfully!');
        $this->reset();
        $this->mount();
        $this->receivedId = null;
    }


    /**
     * Move All received Data Register Page...
     */
    public function moveToRegister(int $id)
    {
        DB::transaction(function () use ($id) {
            $receive = ReceiveDocument::with(['items', 'containers'])->findOrFail($id);
            Register::create([
                'importer_name'  => $receive->importer_name,
                'total_quantity' => $receive->total_quantity,
                'pkgs_code'      => $receive->pkgs_code,
                'vessel'         => $receive->vessel,
                'bl_no'          => $receive->bl_no,
                'lc_number'      => $receive->lc_number,
                'lc_date'        => $receive->lc_date,
                'gross_weight'   => $receive->gross_weight,
                'arrival_date'   => $receive->arrival_date,
                'document_receiver'   => $receive->document_receiver,

                'invoice_value'  => $receive->invoice_value,
                'invoice_no'     => $receive->invoice_no,
                'invoice_date'   => $receive->invoice_date,
                'rot_no'         => $receive->rot_no,

                'items' => collect($receive->items)->map(function ($item) {
                    return [
                        'goods_name'        => $item['goods_name'] ?? '',
                        'item_quantity'     => $item['item_quantity'] ?? '',
                        'item_value'        => $item['item_value'] ?? '',
                        'net_weight'        => $item['net_weight'] ?? '',
                        'item_gross_weight' => $item['item_gross_weight'] ?? '',
                    ];
                })->toArray(),

                'containers' => collect($receive->containers)->map(function ($container) {
                    return [
                        'container_no'       => $container['container_no'] ?? '',
                        'container_size'     => $container['container_size'] ?? '',
                        'container_location' => $container['container_location'] ?? '',
                    ];
                })->toArray(),
            ]);
            $receive->delete();
            $this->mount();
            return $this->redirect('/register', navigate: true);
        });
    }



    public function render()
    {
        return view('livewire.received');
    }
}
