@extends('main.body')

@section('container')
    <div class="row">
        <h3 class="my-2 mb-3 px-0 mx-0">{{ $title }}</h3>
        <hr class="mb-4">

        <form action="/product" method="POST" class="border rounded col-lg-10">
            @csrf
            <div class="row py-3 px-3">
                <h4 class="my-3 mb-4">Tambah Produk</h4>
                <div class="col-md-4">
                    <label for="form-label" class="mb-2 ms-1">Nama Produk <span class="text-danger">*</span></label>
                    <input class="form-control mb-2" type="text" name="nama_produk" id="nama_produk" placeholder="Nama Produk"
                        value="{{ old('nama_produk') }}" />
                    @error('nama_produk')
                        <div class="text-danger small ms-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="form-label" class="mb-2 ms-1">Harga <span class="text-danger">*</span></label>
                    <input class="form-control mb-2" type="text" name="harga" id="harga" placeholder="Harga" value="{{ old('harga') }}" />
                    @error('harga')
                        <div class="text-danger small ms-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="form-label" class="mb-2 ms-1">Stok <span class="text-secondary">*</span></label>
                    <input class="form-control mb-2" type="number" name="stok" id="stok" placeholder="Stok"
                        value="{{ old('stok') }}" />
                    @error('stok')
                        <div class="text-danger small ms-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary mb-5 mx-3 mt-1">Tambah Produk</button>
        </form>
    </div>

    @include('products')
@endsection
