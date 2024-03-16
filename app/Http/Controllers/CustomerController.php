<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create.customer', [
            'title' => 'Customer',
            'customers' => Customer::orderBy('nama_pelanggan')->paginate(15),
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
            'nama_pelanggan' => 'required',
            'alamat' => '',
            'no_telp' => '',
        ]);

        Customer::create($validated);

        return back()->with('success', 'Pelanggan baru berhasil ditambahkan !');
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
    public function edit($id)
    {
        return view('update.customer', [
            'title' => 'Customer',
            'customer' => Customer::find($id),
            'customers' => Customer::orderBy('nama_pelanggan')->paginate(15),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required',
            'alamat' => '',
            'no_telp' => '',
        ]);

        $customer->update($validated);

        return redirect('/customer/create')->with('success', 'Pelanggan berhasil diperbaharui !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect('/customer/create')->with('success', 'Pelanggan berhasil dihapus !');
    }
}
