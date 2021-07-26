<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
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
        return view('supplier.index', [
            'suppliers' => Supplier::orderBy('nama')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.form', [
            'edit' => false
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'kota' => 'required|string',
            'alamat' => 'required|string',
            'no_telp' => 'required|string',
        ]);

        Supplier::create($request->all());

        return redirect()->route('supplier.index')->with('info', 'Supplier baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return view('supplier.show', [
            'supplier' => $supplier
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.form', [
            'edit' => true,
            'supplier' => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'nama' => 'required|string',
            'kota' => 'required|string',
            'alamat' => 'required|string',
            'no_telp' => 'required|string',
        ]);

        $supplier->update($request->all());

        return redirect()->route('supplier.index')->with('info', 'Supplier baru berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
