<?php

namespace App\Http\Controllers;

use App\Models\Restock;
use Illuminate\Http\Request;

class RestockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('restock.index', [
            'restocks' => Restock::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transaksi.form', [
            'isTransaksi' => FALSE,
            'title' => 'Restock'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('restock.show', [
            'restock' => Restock::find($id)
        ]);
    }
}
