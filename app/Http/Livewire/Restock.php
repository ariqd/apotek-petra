<?php

namespace App\Http\Livewire;

use App\Models\Obat;
use App\Models\RestockItem;
use App\Models\Supplier;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class Restock extends Component
{
    public $id_supplier;
    public $error_count;

    protected $listeners = ['addToRestock', 'doRestock'];

    protected $rules = [
        'id_supplier' => 'required',
    ];

    public function render()
    {
        return view('livewire.restock', [
            'suppliers' => Supplier::orderBy('nama')->get()
        ]);
    }

    public function addToRestock(Obat $obat)
    {
        Cart::instance('restock')->add(
            $obat->id,
            $obat->name,
            1,
            $obat->price,
            1,
            [
                'max' => $obat->stock,
                'image' => $obat->image
            ]
        );
    }

    public function deleteFromRestock($rowId)
    {
        Cart::instance('restock')->remove($rowId);
    }

    public function clearRestock()
    {
        Cart::instance('restock')->destroy();
    }

    public function updateQtyRestock($rowId, $qty, $id)
    {
        if ($qty > 0) {
            $obat = Obat::find($id);

            if ($obat->stock < $qty) {
                $this->addError('qty_error', 'Dilarang ada qty produk melebihi stok');
            }

            Cart::instance('restock')->update($rowId, $qty);
        } else {
            $this->addError('qty_error', 'Dilarang ada produk dengan qty 0 pcs');
        }
    }

    public function doRestock()
    {
        $this->validate();

//        foreach (Cart::instance('restock')->content() as $item) {
//            $product = Obat::find($item->id);
//
//            if ($item->qty > $product->stock) {
//                return redirect()->back()->with('error', 'Pesanan gagal doRestock. Terdapat pesanan dengan jumlah stok lebih dari yang tersedia.');
//            }
//        }

        $restock = Restock::create([
            'user_id' => auth()->id(),
            'id_supplier' => $this->id_supplier,
            'count' => Cart::instance('restock')->count(),
            'total' => Cart::instance('restock')->totalFloat()
        ]);

        if ($restock) {
            foreach (Cart::instance('restock')->content() as $item) {
                $obat = Obat::find($item->id);

                $restock_item = RestockItem::create([
                    'restock_id' => $restock->id,
                    'obat_id' => $item->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'qty' => $item->qty,
                    'image' => $obat->image
                ]);

                if ($restock_item) {
                    $obat->stock += $item->qty;

                    $obat->save();
                }
            }
            Cart::instance('restock')->destroy();

            session()->flash('info', 'Pesanan ke Supplier berhasil dibuat.');

            return redirect()->route('restock.index');
        }

        session()->flash('error', 'Pesanan ke Supplier gagal dibuat.');

        return redirect()->route('restock.index');
    }
}
