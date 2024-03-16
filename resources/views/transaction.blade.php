@extends('main.body')

@section('container')
    <div class="d-flex flex-nowrap align-items-center justify-content-between pt-3 pb-2 mb-4  border-bottom">
        <h1 class="h4">{{ $title }}</h1>
    </div>
    <div class="row" id="print-area">
        <div class="row table-responsive col-md-6 gy-1 p-4">
            <div class="col-6 text-nowrap">
                Tanggal Transaksi
            </div>
            <div class="col-6">
                : {{ date('d M Y', strtotime($transaction->created_at)) }}
            </div>
            <div class="col-6 text-nowrap">
                Kode Transaksi
            </div>
            <div class="col-6">
                : {{ $transaction->id }}
            </div>
            <div class="col-6 text-nowrap">
                Pelanggan
            </div>
            <div class="col-6">
                : {{ $transaction->customer->nama_pelanggan}}
            </div>
        </div>
        <div class="row">
            <div class="table-responsive small col-xl-9">
                <table class="table table-striped table-sm mt-4">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Kode Produk</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $detail)
                            <tr>
                                <td class="">
                                    {{ $loop->iteration }}
                                </td>
                                <td>{{ $detail->product->id ?? '-' }}</td>
                                <td>{{ $detail->product->nama_produk ?? '-' }}</td>
                                <td>{{ ('Rp ' . number_format($detail->product->harga ?? 0, 2, ',', '.'))}}</td>
                                <td>{{ $detail->jumlah_produk ?? '-' }}</td>
                                <td>
                                    {{ 'Rp ' . number_format($detail->subtotal, 2, ',', '.') ?? '-' }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5" class="text-center text-nowrap px-4 fw-bold">Total Transaksi</td>
                            <td style="border-top: 2px solid !important">
                                {{ 'Rp ' . number_format($transaction->total_harga, 2, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <button class="btn btn-primary px-4 my-4" id="print">Print</button>

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
