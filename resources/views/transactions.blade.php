@extends('main.body')

@section('container')
    <div class="container">
        <div class="d-flex flex-nowrap align-items-center justify-content-between pt-3 pb-2 mb-4  border-bottom">
            <h1 class="h3">{{ $title }}</h1>
            <form>
                @if (request(['start_date', 'end_date']))
                    <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                    <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                @endif
                <input type="text" class="form-control" name="search" placeholder="Search..."
                    value="{{ request('search') }}" autofocus>
            </form>
        </div>
        <div class="row gap-2">
            <div class="table-responsive table-sm mb-3">
                <form method="GET" class="mx-2">
                    <div class="row mt-4">
                        @if (request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}" />
                        @endif
                        <div class="col-md-4 col-sm-5 mb-1">
                            <label class="form-label ms-1" for="start_date">Start Date : </label>
                            <input class="form-control" type="date" id="start_date" name="start_date"
                                placeholder="Pilih Tanggal" value="{{ old('start_date', request('start_date')) }}">
                            @error('start_date')
                                <div class="text-danger mx-1 small error-message">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-5 mb-1">
                            <label class="form-label ms-1" for="end_date">End Date : </label>
                            <input class="form-control" type="date" id="end_date" name="end_date"
                                placeholder="Pilih Tanggal" value="{{ old('end_date', request('end_date')) }}">
                            @error('end_date')
                                <div class="text-danger mx-1 small error-message">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <button class="btn btn-success my-4 px-3" type="submit">Filter</button>
                </form>
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
