<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('pemilik');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reorder = Obat::whereHas('restocks', function ($query) {
            return $query->select(DB::raw('SUM(qty) as total_stock'))->havingRaw('SUM(qty) <= obat.reorder_point');
        })->orDoesntHave('restocks')->get();

        return view('index', [
            'at_reorder_point' => $reorder,
        ]);
    }
}
