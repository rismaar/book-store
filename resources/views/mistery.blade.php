@extends('layouts.app')
@section('content')

<h1 class="text-center mb-3">Misteri</h1>
<div class="d-flex flex-wrap gap-3 justify-content-center">
    @foreach ($books as $book)
        <div class="mr-3">
            <div class="card shadow-lg" style="width: 17rem; border: none;">
                <img src="{{ asset('storage/cover/' . $book->image) }}" 
                     class="card-img-top" 
                     style="object-fit: cover; height: 400px;">
                <div class="card-body">
                    <h5 class="card-title text-truncate">{{ $book->title }}</h5>
                    <p class="card-text">Rp {{ number_format($book->selling_price, 0, ',', '.') }}</p>
                    <a href="#" 
                       class="btn d-flex justify-content-center fw-bold bg-info-subtle" style="background-color: #f8f8f875"
                       data-bs-toggle="modal" 
                       data-bs-target="#detailModal{{ $book->isbn }}">See Detail</a>
                </div>
            </div>
        </div>

        <div class="modal fade" id="detailModal{{ $book->isbn }}" 
             data-bs-backdrop="static" data-bs-keyboard="false" 
             tabindex="-1" aria-labelledby="detailModalLabel{{ $book->isbn }}" 
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="detailModalLabel{{ $book->isbn }}">
                            {{ $book->title }}
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex">
                            <div class="me-3">
                                <img src="{{ asset('storage/cover/' . $book->image) }}" 
                                class="img-fluid" style="max-height: 300px; object-fit: cover;">
                            </div>
                            <div>
                                <h3>{{ $book->title }}</h3>
                                <h4 class="fw-bold">Rp {{ number_format($book->selling_price, 0, ',', '.') }}</h4>
                                <p>Author by {{ $book->author }}</p>
                                <p><b>Format: </b>Soft Cover ver</p>
                                <p>Publisher: {{ $book->supplier->nama_perusahaan }}</p>
                                <p>Stock: {{ $book->stock }}</p>    
                            </div>
                        </div>
                        <h5 class="mt-2">Description:</h5>
                        <p class="mt-3">{{ $book->description ?? '-' }}</p>
                        <h5>Book Details: </h5>
                        <p class="mt-2">ISBN: {{ $book->isbn ?? '-' }}</p>
                        <p>Pages: {{ $book->pages ?? '-'}} </p>
                        <p>Publication Date: {{ \Carbon\Carbon::parse($book->publish_date)->translatedFormat('d F Y') ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
