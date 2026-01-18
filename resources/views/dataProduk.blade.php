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
<a href="{{ route('addProduct') }}" class="btn btn-primary mb-3 mt-3 text-light justify-content-center"><i class="fa-solid fa-folder-plus mr-3"></i><b>Add Product</b></a>
<div class="container-fluid p-3 shadow-lg rounded-3">
    <table id="myTable" class="table table-bordered">
        <thead align="center">
            <tr>
                <th class="bg-secondary-subtle">ISBN</th>
                <th class="bg-secondary-subtle">Judul Buku</th>
                <th class="bg-secondary-subtle">Penulis</th>
                <th class="bg-secondary-subtle">Tanggal Rilis</th>
                <th class="bg-secondary-subtle">Penerbit</th>
                <th class="bg-secondary-subtle">Kategori</th>
                <th class="bg-secondary-subtle">Harga Beli</th>
                <th class="bg-secondary-subtle">Harga Jual</th>
                <th class="bg-secondary-subtle">Stok</th>
                <th class="bg-secondary-subtle">Cover</th>
                <th class="bg-secondary-subtle"></th>
            </tr>
        </thead>
        <tbody class="justify-content-center" align="center">
            @foreach ($books as $book)
            <tr>
                <td>{{$book->isbn}}</td>
                <td>{{$book->title}}</td>
                <td>{{$book->author}}</td>
                <td>{{$book->publish_date}}</td>
                <td>{{$book->supplier->nama_perusahaan}}</td>
                <td>{{$book->kategori->nama_kategori}}</td>
                <td>Rp. {{number_format($book->price, 2)}}</td>
                <td>Rp. {{number_format($book->selling_price, 2)}}</td>
                <td>{{$book->stock}}</td>
                <td>
                    <img src="{{ asset('storage/cover/' . $book->image) }}" width="80" alt="">
                </td>
                <td>
                    <div class="dropdown">
                        <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-pen"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('updated', $book->isbn) }}">Update</a></li>
                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $book->isbn }}">
                                Delete
                                </button>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            <div class="modal fade" id="exampleModal{{ $book->isbn }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Confirm</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete <b>{{ $book->title }}</b> from your data ?</p>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{ route('destroy', $book->isbn) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-success">Yes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>
@push('scripts')
<script>
    $(document).ready(function () {
        $('#datatables').DataTable();
    });
</script>
@endpush

@endsection

