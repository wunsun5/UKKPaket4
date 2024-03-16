@extends('main.body')

@section('container')
    <div class="d-flex flex-nowrap align-items-center justify-content-between pt-3 pb-2 mb-4  border-bottom">
        <h1 class="h3">{{ $title }}</h1>
    </div>
    <div class="row">
        <form action="/product" method="POST" class="border rounded col-lg-10">
            @csrf
            <div class="row py-3 px-3">
                <h4 class="my-3 mb-4">Tambah Produk</h4>
                <div class="col-md-4">
                    <label for="form-label" class="mb-2 ms-1">Nama Produk <span class="text-danger">*</span></label>
                    <input class="form-control mb-2" type="text" name="nama_produk" id="nama_produk"
                        placeholder="Nama Produk" value="{{ old('nama_produk') }}" />
                    @error('nama_produk')
                        <div class="text-danger small ms-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="form-label" class="mb-2 ms-1">Harga <span class="text-danger">*</span></label>
                    <input class="form-control mb-2" type="text" name="harga" id="harga" placeholder="Harga"
                        value="{{ old('harga') }}" />
                    @error('harga')
                        <div class="text-danger small ms-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="form-label" class="mb-2 ms-1">Stok <span class="text-danger">*</span></label>
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
