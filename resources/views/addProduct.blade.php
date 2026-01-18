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
<h3 style="align: center;" class="mb-2 mt-3 ml-3"><i class="fa-solid fa-database mr-3" style="color: #8a1480;"></i>Tambah Data Buku</h3>
<div class="container-fluid shadow-lg rounded-3 p-5 mt-3">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('storeBook') }}" method="POST" enctype="multipart/form-data"> 
                @csrf
                <div class="mb-3">
                    <label for="isbn" class="col-form-label">ISBN</label>
                    <input type="text" class="form-control" id="isbn" name="isbn">
                </div>
                <div class="mb-3">
                    <label for="title" class="col-form-label">Judul Buku</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="mb-3">
                    <label for="author" class="col-form-label">Penulis</label>
                    <input type="text" class="form-control" id="author" name="author">
                </div>
                <div class="mb-3">
                    <label for="publish_date" class="col-form-label">Tanggal Rilis</label>
                    <input type="date" class="form-control" id="publish_date" name="publish_date">
                </div>
                <div class="mb-3">
                    <label for="pages" class="col-form-label">Halaman</label>
                    <input type="number" class="form-control" id="pages" name="pages">
                </div>
                <div class="mb-3">
                    <label for="categories" class="col-form-label">Kategori</label>
                    <select name="categories" class="form-select" aria-label="Default select example">
                        <option value="" >pilih kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id_kategori }}">
                                {{ $category->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="supplier_id">Penerbit</label>
                    <select name="supplier_id" class="form-control">
                        <option value=""> Pilih</option>
                        @foreach ($supplier as $supp)
                            <option value="{{ $supp->siup }}">
                                {{ $supp->nama_perusahaan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="price" class="col-form-label">Harga</label>
                    <input type="decimal" class="form-control" id="price" name="price">
                </div>
                <div class="mb-3">
                    <label for="stock" class="col-form-label">Stok</label>
                    <input type="number" class="form-control" id="stock" name="stock">
                </div>
                <div class="mb-3">
                    <label for="description" class="col-form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="col-form-label">Cover</label>
                    <input type="file" class="form-control" id="image" name="image" >
                </div>
                <div class="my-2 d-flex">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection