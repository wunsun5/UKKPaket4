<div class="product position-relative mb-3">
    <div class="row pe-4">
        <div class="col-lg-3 col-md-6 col-12">
            <label for="form-label" class="mb-2 ms-1">Nama Produk <span class="text-danger">*</span></label>
            <select class="form-select produk_id" name="produk_id[]" onchange="cariProduk(this)">
                <option value="" hidden selected></option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->nama_produk . ' - ' . $product->id }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <label for="form-label" class="mb-2 ms-1">Harga</label>
            <input class="form-control mb-2 harga" type="text" name="harga[]" placeholder="Harga" readonly />
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <label for="form-label" class="mb-2 ms-1">Jumlah Produk <span
                    class="text-danger">*</span></label>
            <input class="form-control mb-2 jumlah_produk" type="number" name="jumlah_produk[]"
                placeholder="Jumlah Produk" oninput="hitung()" />
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <label for="form-label" class="mb-2 ms-1">Subtotal</label>
            <input class="form-control mb-2 subtotal" type="number" name="subtotal[]"
                placeholder="Subtotal" readonly />
        </div>
    </div>
    <button type="button" class="btn btn-transparent p-1 position-absolute delete-penjualan" onclick="deletePenjualan(this)"
        style="right: 0px; top: 50%; transform: translateY(-30%)">
        <i class="bi bi-x-circle text-danger"></i>
    </button>
</div>
