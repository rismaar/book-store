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

<div class="container-fluid shadow-lg rounded-3 p-5 mt-3">
    <h3 style="align: center;" class="mb-2 ml-3"><i class="fa-solid fa-people-arrows me-2" style="color: #3B38A0"></i><b>New Supplier</b></h3>
    <form action="{{ route('storeSupp') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nama_perusahaan" class="form-label"><b>Company Name</b></label>
                <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control p-3" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="alamat" class="form-label"><b>Address</b></label>
                <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control p-3"></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label for="telp_pt" class="form-label"><b>Company Phone</b></label>
                <input type="text" name="telp_pt" id="telp_pt" class="form-control p-3" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="no_rek" class="form-label"><b>Bank Account</b></label>
                <input type="text" name="no_rek" id="no_rek" class="form-control p-3" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="bank" class="form-label"><b>Bank</b></label>
                <input type="text" name="bank" id="bank" class="form-control p-3" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label"><b>E-mail</b></label>
                <input type="text" name="email" id="email" class="form-control p-3" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="narahubung" class="form-label"><b>Contact Person</b></label>
                <input type="text" name="narahubung" id="narahubung" class="form-control p-3" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="no_telp" class="form-label"><b>Contact Person Phone</b></label>
                <input type="text" name="no_telp" id="no_telp" class="form-control p-3" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="status" class="form-label"><b>Status</b></label>
                <select name="status" id="status" class="form-control p-3">
                    <option value="">Choose Status</option>
                    <option value="Aktif">Active</option>
                    <option value="Non Aktif">Inactive</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn rounded-4 p-3 text-white" style="width: 160px; height: 60px; background-color: #3B38A0"><b>Save</b></button>
    </form>
</div>

@endsection
