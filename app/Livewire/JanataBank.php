<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Delivery;
use App\Models\Janata;

class JanataBank extends Component
{
    public $type = ''; // Cash বা BE
    public $items;
    public $goods_name;
    public $be_no;
    public $be_date;
    public $debit;
    public $importer_name;

    public $credit;
    public $credit_date;
    public $balance;

    public $delivery;
    public $janatas; // To show in table

    public function mount()
    {
        $this->delivery = Delivery::all();

        $this->janatas = Janata::get();
        $this->calculateBalance();
    }

    // This will run automatically when be_no changes
    public function updatedBeNo($value)
    {
        $delivery = $this->delivery->where('be_no', $value)->first();
        if ($delivery) {
            $this->items = $delivery->items ?? [];
            $this->be_date = $delivery->be_date;
            $this->importer_name = $delivery->importer_name;
        } else {
            $this->items = [];
            $this->be_date = '';
            $this->importer_name = '';
        }
    }


    public function save()
    {
        if (!$this->type) {
            session()->flash('error', 'Please select Type (CASH or BE)');
            return;
        }
        // Conditional validation
        if ($this->type == 'CASH') {
            $this->validate([
                'credit'      => 'required|numeric|min:1',
                'credit_date' => 'required',
            ]);
        } elseif ($this->type == 'BE') {
            $this->validate([
                'be_no' => 'required',
                'debit' => 'required',
            ]);
        }
        // Create new 
        Janata::create([
            'type'          => $this->type,
            'importer_name' => $this->importer_name,
            'items'         => $this->type == 'BE' ? json_encode($this->items) : null,
            'be_no'         => $this->be_no,
            'be_date'       => $this->be_date,
            'debit'         => $this->type == 'BE' ? $this->debit : 0,
            'credit'        => $this->type == 'CASH' ? $this->credit : 0,
            'credit_date'   => $this->credit_date,
        ]);
        session()->flash('success', 'Janata Bank Data saved successfully!');
        // Reset form
        $this->reset();

        // Reload table and recalc balance
        $this->janatas = Janata::orderBy('id')->get();
        $this->calculateBalance();
        $this->mount();
    }

    // Balance calculation
    public function calculateBalance()
    {
        $balance = 0;
        foreach ($this->janatas as $so) {
            if ($so->type == 'CASH') {
                $balance += $so->credit;
            } elseif ($so->type == 'BE') {
                $balance -= $so->debit;
            }
            $so->balance = $balance;
        }

        $this->balance = $balance;
    }

    public function render()
    {
        $usedBeNos = Janata::whereNotNull('be_no')
            ->pluck('be_no')
            ->toArray();

        $this->delivery = Delivery::whereNotIn('be_no', $usedBeNos)->get();

        return view('livewire.janata-bank')
            ->layout('layouts.app', ['title' => 'Janata Bank']);
    }
}
