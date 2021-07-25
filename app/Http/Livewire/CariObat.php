<?php

namespace App\Http\Livewire;

use App\Models\Obat;
use Livewire\Component;

class CariObat extends Component
{
    public $search;
    public $obats = [];
    public $isTransaksi;

    protected $listeners = ['cartButton', 'updatedSearch'];

    public function render()
    {
        return view('livewire.cari-obat');
    }

    public function updatedSearch()
    {
        if (empty($this->search)) {
            $this->reset('obats');
        } else {
            $this->obats = Obat::where('name', 'like', $this->search . '%')->get();
        }

        $this->emit('hideLoading');
    }

    public function cartButton($id)
    {
        if ($this->isTransaksi) {
            $this->emit('addToCart', $id);
        } else {
            $this->emit('addToRestock', $id);
        }
    }
}
