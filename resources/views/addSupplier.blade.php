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

<h3 style="align: center;" class="mb-2 mt-3 ml-3"><i class="fa-solid fa-database mr-3" style="color: #8a1480;"></i>Tambah Supplier</h3>
<div class="container-fluid shadow-lg rounded-3 p-5 mt-3">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('storeSupp') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="telp_pt" class="form-label">No.Telp Perusahaan</label>
                        <input type="text" name="telp_pt" id="telp_pt" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="no_rek" class="form-label">No.Rekening</label>
                        <input type="text" name="no_rek" id="no_rek" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="bank" class="form-label">Bank</label>
                        <input type="text" name="bank" id="bank" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">E-mail </label>
                        <input type="text" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="narahubung" class="form-label">Narahubung</label>
                        <input type="text" name="narahubung" id="narahubung" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="no_telp" class="form-label">No.Telp Narahubung</label>
                        <input type="text" name="no_telp" id="no_telp" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">pilih</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Non Aktif">Non Aktif</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><b>Simpan</b></button>
            </form>
        </div>
    </div>
</div>

@endsection
