<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('transaksi.index', [
            'transactions' => Transaction::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transaksi.form');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('transaksi.show', [
            'transaction' => Transaction::find($id)
        ]);
    }
}
