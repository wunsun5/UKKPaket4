@extends('main.body')

@section('container')
    <div class="container">
        <h3 class="my-3">{{ $title }}</h3>
        <hr class="my-3 mb-5">
        <div class="row gap-2">
            <div class="table-responsive col-md-8 col-lg-9 mb-3">
                <div class="print-area">
                    <table class="table table-body-tertiary table-striped small">
                        <thead class="table-secondary">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Penjualan ID</th>
                                <th scope="col">Pelanggan</th>
                                <th scope="col">Tgl Penjualan</th>
                                <th scope="col">Total Transaksi</th>
                                <th scope="col" class="text-center tools">Tools</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->customer->nama_pelanggan }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                    <td>{{ 'Rp ' . number_format($transaction->total_harga, 2, ',', '.') }}</td>
                                    <td class="tools">
                                        <div class="d-flex justify-content-evenly">
                                            <a href="/transaction/{{ $transaction->id }}" class="me-1">
                                                <i class="bi bi-ticket-detailed bg-success p-1 rounded"></i>
                                            </a>
                                            <form action="/transaction/{{ $transaction->id }}" method="POST"
                                                class="d-inline-block p-0 m-0">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="m-0 p-0 border-0"
                                                    onclick="return confirm('Yakin ingin hapus ?')">
                                                    <i class="bi bi-trash bg-danger rounded p-1"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($transactions->lastPage() == $transactions->currentPage())
                                <tr>
                                    <td colspan="4" class="text-center">Total Transaksi</td>
                                    <td style="border-top: 2px solid black">
                                        {{ 'Rp ' . number_format($total_penjualan, 2, ',', '.') }}</td>
                                    <td></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ $transactions->links() }}
        <button class="btn btn-primary px-4 mx-2" id='btn-print'>Print</button>
    </div>
    <script>
        $('#btn-print').click(function() {
            let page = $('body').html();
            let printArea = $('.print-area').html();
            $('body').html("<h4 class='my-3 text-center'>{{ $title }}</h4>")
            $('body').append(printArea);

            window.print();

            $('body').html(page);
        })
    </script>
@endsection
