<?php

namespace App\Http\Livewire;

use App\Models\Obat;
use Livewire\Component;

class CariObat extends Component
{
    public $search;
    public $obats = [];

    public function render()
    {
        return view('livewire.cari-obat');
    }

    public function updatedSearch($value)
    {
        if (empty($value)) {
            $this->reset('obats');
        } else {
            $this->obats = Obat::where('name', 'like', $value . '%')->get();
        }
    }

    public function cartButton($id)
    {
        $this->emit('addToCart', $id);
    }
}
