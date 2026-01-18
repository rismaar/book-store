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

<style>
.form-container {
    display: none;
}

.form-container.show {
    display: block;
}
</style>


<a id="addItem" type="button" class="btn btn-primary"><i class="fa-solid fa-folder-plus me-2"></i><b>Add Category</b></a>
<div class="conatiner-fluid d-flex justify-content-center shadow-lg rounded-3 p-3 mt-3">
    <table id="table" class="table table-stripped">
        <thead align="center">
            <tr>
                <th class="bg-secondary-subtle">Id Kategori</th>
                <th class="bg-secondary-subtle">Kategori Buku</th>
            </tr>  
        </thead>
        <tbody align="center">
            @foreach ($kategori as $k)
                <tr>
                    <td>{{ $k->id_kategori }}</td>
                    <td>{{ $k->nama_kategori }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="addKategori" class="container-fluid rounded-3 shadow-lg p-3 form-container mt-5">
    <form action="{{ route('addKategori') }}" method="POST">
        @csrf
        <div class="col-md-6 mb-3">
            <label for="nama_kategori" class="col-form-label">Kategori</label>
            <input type="text" id="nama_kategori" name="nama_kategori" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary"><b>Simpan</b></button>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function(){
            document.getElementById("addItem").addEventListener("click", function(){
            document.getElementById("addKategori").classList.toggle("show");
        });
    });
</script>
@endpush
@endsection