<?php

namespace App\Http\Controllers;

use App\Models\Product;
use DivisionByZeroError;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\DetailTransaction;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terjual = DetailTransaction::sum('jumlah_produk');
        $sisa_stok = Product::sum('stok');
        $jumlah_stok = $terjual + $sisa_stok;

        try {
            $persentase = $terjual / $jumlah_stok;
        } catch (DivisionByZeroError $e) {
            $persentase = 0;
        }

        return view('dashboard', [
            'title' => 'Dashboard',
            'jumlah_produk' => Product::count(),
            'total_pendapatan' => Transaction::sum('total_harga'),
            'terjual' => $terjual,
            'jumlah_stok' => $jumlah_stok,
            'persentase' => $persentase,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create.product', [
            'title' => 'Produk',
            'products' => Product::orderBy('nama_produk')->paginate(15),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric|min:500',
            'stok' => 'required|min:1|numeric'
        ]);

        Product::create($validated);

        return back()->with('success', 'Produk baru berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(String $id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('update.product', [
            'title' => 'Produk',
            'product' => $product,
            'products' => Product::orderBy('nama_produk')->paginate(15),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric|min:500',
            'stok' => 'required|numeric|min:1',
        ]);

        $product->update($validated);

        return redirect('/product/create')->with('success', 'Produk berhasil diperbaharui !');
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
