<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Restock;
use App\Models\RestockItem;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
//        $this->middleware('pemilik');
    }

    public function index()
    {
        $orders = Transaction::select(
            DB::raw('sum(total) as sums'),
            DB::raw("DATE_FORMAT(created_at,'%m') as monthKey")
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy('monthKey')
            ->orderBy('created_at', 'ASC')
            ->get();

        $restocks = Restock::select(
            DB::raw('sum(total) as sums'),
            DB::raw("DATE_FORMAT(created_at,'%m') as monthKey")
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy('monthKey')
            ->orderBy('created_at', 'ASC')
            ->get();

        $grafikPenjualan = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $grafikRestock = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        foreach ($orders as $order) {
            $grafikPenjualan[$order->monthKey - 1] = $order->sums;
        }

        foreach ($restocks as $restock) {
            $grafikRestock[$restock->monthKey - 1] = $restock->sums;
        }

        return view('dashboard', [
            'riwayatTransaksi' => TransactionItem::latest()->take(5)->get(),
            'bestSeller' => TransactionItem::groupBy('name')->selectRaw(
                'sum(qty) as sum, name'
            )->take(5)->pluck('sum', 'name'),
            'bestRestock' => RestockItem::groupBy('name')->selectRaw(
                'sum(qty_restock) as sum, name'
            )->take(5)->pluck('sum', 'name'),
            'penjualan' => $grafikPenjualan,
            'restock' => $grafikRestock
        ]);
    }
}
