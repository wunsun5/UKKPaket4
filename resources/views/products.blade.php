<div class="row mt-5 mb-3">
    <div class="table-responsive col-xl-7 small">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Produk ID</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah Stok</th>
                    <th scope="col">Tools</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->nama_produk }}</td>
                        <td>{{ 'Rp ' . number_format($product->harga, 2, ',', '.') }}</td>
                        <td>{{ $product->stok }}</td>
                        <td>
                            <a href="/product/{{ $product->id }}/edit" class="btn btn-warning p-1">
                                <i class="bi bi-pencil text-white fs-6"></i>
                            </a>
                            <form action="/product/{{ $product->id }}" method="POST" class="d-inline m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger p-1" onclick="return confirm('Yakin ingin dihapus ?')">
                                    <i class="bi bi-trash text-white fs-6"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
