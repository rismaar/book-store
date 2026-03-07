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

<a href="{{ route('create') }}" class="btn mb-3 mt-3 text-light justify-content-center" style="background-color: #3B38A0"><i class="fa-solid fa-folder-plus me-2"></i><b>Add Supplier</b></a>
<div class="conatiner-fluid d-flex justify-content-center shadow-lg rounded-3 p-3">
    <table id="myTable" class="table-stripped">
        <thead align="center">
            <tr>
                <th class="bg-secondary-subtle">Company Name</th>
                <th class="bg-secondary-subtle">Address</th>
                <th class="bg-secondary-subtle">Email</th>
                <th class="bg-secondary-subtle">Status</th>
                <th class="bg-secondary-subtle">Menu</th>
            </tr>  
        </thead>
        <tbody>
            @foreach ($supplier as $supp)
                <tr>
                    <td>{{ $supp->nama_perusahaan }}</td>
                    <td width="40%">{{ $supp->alamat }}</td>
                    <td>{{ $supp->email }}</td>
                    <td>
                        @if ($supp->status == 'Active')
                            <div class="container p-2 text-success rounded-5 text-center fw-bold bg-success-subtle">
                                {{ $supp->status }}
                            </div>
                        @else
                            <div class="container p-2 text-danger rounded-5 text-center fw-bold bg-danger-subtle" >
                                {{ $supp->status }}
                            </div>
                        @endif
                    </td>
                    <td class="align-middle text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <button type="button" class="btn btn-link border-o p-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $supp->siup }}">
                                <i class="fa-solid fa-circle-info" style="color: #20365a;"></i>
                            </button>

                            <button type="button" class="btn border-0 ms-3" data-bs-toggle="modal" data-bs-target="#staticUpdate{{ $supp->siup }}">
                                <i class="fa-solid fa-arrows-rotate me-2"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @foreach ($supplier as $supp)
        <div class="modal fade" id="staticBackdrop{{ $supp->siup }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel"><b>{{ $supp->nama_perusahaan }}</b></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th width="50%">Supplier ID</th>
                                    <td>{{ $supp->siup }}</td>
                                </tr>
                                <tr>
                                    <th width="50%">Phone</th>
                                    <td>{{ $supp->telp_pt }}</td>
                                </tr>
                                <tr>
                                    <th width="50%">Bank Account</th>
                                    <td>{{ $supp->no_rek }} - {{ $supp->bank }}</td>
                                </tr>
                                <tr>
                                    <th width="50%"><i>Contact Person</i></th>
                                    <td>{{ $supp->narahubung }} - {{ $supp->no_telp }}</td>
                                </tr>
                                <tr>
                                    <th width="50%">Email</th>
                                    <td>{{ $supp->email }}</td>
                                </tr>
                                <tr>
                                    <th width="50%">Address</th>
                                    <td>{{ $supp->alamat }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="staticUpdate{{ $supp->siup }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update data <b>{{ $supp->nama_perusahaan }}</b></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('update.supp', $supp->siup) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_perusahaan" class="form-label">Company Name</label>
                                    <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" value="{{ old('nama_perusahaan', $supp->nama_perusahaan) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="alamat" class="form-label">Address</label>
                                    <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control" >{{ old('alamat', $supp->alamat) }}</textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="telp_pt" class="form-label">Company Phone</label>
                                    <input type="text" name="telp_pt" id="telp_pt" class="form-control" value="{{ old('telp_pt', $supp->telp_pt) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="no_rek" class="form-label">Bank Account</label>
                                    <input type="text" name="no_rek" id="no_rek" class="form-control" value="{{ old('no_rek', $supp->no_rek) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="bank" class="form-label">Bank</label>
                                    <input type="text" name="bank" id="bank" class="form-control" value="{{ old('bank', $supp->bank) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="text" name="email" id="email" class="form-control" value="{{ old('email', $supp->email) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="narahubung" class="form-label">Contact Person</label>
                                    <input type="text" name="narahubung" id="narahubung" class="form-control" value="{{ old('narahubung', $supp->narahubung) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="no_telp" class="form-label">Contact Person Phone</label>
                                    <input type="text" name="no_telp" id="no_telp" class="form-control" value="{{ old('no_telp', $supp->no_telp) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">pilih</option>
                                        <option value="Active" {{ old('status', $supp->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Inactive" {{ old('status', $supp->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn text-white rounded-4" style="width: 160px; height: 60px; background-color: #3B38A0"><b>Save</b></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('#datatables').DataTable();
    });
</script>
@endpush