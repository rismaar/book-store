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
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container-fluid rounded-3 shadow-lg p-3 mt-3">
    <table id="myTable" class="table table-bordered table-sm w-auto mb-0">
        <thead align="center">
            <tr>
                <th class="bg-secondary-subtle">Id Restock</th>
                <th class="bg-secondary-subtle">Tanggal Request</th>
                <th class="bg-secondary-subtle">Tanggal Diterima</th>
                <th class="bg-secondary-subtle">Tanggal Ditolak</th>
                <th class="bg-secondary-subtle">Supplier</th>
                <th class="bg-secondary-subtle">Produk</th>
                <th class="bg-secondary-subtle">Total</th>
                <th class="bg-secondary-subtle" style="width: 1%; white-space: nowrap;">Menu</th>
            </tr>
        </thead>
        <tbody class="justify-content-center">
            @foreach ($restock as $res)
                <tr>
                    <td>{{ $res->id_restock }}</td>
                    <td>{{ \Carbon\Carbon::parse($res->restock_date)->translatedFormat('d F Y') }}</td>
                    <td>{{ $res->accepted_at ? \Carbon\Carbon::parse($res->accepted_at)->translatedFormat('d F Y') : '-' }}</td>
                    <td>{{ $res->rejected_at ? \Carbon\Carbon::parse($res->rejected_at)->translatedFormat('d F Y') : '-' }}</td>
                    <td>{{ $res->supplier->nama_perusahaan }}</td>
                    <td>
                        <div class="d-flex">
                            <table class="table table-bordered">
                            
                                <thead>
                                    <tr class="text-muted">
                                        <th>Nama Barang</th>
                                        <th>Qty</th>
                                    </tr>
                                </thead>
                                @foreach ($res->details as $detail)
                                <tbody>
                                    <tr>
                                        <td>{{ $detail->book->title }}</td>
                                        <td>{{ $detail->qty }}</td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </td>
                    <td>Rp. {{ number_format($res->total, 2) }} @if ($res->status === 'accepted') <b class="text-success">(PAID)</b>
                        
                    @endif</td>
                    <td class="text-end" >
                        <div class="d-inline-flex justify-content-end align-items-center gap-2" style="white-space: nowrap;">

                            @php
                                $statusClass = match($res->status) {
                                    'confirmed' => 'bg-warning text-light fw-bold',
                                    'approved'  => 'bg-success text-light fw-bold',
                                    'accepted'  => 'bg-info text-light fw-bold',
                                    'rejected'  => 'bg-danger text-light fw-bold',
                                    default     => 'bg-secondary text-light fw-bold'
                                };
                            @endphp

                            <div class="dropdown">
                                <button
                                    class="btn {{ $statusClass }} dropdown-toggle btn-sm"
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false" @if ($res->status === 'accepted' or $res->status === 'rejected') disabled @endif>
                                    {{ ucfirst($res->status) }}
                                </button>

                                <ul class="dropdown-menu dropdown-menu-end" @if ($res->status == 'accepted' or $res->status == 'rejected') d-none @endif>
                                    <li class="dropdown-header">Ubah Status</li>
                                    <li><hr class="dropdown-divider"></li>

                                    @foreach (['confirmed','approved','accepted','rejected'] as $status)
                                        <li>
                                            <a href="#"
                                            class="dropdown-item status-item"
                                            data-id="{{ $res->id_restock }}"
                                            data-status="{{ $status }}">
                                                {{ ucfirst($status) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <a href="{{ route('invoiceReq', $res->id_restock) }}"class="btn btn-primary btn-sm fw-bold"><i class="fa-solid fa-file-lines"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        $(document).on('click', '.status-item', function (e) {
            e.preventDefault();
            const id = $(this).data('id_restock');
            const status = $(this).data('status');
            const btn = $(this).closest('.dropdown').find('button');

            fetch(`/updateStatus/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status })
            })
            .then(async res => {
                const data = await res.json();

                if (!res.ok) {
                    console.error('BACKEND ERROR:', data);
                    alert(data.error ?? 'Terjadi kesalahan');
                    return;
                }

                return data;
            })
            .then(data => {
                if (!data) return;

                btn.text(data.status.charAt(0).toUpperCase() + data.status.slice(1));
                btn
                    .removeClass()
                    .addClass('btn btn-sm dropdown-toggle ' + getStatusClass(data.status));
            })
            .catch(err => console.error('FETCH ERROR:', err));
        });

    });

    function getStatusClass(status) {
        switch (status) {
            case 'confirmed': return 'bg-warning text-light fw-bold';
            case 'approved': return 'bg-success text-light fw-bold';
            case 'accepted': return 'bg-info text-light fw-bold';
            case 'rejected': return 'bg-danger text-light fw-bold';
            default: return 'bg-secondary text-light fw-bold';
        }
    }
</script>
    
@endpush

@endsection