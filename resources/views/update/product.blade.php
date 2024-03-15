@extends('main.body')

@section('container')
    <div class="row">
        <h3 class="my-2 mb-3 px-0 mx-0">{{ $title }}</h3>
        <hr class="mb-4">

        <form action="/product/{{ $product->id }}" method="POST" class="border rounded col-lg-10">
            @method('PUT')
            @csrf
            <div class="row py-3 px-3">
                <h4 class="my-3 mb-4">Edit Produk</h4>
                <div class="col-md-4">
                    <label for="form-label" class="mb-2 ms-1">Nama Produk</label>
                    <input class="form-control mb-2" type="text" name="nama_produk" id="nama_produk" placeholder="Nama Produk"
                        value="{{ old('nama_produk', $product->nama_produk) }}" readonly />
                    @error('nama_produk')
                        <div class="text-danger small ms-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="form-label" class="mb-2 ms-1">Harga</label>
                    <input class="form-control mb-2" type="number" name="harga" value="{{ old('harga', $product->harga) }}" readonly />
                    @error('harga')
                        <div class="text-danger small ms-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="form-label" class="mb-2 ms-1">Stok <span class="text-danger">*</span></span></label>
                    <input class="form-control mb-2" type="text" name="stok" id="stok" placeholder="Stok"
                        value="{{ old('stok', $product->stok) }}" />
                    @error('stok')
                        <div class="text-danger small ms-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary mb-5 mx-3 mt-1">Edit Produk</button>
        </form>
    </div>

    @include('products')
@endsection
