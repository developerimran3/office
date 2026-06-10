<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Assessment;
use Illuminate\Support\Facades\DB;


use App\Models\Register as RegisterDocument;

class Register extends Component
{
    public $registers = "";

    public $be_no;
    public $be_date;
    public $be_lane;
    public $container_location, $containers;
    public $net_weight;
    public $bl_no;
    public $total_quantity;
    public $pkgs_code;
    public $registerId;





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
     * Edit Data (create ar jonno)
     */
    public function editToregister($id)
    {
        $register = RegisterDocument::findOrFail($id);
        $this->be_no              = $register->be_no;
        $this->be_date            = $register->be_date;
        $this->be_lane            = $register->be_lane;
        $this->total_quantity     = ' BL- ' . $register->bl_no . ',  STC- ' . $register->total_quantity . ' ' . $register->pkgs_code;
        $this->containers         = $register->containers ?? [];
        $this->registerId         = $id;
    }

    /**
     * Update Data (Create aj jonno data)
     */
    public function updateRegister($id)
    {
        $this->validate([
            'be_no'    => 'required|unique:registers,be_no,' . $id,
            'be_date'  => 'required',
        ]);
        $register = RegisterDocument::findOrFail($id);
        $register->update([
            'be_no'               => $this->be_no,
            'be_date'             => $this->be_date,
            'be_lane'             => $this->be_lane,
            'containers'          => $this->containers,
            'net_weight'          => $this->net_weight,
        ]);
        $this->reset();
        $this->mount();
        session()->flash('success', 'Document Update Successful.');
    }

    public function mount()
    {
        $this->registers = RegisterDocument::get();
    }

    /**
     * Move All Enty Data Recgister Page...
     */
    public function moveToAssessment($id)
    {
        DB::transaction(function () use ($id) {
            $register = RegisterDocument::with(['items', 'containers'])->findOrFail($id);

            // $this->validate([
            //     'be_no'    => 'nullable|unique:assessments,be_no',
            // ]);
            // // All Table ar Bl Valadation
            // $this->be_no = $register->be_no;
            // $this->validate([
            //     'be_no' => 'nullable',
            // ]);
            // $exists =
            //     DB::table('deliveries')->where('be_no', $this->be_no)->exists() ||
            //     DB::table('assessments')->where('be_no', $this->be_no)->exists();

            // if ($exists) {
            //     $this->addError('be_no', 'BE No already exists in another record.');
            //     return;
            // }

            Assessment::create([
                'importer_name'  => $register->importer_name,
                'total_quantity' => $register->total_quantity,
                'pkgs_code'      => $register->pkgs_code,
                'vessel'         => $register->vessel,
                'bl_no'          => $register->bl_no,
                'lc_number'      => $register->lc_number,
                'lc_date'        => $register->lc_date,
                'gross_weight'   => $register->gross_weight,
                'arrival_date'   => $register->arrival_date,
                'document_receiver'   => $register->document_receiver,

                'invoice_value'  => $register->invoice_value,
                'invoice_no'     => $register->invoice_no,
                'invoice_date'   => $register->invoice_date,
                'rot_no'         => $register->rot_no,

                'items' => collect($register->items)->map(function ($item) {
                    return [
                        'goods_name'        => $item['goods_name'] ?? '',
                        'item_quantity'     => $item['item_quantity'] ?? '',
                        'item_value'        => $item['item_value'] ?? '',
                        'net_weight'        => $item['net_weight'] ?? '',
                        'item_gross_weight' => $item['item_gross_weight'] ?? '',
                    ];
                })->toArray(),

                'containers' => collect($register->containers)->map(function ($container) {
                    return [
                        'container_no'       => $container['container_no'] ?? '',
                        'container_size'     => $container['container_size'] ?? '',
                        'container_location' => $container['container_location'] ?? '',
                    ];
                })->toArray(),

                //Register
                'be_no'              => $register->be_no,
                'be_date'            => $register->be_date,
                'be_lane'            => $register->be_lane,
            ]);

            //Delete from Recived Data
            $register->delete();
            $this->mount();
            session()->flash('success', 'Register Data moved to  Assessment page successfully!');
            return $this->redirect('/assessment', navigate: true);
        });
    }

    public function render()
    {
        return view('livewire.register');
    }
}
