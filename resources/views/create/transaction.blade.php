@extends('main.body')

@section('container')
    <div class="d-flex flex-nowrap align-items-center justify-content-between pt-3 pb-2 mb-4  border-bottom">
        <h1 class="h3">{{ $title }}</h1>
    </div>
    <div class="row">
        <form action="/transaction" method="POST" class="border rounded col-lg-11">
            @csrf
            <div class="row py-3 px-3 products">
                <h4 class="my-3 mb-4">Buat Penjualan</h4>
                <div class="col-md-3 pe-4 mb-3">
                    <label for="customer" class="mb-2 ms-1">Customer <span class="text-danger">*</span></label>
                    <select name="customer" id="customer" class="form-select" onchange="addCustomer(this)">
                        <option value="" hidden selected></option>
                        <option value="/customer/create">Tambah Customer</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">
                                {{ $customer->nama_pelanggan . ' - ' . $customer->id }}</option>
                        @endforeach
                    </select>
                    @error('customer')
                        <div class="text-danger small ms-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                @if ($errors->all())
                    @foreach (old('produk_id') as $index => $produk)
                        <div class="product position-relative mb-3">
                            <div class="row pe-4">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <label for="form-label" class="mt-4 mb-2 ms-1">Nama Produk <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select produk_id" name="produk_id[]" onchange="cariProduk(this)">
                                        <option value="" hidden selected></option>
                                        @foreach ($products as $product)
                                            @if (old('produk_id')[$index] == $product->id)
                                                <option value="{{ $product->id }}" selected>
                                                    {{ $product->nama_produk . ' - ' . $product->id }}
                                                </option>
                                            @else
                                                <option value="{{ $product->id }}">
                                                    {{ $product->nama_produk . ' - ' . $product->id }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('produk_id.' . $index)
                                        <div class="text-danger err-message small ms-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <label for="form-label" class="mt-4 mb-2 ms-1">Harga</label>
                                    <input class="form-control mb-2 harga" type="text" name="harga[]" placeholder="Harga"
                                        value="{{ old('harga')[$index] }}" readonly />
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <label for="form-label" class="mt-4 mb-2 ms-1">Jumlah Produk <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control mb-2 jumlah_produk" type="number" name="jumlah_produk[]"
                                        placeholder="Jumlah Produk" value="{{ old('jumlah_produk')[$index] }}"
                                        oninput="hitung(this)" />
                                    @error('jumlah_produk.' . $index)
                                        <div class="text-danger err-message small ms-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <label for="form-label" class="mt-4 mb-2 ms-1">Subtotal</label>
                                    <input class="form-control mb-2 subtotal" type="number" name="subtotal[]"
                                        placeholder="Subtotal" value="{{ old('subtotal')[$index] }}" readonly />
                                </div>
                            </div>
                            <button type="button" class="btn btn-transparent p-1 position-absolute delete-penjualan"
                                onclick="deletePenjualan(this)" style="right: 0px; top: 50%; transform: translateY(-30%)">
                                <i class="bi bi-x-circle text-danger"></i>
                            </button>
                        </div>
                    @endforeach
                @else
                    @include('components.createPenjualan')
                @endif
            </div>
            <button type="button" class="btn btn-primary mb-5 mx-3 mt-1 add-penjualan" onclick="addPenjualan()">Tambah
                Penjualan</button>
            <button type="submit" class="btn btn-primary mb-5 mx-3 mt-1">Buat Penjualan</button>
        </form>
    </div>

    <script>
        let selectedProduct = false;

        if($('.product').length <= 1){
            $('.delete-penjualan').hide();
        }
        unreload();

        function unreload() {
            $('input').each(function() {
                $(this).keydown(function(e) {
                    if (e.key == 'Enter') {
                        e.preventDefault();
                    }
                });
            });
        }

        function addPenjualan() {
            let newPenjualan = $('.product:first').clone();
            newPenjualan.find('input').val('');
            newPenjualan.find('.produk_id').attr('produk_id', '');
            newPenjualan.find('.produk_id option:first').prop('selected', true);
            newPenjualan.find('.err-message').hide();
            $('.products').append(newPenjualan);
            $('.delete-penjualan').show();
            newPenjualan.find('.produk_id').focus();
        }

        function deletePenjualan(element) {
            $(element).parent('.product').remove();

            if ($('.delete-penjualan').length == 1) {
                $('.delete-penjualan').hide();
            }
        }

        function addCustomer(element) {
            if ($(element).val() == '/customer/create') {
                return window.location.href = $(element).val();
            }
        }

        function hitung(element) {
            let produkForm = $(element).parent('div').parent('.row').parent('.product');
            let harga = produkForm.find('.harga');
            let subtotal = produkForm.find('.subtotal');
            subtotal.val($(element).val() * harga.val());
        }

        function cariProduk(element) {
            let produkForm = $(element).parent('div').parent('.row').parent('.product');

            $('.product').each(function() {
                if ($(this).find('.produk_id').attr('produk_id') == $(element).val()) {
                    alert('Produk ini sudah dipilih, pilih produk lain');
                    $(element).find('option[value=' + $(element).attr('produk_id') + ']').prop('selected', true);
                    selectedProduct = true;
                    return false;
                }
            })

            // console.log(selectedProduct)

            if (!selectedProduct) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: 'GET',
                    dataType: 'JSON',
                    url: 'http://localhost:8000/product/' + element.value,
                    data: {},
                    success: function(response) {
                        $(produkForm).find('.produk_id').val(response.id);
                        $(produkForm).find('.produk_id').attr('produk_id', response.id);
                        $(produkForm).find('.nama_produk').val(response.nama_produk);
                        $(produkForm).find('.harga').val(response.harga);

                        let jmlProduct = $(produkForm).find('.jumlah_produk').val();
                        $(produkForm).find('.subtotal').val(response.harga * (jmlProduct ==
                            '' ? 0 : jmlProduct));
                        $(produkForm).find('.jumlah_produk').focus();
                        return false;
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            }
            selectedProduct = false;
        }
    </script>
@endsection
