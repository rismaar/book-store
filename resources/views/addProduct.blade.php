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
<div class="container-fluid p-5 mt-3 shadow-lg rounded-3">
    <h3 style="align: center;" class="mb-3 ml-3"><i class="fa-solid fa-book me-2" style="color: #3B38A0"></i><b>New Product</b></h3>
    <form action="{{ route('storeBook') }}" method="POST" enctype="multipart/form-data"> 
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="isbn" class="col-form-label"><b>ISBN</b></label>
                <input type="text" class="form-control p-3" id="isbn" name="isbn">
            </div>
            <div class="col-md-6 mb-3">
                <label for="title" class="col-form-label"><b>Book Title</b></label>
                <input type="text" class="form-control p-3" id="title" name="title">
            </div>
            <div class="col-md-6 mb-3">
                <label for="author" class="col-form-label"><b>Author</b></label>
                <input type="text" class="form-control p-3" id="author" name="author">
            </div>
            <div class="col-md-6 mb-3">
                <label for="publish_date" class="col-form-label"><b>Publication Date</b></label>
                <input type="date" class="form-control p-3" id="publish_date" name="publish_date">
            </div>
            <div class="col-md-6 mb-3">
                <label for="pages" class="col-form-label"><b>Pages</b></label>
                <input type="number" class="form-control p-3" id="pages" name="pages">
            </div>
            <div class="col-md-6 mb-3">
                <label for="categories" class="col-form-label"><b>Category</b></label>
                <select name="categories" class="form-select p-3" aria-label="Default select example">
                    <option value="" >Choose category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id_kategori }}">
                            {{ $category->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="supplier_id" class="col-form-label"><b>Publisher</b></label>
                <select name="supplier_id" class="form-control p-3" aria-label="Default select example">
                    <option value="">Choose publisher</option>
                    @foreach ($supplier as $supp)
                        <option value="{{ $supp->siup }}">
                            {{ $supp->nama_perusahaan }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="price" class="col-form-label"><b>Price</b></label>
                <input type="decimal" class="form-control p-3" id="price" name="price">
            </div>
            <div class="col-md-6 mb-3">
                <label for="stock" class="col-form-label"><b>Stock</b></label>
                <input type="number" class="form-control p-3" id="stock" name="stock">
            </div>
            <div class="col-md-6 mb-3">
                <label for="description" class="col-form-label"><b>Description</b></label>
                <textarea class="form-control p-3" id="description" name="description"></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label for="image" class="col-form-label"><b>Cover</b></label>
                <input type="file" class="form-control p-3" id="image" name="image" >
            </div>
        </div>
        <button type="submit" class="btn p-3 rounded-4 text-white fw-bold" style="width: 160px; height: 60px; background-color: #3B38A0"></i>Save</button>
    </form>
</div>
@endsection