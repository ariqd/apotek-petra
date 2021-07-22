<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('pemilik');
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

        $data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        foreach ($orders as $order) {
            $data[$order->monthKey - 1] = $order->sums;
        }

        return view('dashboard', [
            'riwayatTransaksi' => TransactionItem::latest()->take(5)->get(),
            'bestSeller' => TransactionItem::groupBy('name')->selectRaw(
                'sum(qty) as sum, name'
            )->take(5)->pluck('sum', 'name'),
            'penjualan' => $data
        ]);
    }
}
