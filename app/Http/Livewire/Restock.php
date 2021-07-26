<?php

namespace App\Http\Livewire;

use App\Models\Obat;
use App\Models\RestockItem;
use App\Models\Supplier;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use App\Models\Restock as RestockModel;

class Restock extends Component
{
    public $supplier_id;
    public $error_count;

    protected $listeners = ['addToRestock', 'doRestock', 'selectedCategory'];

    protected $rules = [
        'supplier_id' => 'required|numeric|min:1',
    ];

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function mount()
    {
        $this->supplier_id = 0;
    }

    public function render()
    {
        return view('livewire.restock', [
            'suppliers' => Supplier::orderBy('nama')->get(),
            'cart' => Cart::instance('restock')
        ]);
    }

    public function selectedCategory($item)
    {
        if ($item) {
            $this->supplier_id = $item;
        } else {
            $this->supplier_id = null;
        }

        $this->emit('hideLoading');
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
                'image' => $obat->image,
                'currentStock' => $obat->restocks->sum('qty'),
                'currentPrice' => $obat->price,
                'expiry_date' => ""
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

    // Update HARGA produk dalam cart
    public function updatePriceRestock($rowId, $price, $id)
    {
        if ($price > 0) {
            Cart::instance('restock')->update($rowId, ['price' => $price]);
        } else {
            $this->addError('qty_error.' . $rowId, 'Dilarang ada produk dengan qty 0 pcs');
        }
    }

    // Update JUMLAH / QTY produk dalam cart
    public function updateQtyRestock($rowId, $qty, $id)
    {
        if ($qty > 0) {
            Cart::instance('restock')->update($rowId, ['qty' => $qty]);
        } else {
            $this->addError('qty_error.' . $rowId, 'Dilarang ada produk dengan qty 0 pcs');
        }
    }

    public function updateExpiryRestock($rowId, $date, $id)
    {
        $item = Cart::instance('restock')->get($rowId);
        $option = $item->options->merge(['expiry_date' => $date]);

        Cart::instance('restock')->update($rowId, ['options' => $option]);
    }

    public function doRestock()
    {
        $this->validate();

        foreach (Cart::instance('restock')->content() as $item) {
            if ($item->options->expiry_date == "") {
                session()->flash('error', 'Pesanan gagal restock. Harap isi semua expiry date');

                $this->emit('hideLoading');

                return redirect()->route('restock.create');
            }
        }

        $restock = RestockModel::create([
            'user_id' => auth()->id(),
            'supplier_id' => $this->supplier_id,
            'count' => Cart::instance('restock')->count(),
            'total' => Cart::instance('restock')->totalFloat()
        ]);

        if ($restock) {
            foreach (Cart::instance('restock')->content() as $item) {
                $obat = Obat::find($item->id);

                RestockItem::create([
                    'restock_id' => $restock->id,
                    'obat_id' => $item->id,
                    'name' => $item->name,
                    'harga_beli' => $item->price,
                    'qty' => $item->qty,
                    'qty_restock' => $item->qty,
                    'image' => $obat->image,
                    'expiry_date' => $item->options->expiry_date
                ]);

//                if ($restock_item) {
//                    $obat->stock += $item->qty;
//
//                    $obat->save();
//                }
            }
            Cart::instance('restock')->destroy();

            session()->flash('info', 'Pesanan ke Supplier berhasil dibuat.');

            $this->emit('hideLoading');

            return redirect()->route('restock.index');
        }

        session()->flash('error', 'Pesanan ke Supplier gagal dibuat.');

        $this->emit('hideLoading');

        return redirect()->route('restock.index');
    }
}
