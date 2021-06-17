<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('medicines.index', [
            'medicines' => Obat::latest()->get()
        ]);
    }

    public function loadModal(Obat $obat)
    {
        return view('medicines.add', compact('obat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medicines.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        unset($data['_token']);

        // dd($request->all());

        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $extension = $request->image->extension();
                $request->image->storeAs('/', $data['name'] . "." . $extension);
                $data['image'] = Storage::url($data['name'] . "." . $extension);
            }
        } else {
            abort(500, 'Could not upload image :(');
        }

        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'image' => ['required'],
            'price' => ['required', 'numeric', 'min:100'],
            'stock' => ['required', 'numeric'],
            'reorder_point' => ['required', 'numeric'],
            'type' => ['required'],
        ])->validate();

        $obat = Obat::create($data);

        if ($obat) {
            return redirect()->route('obat.index')->with('info', 'Produk baru berhasil ditambahkan');
        }

        return redirect()->route('obat.index')->with('error', 'Produk gagal ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Obat $obat)
    {
        return view('medicines.form', [
            'edit' => TRUE,
            'obat' => $obat
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Obat $obat)
    {
        if ($request->has('add_stock')) {
            Validator::make($request->all(), [
                'add_stock' => 'required|numeric|min:1'
            ])->validate();

            $obat->stock = $obat->stock + $request->add_stock;

            $obat->save();

            return redirect()->route('obat.index')->with('info', 'Stok berhasil ditambahkan');
        } else {
            $data = $request->all();

            unset($data['_token']);

            if ($request->hasFile('image')) {
                if ($request->file('image')->isValid()) {
                    $extension = $request->image->extension();
                    $request->image->storeAs('/', $data['name'] . "." . $extension);
                    $data['image'] = Storage::url($data['name'] . "." . $extension);
                } else {
                    abort(500, 'Could not upload image :(');
                }
            }

            Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'price' => ['required', 'numeric', 'min:100'],
                // 'stock' => ['required', 'numeric'],
                'type' => ['required'],
                'reorder_point' => ['required'],
            ])->validate();

            if ($obat->update($data)) {
                // Activity::create([
                //     'message' => 'Admin "' . auth()->user()->name . '" mengubah data produk: ' . $obat->name
                // ]);

                return redirect()->route('obat.index')->with('info', 'Data produk berhasil diubah');
            }

            return redirect()->route('obat.index')->with('error', 'Data produk gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
