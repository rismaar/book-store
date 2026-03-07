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

<h5 class="title mb-3">Recent Restock Requests</h5>
<div class="container-fluid mb-3">
    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 bg-primary-subtle">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h5 class="card-title fw-bold text-primary">{{ $acceptedCount }} </h5>
                    <h5 class="card-title fw-bold text-primary"><i class="fa-solid fa-circle-check me-2"></i>Accepted</h5>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 bg-danger-subtle">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h5 class="card-title fw-bold text-danger">{{ $rejectedCount }} </h5>
                    <h5 class="card-title fw-bold text-danger"><i class="fa-solid fa-circle-xmark me-2"></i>Rejected</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid rounded-3 shadow-lg p-3 mt-3">
    <table id="myTable" class="table table-bordered table-sm w-auto mb-0">
        <thead align="center">
            <tr>
                <th class="bg-secondary-subtle">Restock ID</th>
                <th class="bg-secondary-subtle">Request Date</th>
                <th class="bg-secondary-subtle">Accepted Date</th>
                <th class="bg-secondary-subtle">Rejected Date</th>
                <th class="bg-secondary-subtle">Supplier</th>
                <th class="bg-secondary-subtle">Product</th>
                <th class="bg-secondary-subtle">Total</th>
                <th class="bg-secondary-subtle" style="width: 1%; white-space: nowrap;">Status</th>
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
                                        <th>Product Name</th>
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
                                    class="btn {{ $statusClass }} btn-sm rounded-4 p-2"
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
                            <a href="{{ route('invoiceReq', $res->id_restock) }}"class="btn"><i class="fa-solid fa-file-lines fa-xl"  style="color: #3B38A0;"></i></a>
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