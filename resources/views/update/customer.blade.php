@extends('main.body')

@section('container')
    <div class="d-flex flex-nowrap align-items-center justify-content-between pt-3 pb-2 mb-4  border-bottom">
        <h1 class="h3">{{ $title }}</h1>
    </div>
    <div class="row">
        <form action="/customer/{{ $customer->id }}" method="POST" class="border rounded col-lg-10">
            @method('PUT')
            @csrf
            <div class="row py-3 px-3">
                <h4 class="my-3 mb-4">Edit Pelanggan</h4>
                <div class="col-md-4">
                    <label for="form-label" class="mb-2 ms-1">Nama Pelanggan <span class="text-danger">*</span></label>
                    <input class="form-control mb-2" type="text" name="nama_pelanggan" id="nama_pelanggan"
                        placeholder="Nama Pelanggan" value="{{ old('nama_pelanggan', $customer->nama_pelanggan) }}" />
                    @error('nama_pelanggan')
                        <div class="text-danger small ms-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="form-label" class="mb-2 ms-1">Alamat <span class="text-secondary">(Optional)</span></label>
                    <input class="form-control mb-2" type="text" name="alamat" id="alamat" placeholder="Alamat"
                        value="{{ old('alamat', $customer->alamat) }}" />
                    @error('alamat')
                        <div class="text-danger small ms-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="form-label" class="mb-2 ms-1">No Telp <span class="text-secondary">(Optional)</span></label>
                    <input class="form-control mb-2" type="number" min="0" max="10000000000000" name="no_telp" id="no_telp" placeholder="No Telp"
                        value="{{ old('no_telp', $customer->no_telp) }}" />
                    @error('no_telp')
                        <div class="text-danger small ms-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary mb-5 mx-3 mt-1">Edit Pelanggan</button>
        </form>
    </div>

    @include('customers')
@endsection
