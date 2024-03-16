<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\DetailTransaction;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Semua Penjualan';

        if (request(['start_date', 'end_date'])) {
            $validated = Validator::make(request(['start_date', 'end_date']), [
                'start_date' => 'required',
                'end_date' => 'required',
            ]);

            if ($validated->fails()) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'start_date' => 'Kolom ini harus diisi',
                        'end_date' => 'Kolom ini harus diisi'
                    ]);
            }

            $title = 'Penjualan ' . request('start_date') . ' - ' . request('end_date');
        }

        return view('transactions', [
            'title' => $title,
            'transactions' => Transaction::orderBy('id')->search(request(['search', 'start_date', 'end_date']))->paginate(1),
            'total_penjualan' => Transaction::sum('total_harga'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create.transaction', [
            'title' => 'Penjualan',
            'customers' => Customer::orderBy('nama_pelanggan')->get(),
            'products' => Product::orderBy('nama_produk')->get(),
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
        // dd($request->all());
        $validated = $request->validate([
            'customer' => 'required',
            'produk_id.*' => 'required',
            'harga' => '',
            'jumlah_produk.*' => 'required|min:1',
        ], [
            'customer' => 'Pelanggan harus diisi',
            'produk_id.*' => 'Produk harus dipilih',
            'jumlah_produk.*' => 'Jumlah Produk harus diisi',
        ]);

        $produk_id = $request->input('produk_id');

        foreach ($produk_id as $index => $produk) {
            $produkSelected = Product::find($produk);

            if ($produkSelected && $produkSelected->stok < $request->input('jumlah_produk')[$index]) {
                return back()->withInput()
                    ->withErrors([
                        'jumlah_produk.' . $index => 'Stok produk tidak cukup',
                    ]);
            }
        }

        $transaction = Transaction::create([
            'customer_id' => $validated['customer'],
            'total_harga' => array_sum($request->input('subtotal')),
        ]);

        foreach ($produk_id as $index => $produk) {
            $produkSelected = Product::find($produk);

            DetailTransaction::create([
                'transaction_id' => $transaction->id,
                'product_id' => $produkSelected->id,
                'jumlah_produk' => $request->input('jumlah_produk')[$index],
                'subtotal' => $request->input('subtotal')[$index],
            ]);

            $produkSelected->update(['stok' => $produkSelected->stok - $request->input('jumlah_produk')[$index]]);
        }

        return redirect('/transaction')->with('success', 'Transaksi baru berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return view('transaction', [
            'title' => 'Nota ' . $transaction->id . ' - ' . ($transaction->customer->nama_pelanggan),
            'transaction' => $transaction,
            'details' => $transaction->details()->with('product')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
