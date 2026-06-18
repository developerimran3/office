<?php

namespace App\Livewire;

use App\Models\Sonali;
use Livewire\Component;
use App\Models\Delivery;


class SonaliBank extends Component
{
    public $type = ''; // Cash বা BE
    public $items;
    public $goods_name;
    public $be_no;
    public $be_date;
    public $debit;

    public $credit;
    public $credit_date;
    public $balance;

    public $delivery;
    public $sonalis; // To show in table

    public function mount()
    {
        $this->delivery = Delivery::all();

        $this->sonalis = Sonali::get();
        $this->calculateBalance();
    }

    // This will run automatically when be_no changes
    public function updatedBeNo($value)
    {
        $delivery = $this->delivery->where('be_no', $value)->first();

        if ($delivery) {
            $this->items   = $delivery->items ?? [];
            $this->be_date = $delivery->be_date;
        } else {
            $this->items = [];
            $this->be_date = '';
        }
        $this->reset();
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
                'credit_date' => 'required|date',
            ]);
        } elseif ($this->type == 'BE') {
            $this->validate([
                'be_no' => 'required',
                'debit' => 'required',
            ]);
        }
        // Create new 
        Sonali::create([
            'type'        => $this->type,
            'be_no'       => $this->be_no,
            'be_date'     => $this->be_date,
            'items'       => $this->type == 'BE' ? json_encode($this->items) : null,
            'debit'       => $this->type == 'BE' ? $this->debit : 0,
            'credit'      => $this->type == 'CASH' ? $this->credit : 0,
            'credit_date' => $this->credit_date,


        ]);
        session()->flash('success', 'Sonali Bank Data saved successfully!');
        // Reset form
        $this->reset();

        // Reload table and recalc balance
        $this->sonalis = Sonali::orderBy('id')->get();
        $this->calculateBalance();
        $this->mount();
    }

    // Balance calculation
    public function calculateBalance()
    {
        $balance = 0;
        foreach ($this->sonalis as $so) {
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
        $usedBeNos = Sonali::whereNotNull('be_no')
            ->pluck('be_no')
            ->toArray();

        $this->delivery = Delivery::whereNotIn('be_no', $usedBeNos)->get();

        return view('livewire.sonali-bank')
            ->layout('layouts.app', ['title' => 'Sonali Bank']);
    }
}
