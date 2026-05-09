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
    public $container_location;
    public $net_weight;
    public $quantity;
    public $pkgs_code;
    public $registerId;

    /**
     * Edit Data (create ar jonno)
     */
    public function editToregister($id)
    {
        $register = RegisterDocument::findOrFail($id);
        $this->be_no              = $register->be_no;
        $this->be_date            = $register->be_date;
        $this->be_lane            = $register->be_lane;
        $this->quantity           = $register->quantity . ' ' . $register->pkgs_code;
        $this->container_location = $register->container_location;
        $this->net_weight         = $register->net_weight;
        $this->registerId         = $id;
    }

    /**
     * Update Data (Create aj jonno data)
     */
    // public function updateRegister($id)
    // {
    //     $this->validate([
    //         'be_no'    => 'required|unique:registers,be_no,' . $id,
    //         'be_date'  => 'required',
    //     ]);
    //     $register = RegisterDocument::findOrFail($id);
    //     $register->update([
    //         'be_no'               => $this->be_no,
    //         'be_date'             => $this->be_date,
    //         'be_lane'             => $this->be_lane,
    //         'container_location'  => $this->container_location,
    //         'net_weight'          => $this->net_weight,
    //     ]);
    //     $this->reset();
    //     $this->mount();
    //     session()->flash('success', 'Document Update Successful.');
    // }

    public function mount()
    {
        $this->registers = RegisterDocument::get();
    }

    /**
     * Move All Enty Data Recgister Page...
     */
    // public function moveToAssessment($id)
    // {
    //     DB::transaction(function () use ($id) {

    //         $register = RegisterDocument::findOrFail($id);

    //         $this->validate([
    //             'be_no'    => 'nullable|unique:assessments,be_no',
    //         ]);
    //         // All Table ar Bl Valadation
    //         $this->be_no = $register->be_no;
    //         $this->validate([
    //             'be_no' => 'nullable',
    //         ]);
    //         $exists =
    //             DB::table('deliveries')->where('be_no', $this->be_no)->exists() ||
    //             DB::table('assessments')->where('be_no', $this->be_no)->exists();

    //         if ($exists) {
    //             $this->addError('be_no', 'BE No already exists in another record.');
    //             return;
    //         }

    //         Assessment::create([
    //             //New Enty
    //             'importer_name'      => $register->importer_name,
    //             'goods_name'         => $register->goods_name,
    //             'quantity'           => $register->quantity,
    //             'pkgs_code'          => $register->pkgs_code,
    //             'vessel'             => $register->vessel,
    //             'bl_no'              => $register->bl_no,
    //             'container_no'       => $register->container_no,
    //             'container_size'     => $register->container_size,
    //             'lc_number'          => $register->lc_number,
    //             'lc_date'            => $register->lc_date,
    //             'gross_weight'       => $register->gross_weight,
    //             'arivel_date'        => $register->arivel_date,
    //             'document_receiver'  => $register->document_receiver,
    //             //Received
    //             'invoice_value'      => $register->invoice_value,
    //             'invoice_no'         => $register->invoice_no,
    //             'invoice_date'       => $register->invoice_date,
    //             'net_weight'         => $register->net_weight,
    //             'container_location' => $register->container_location,
    //             'rot_no'             => $register->rot_no,
    //             //Register
    //             'be_no'              => $register->be_no,
    //             'be_date'            => $register->be_date,
    //             'be_lane'            => $register->be_lane,
    //         ]);

    //         //Delete from Recived Data
    //         $register->delete();
    //         $this->mount();
    //         session()->flash('success', 'Register Data moved to  Assessment page successfully!');
    //         return $this->redirect('/assessment', navigate: true);
    //     });
    // }



    public function render()
    {
        return view('livewire.register');
    }
}
