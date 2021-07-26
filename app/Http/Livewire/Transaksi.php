<?php

namespace App\Http\Livewire;

use App\Models\Obat;
use App\Models\RestockItem;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class Transaksi extends Component
{
    public $nama_pembeli;
    public $error_count;

    protected $listeners = ['addToCart', 'checkout'];

    protected $rules = [
        'nama_pembeli' => 'required',
    ];

    public function render()
    {
        return view('livewire.transaksi');
    }

    public function addToCart($id)
    {
        $restock = RestockItem::find($id);

        Cart::add(
            $restock->id,
            $restock->obat->name,
            1,
            $restock->obat->price,
            1,
            [
                'max' => $restock->qty,
                'image' => $restock->obat->image,
            ]
        );
    }

    public function deleteFromCart($rowId)
    {
        Cart::remove($rowId);
    }

    public function clearCart()
    {
        Cart::destroy();
    }

    public function updateQty($rowId, $qty, $id)
    {
        if ($qty > 0) {
            $restock = RestockItem::find($id);

            if ($restock->stock < $qty) {
                $this->addError('qty_error', 'Dilarang ada qty produk melebihi stok');
            }

            Cart::update($rowId, $qty);
        } else {
            $this->addError('qty_error', 'Dilarang ada produk dengan qty 0 pcs');
        }
    }

    public function checkout()
    {
        $this->validate();

        foreach (Cart::content() as $item) {
            $restock = RestockItem::find($item->id);

            if ($item->qty > $restock->qty) {
                return redirect()->back()->with('error', 'Pesanan gagal checkout. Terdapat pesanan dengan jumlah stok lebih dari yang tersedia.');
            }
        }

        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'nama_pembeli' => $this->nama_pembeli,
            'count' => Cart::count(),
            'total' => Cart::totalFloat()
        ]);

        if ($transaction) {
            foreach (Cart::content() as $item) {
                $restock = RestockItem::find($item->id);

                $transaction_item = TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'restock_item_id' => $item->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'qty' => $item->qty,
                    'image' => $restock->obat->image
                ]);

                if ($transaction_item) {
                    $restock->qty -= $item->qty;

                    $restock->save();
                }
            }
            Cart::destroy();

            session()->flash('info', 'Checkout berhasil.');

            return redirect()->route('transaksi.index');
        }
    }
}
