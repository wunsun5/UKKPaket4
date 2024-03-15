<div class="row mt-5 mb-3">
    <div class="table-responsive col-xl-7 small">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Pelanggan ID</th>
                    <th scope="col">Nama Pelanggan</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No Telp</th>
                    <th scope="col">Tools</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->nama_pelanggan }}</td>
                        <td>{{ $customer->alamat ?? ' - ' }}</td>
                        <td>{{ $customer->no_telp ?? ' - ' }}</td>
                        <td>
                            <a href="/customer/{{ $customer->id }}/edit" class="btn btn-warning p-1">
                                <i class="bi bi-pencil text-white fs-6"></i>
                            </a>
                            <form action="/customer/{{ $customer->id }}" method="POST" class="d-inline m-0">
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
