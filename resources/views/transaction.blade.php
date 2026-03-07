@extends('layouts.app')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success"><i class="fa-solid fa-circle-check me-2"></i>
        {{ session('success') }}
    </div>
@endif

@auth
    @if (in_array(auth()->user()->role, ['kasir']))
        <a href="{{ route('addTrans') }}" class="btn" style="background-color: #3B38A0; color: white;"><i class="fa-solid fa-folder-plus me-2"></i><b>Add Transaction</b></a>
    @endif
@endauth

<form action="{{ route('viewTrans') }}" method="GET" class="mt-3 row g-2">
    <div class="col-md-3">
        <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
    </div>
    <div class="col-md-3">
        <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn text-white" style="background-color: #3B38A0"><b>Filter</b></button>
        @if (request('start_date') && request('end_date'))
            <a href="{{ route('report', ['start_date' => request('start_date'),
                'end_date' => request('end_date') ]) }}" target="_blank" class="btn btn-secondary"><b>Print Report</b></a>
        @endif
    </div>
</form>
<div class="container-fluid rounded-3 shadow-lg p-3 mt-2">
    <table id="myTable" class="table table-bordered">
        <thead>
            <tr>
                <th class="bg-secondary-subtle">ID Transaksi</th>
                <th class="bg-secondary-subtle">Tanggal</th>
                <th class="bg-secondary-subtle">Metode Pembayaran</th>
                <th class="bg-secondary-subtle">Qty</th>
                <th class="bg-secondary-subtle">Total</th>
                <th class="bg-secondary-subtle"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $t)
                <tr>
                    <td>{{ $t->id_transaksi }}</td>
                    <td>{{ \Carbon\Carbon::parse($t->tanggal)->translatedFormat('d F Y') }}</td>
                    <td>{{ $t->metode_pembayaran }}</td>
                    <td>{{ $t->details->sum('jumlah') }}</td>
                    <td>Rp. {{ number_format($t->grand_total, 2) }}</td>
                    <td class="d-flex justify-content-center">
                        <button type="button" class="btn" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop{{ $t->id_transaksi }}" >
                            <i class="fa-solid fa-eye" style="color: #3B38A0"></i>
                        </button>
                        <a href="{{ route('invoice', $t->id_transaksi) }}" target="_blank" class="btn ms-3"><i class="fa-solid fa-receipt" style="color: #3B38A0"></i></a> 
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @foreach ($transaksi as $t)
        <div class="modal fade" id="staticBackdrop{{ $t->id_transaksi }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ $t->id_transaksi }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body invoice-content">
                        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($t->tanggal)->translatedFormat('d F Y') }}</p>
                        <table class="table table-stripped">    
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($t->details as $d)
                                <tr>
                                    <td><img src="{{ asset('storage/cover/' . $d->buku->image) }}" width="80" alt=""> {{ $d->buku->title ?? $d->nama_produk }}</td>
                                    <td>{{ $d->jumlah }}</td>
                                    <td>Rp. {{ number_format($d->price,2) }}</td>
                                    <td>Rp. {{ number_format($d->total,2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p><strong>Total:</strong>Rp. {{ number_format($t->grand_total,2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
        
@endsection