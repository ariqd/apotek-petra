<?php

namespace App\Http\Livewire;

use App\Models\Obat;
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

    public function addToCart(Obat $obat)
    {
        Cart::add(
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
            $obat = Obat::find($id);

            if ($obat->stock < $qty) {
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
            $product = Obat::find($item->id);

            if ($item->qty > $product->stock) {
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
                $obat = Obat::find($item->id);

                $transaction_item = TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'obat_id' => $item->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'qty' => $item->qty,
                    'image' => $obat->image
                ]);

                if ($transaction_item) {
                    $obat->stock -= $item->qty;

                    $obat->save();
                }
            }
            Cart::destroy();

            session()->flash('info', 'Checkout berhasil.');

            return redirect()->route('transaksi.index');
        }
    }
}
