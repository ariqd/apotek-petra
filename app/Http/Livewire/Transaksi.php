<?php

namespace App\Http\Livewire;

use App\Models\Obat;
use Livewire\Component;

class Transaksi extends Component
{
    public $cart = [];

    protected $listeners = ['addToCart'];

    public function render()
    {
        return view('livewire.transaksi');
    }

    public function addToCart(Obat $obat)
    {
        // $this->cart[] = $obat;
        array_push($this->cart, $obat);

    }
}
