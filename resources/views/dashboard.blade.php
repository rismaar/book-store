@extends('layouts.app')

@section('content')
<style>
    #invoice-detail {
    font-family: Arial, sans-serif;
    font-size: 14px;
    }
    #invoice-detail table {
        width: 100%;
        border-collapse: collapse;
    }
    #invoice-detail th, #invoice-detail td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    #invoice-detail th {
        background-color: #f2f2f2;
        text-align: left;
    }

</style>

    @guest

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <h1 style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-size: 50px; font-weight:900; "
            class="title-text-center d-flex justify-content-center">Our Best Categories!</h1>
        <div class="d-flex justify-content-center my-3">
            <div id="carouselExampleCaptions" class="carousel slide w-75" style="width: 600px;">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"
                        aria-label="Slide 4"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4"
                        aria-label="Slide 5"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active w-90">
                        <a href="{{ route('animate') }}">
                            <img src="../img/animfict.jpg" class="d-block w-100" style="object-fit: cover;" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h1><b>Animasi Fiksi</b></h1>
                            </div>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="{{ route('sejarah') }}">
                            <img src="../img/history.jpg" class="d-block w-100" style="object-fit: cover;" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h1><b>Sejarah</b></h1>
                            </div>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="{{ route('fiksi') }}">
                            <img src="../img/fantasi.jpg" class="d-block w-100" alt="..." style="object-fit: cover;">
                            <div class="carousel-caption d-none d-md-block">
                                <h1><b>Fiksi Fantasi</b></h1>
                            </div>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="{{ route('mistery') }}">
                            <img src="../img/mistery.jpg" class="d-block w-100" alt="..." style="object-fit: cover;">
                            <div class="carousel-caption d-none d-md-block">
                                <h1><b>Misteri</b></h1>
                            </div>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="{{ route('novels') }}">
                            <img src="../img/novel_cover.jpeg" class="d-block w-100" alt="..." style="object-fit: cover;">
                            <div class="carousel-caption d-none d-md-block">
                                <h1><b>Novel</b></h1>
                            </div>
                        </a>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    @endguest

@auth
    @if (auth()->user()->role === 'kasir')
        <p><b>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</b></p>
        <div class="card mt-2" style="border: none; background-color: #3B38A0; font-weight: 700;">
            <div class="card-body d-flex justify-content-between">
                <figure>
                <blockquote class="blockquote text-white">
                    <h1>Welcome, {{ auth()->user()->name }} !</h1>
                </blockquote>
                <figcaption class="blockquote-footer">
                    {{ auth()->user()->role }}
                </figcaption>
                </figure>
                <div class="d-flex justify-content-end">
                    <img src="{{ asset('img/vect.png') }}" style="height: 200px;">
                </div>
            </div>
        </div>

        <div class="container-fluid bg-light shadow-lg p-3 mt-5">
            <p class="text-secondary">Recent Transactions</p>
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th class="bg-warning text-light">No</th>
                        <th class="bg-warning text-light">ID Transaksi</th>
                        <th class="bg-warning text-light">Tanggal</th>
                        <th class="bg-warning text-light">Metode Pembayaran</th>
                        <th class="bg-warning text-light">Qty</th>
                        <th class="bg-warning text-light">Total</th>
                        <th class="bg-warning text-light">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentTransaction as $t)
                        <tr>
                            <td class="p-3">{{ $loop->iteration }}</td>
                            <td class="p-3">{{ $t->id_transaksi }}</td>
                            <td class="p-3">{{ \Carbon\Carbon::parse($t->tanggal)->translatedFormat('d F Y') }}</td>
                            <td class="p-3">{{ $t->metode_pembayaran }}</td>
                            <td class="p-3">{{ $t->details->sum('jumlah') }}</td>
                            <td class="p-3">Rp. {{ number_format($t->grand_total, 2) }}</td>
                            <td class="p-3">
                                <button type="button" 
                                    class="btn btn-link p-0 border-0 shadow-none"
                                    data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop{{ $t->id_transaksi }}">
                                    <i class="fa-solid fa-circle-info 2x" style="color: #20365a;"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @foreach ($transaksi as $t)
                <div class="modal fade" id="staticBackdrop{{ $t->id_transaksi }}" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ $t->id_transaksi }}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body invoice-content">
                                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($t->tanggal)->translatedFormat('d F Y') }}</p>
                                <table class="table table-stripped">
                                    <thead>
                                        <tr>
                                        <th>Produk</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($t->details as $d)
                                        <tr>
                                        <td>{{ $d->buku->title ?? $d->nama_produk }}</td>
                                        <td>{{ $d->jumlah }}</td>
                                        <td>{{ number_format($d->price,2) }}</td>
                                        <td>{{ number_format($d->total,2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <p><strong>Total:</strong> {{ number_format($t->grand_total,2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endauth
@auth
    @if (auth()->user()->role === 'admin')
    <p><b>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</b></p>
        <div class="card mt-2" style="border: none; background-color: #3B38A0; font-weight: 700;">
            <div class="card-body d-flex justify-content-between">
                <figure>
                <blockquote class="blockquote text-white">
                    <h1>Welcome, {{ auth()->user()->name }} !</h1>
                </blockquote>
                <figcaption class="blockquote-footer">
                    {{ auth()->user()->role }}
                </figcaption>
                </figure>
                <div class="d-flex justify-content-end">
                    <img src="{{ asset('img/vect.png') }}" style="height: 200px;">
                </div>
            </div>
        </div>

        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col">
                    <a href="{{ route('products') }}" class="text-decoration-none">
                        <div class="card bg-light shadow" style="border: none;">
                            <div class="card-body d-flex justify-content-center " style="height: 300px;">
                                <canvas id="produkChart"></canvas>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col d-flex flex-column" style="height: 300px;">
                    <a class="text-decoration-none flex-fill mb-3" href="{{ route('menu') }}">
                        <div class="card text-light h-100 p-3" style="background-color: #3B38A0; border: none;">
                            <div class="card-body d-flex align-items-center">
                                <h3 class="card-title"><b>Restock</b></h3>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('view.supp') }}" class="text-decoration-none flex-fill">
                        <div class="card text-white h-100 p-3" style="background-color: #FF7F3E; border: none;">
                            <div class="card-body d-flex align-items-center">
                                <h3 class="card-title"><b>Supplier</b></h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        
        

        <div class="container-fluid bg-light shadow-lg p-3 mt-5">
            <p class="text-secondary">Recent Transactions</p>
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th class="bg-warning text-light">No</th>
                        <th class="bg-warning text-light">ID Transaksi</th>
                        <th class="bg-warning text-light">Tanggal</th>
                        <th class="bg-warning text-light">Metode Pembayaran</th>
                        <th class="bg-warning text-light">Qty</th>
                        <th class="bg-warning text-light">Total</th>
                        <th class="bg-warning text-light">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentTransaction as $t)
                        <tr>
                            <td class="p-3">{{ $loop->iteration }}</td>
                            <td class="p-3">{{ $t->id_transaksi }}</td>
                            <td class="p-3">{{ \Carbon\Carbon::parse($t->tanggal)->translatedFormat('d F Y') }}</td>
                            <td class="p-3">{{ $t->metode_pembayaran }}</td>
                            <td class="p-3">{{ $t->details->sum('jumlah') }}</td>
                            <td class="p-3">Rp. {{ number_format($t->grand_total, 2) }}</td>
                            <td class="p-3">
                                <button type="button" 
                                    class="btn btn-link p-0 border-0 shadow-none"
                                    data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop{{ $t->id_transaksi }}">
                                    <i class="fa-solid fa-circle-info 2x" style="color: #20365a;"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @foreach ($transaksi as $t)
                <div class="modal fade" id="staticBackdrop{{ $t->id_transaksi }}" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ $t->id_transaksi }}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body invoice-content">
                                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($t->tanggal)->translatedFormat('d F Y') }}</p>
                                <table class="table table-stripped">
                                    <thead>
                                        <tr>
                                        <th>Produk</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($t->details as $d)
                                        <tr>
                                        <td>{{ $d->buku->title ?? $d->nama_produk }}</td>
                                        <td>{{ $d->jumlah }}</td>
                                        <td>Rp. {{ number_format($d->price,2) }}</td>
                                        <td>Rp. {{ number_format($d->total,2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <p><strong>Total:</strong>Rp. {{ number_format($t->grand_total,2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endauth
    
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dataKategori = @json($kategoriData);
    const labels = dataKategori.map(item => item.kategori);
    const data = dataKategori.map(item => item.total);
    const colors = [
        '#FF7F3E', '#DC0E0E',
        '#2196F3', '#9C27B0', '#00BCD4', '#E4FF30'
    ];

    const centerText = {
        id: 'centerText',
        beforeDraw(chart) {
            const { width } = chart;
            const { height } = chart;
            const ctx = chart.ctx;

            ctx.restore();
            ctx.font = 'bold 28px Arial';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillStyle = '#FF0000';

            ctx.fillText(
                {{ $totalProduk }},
                width / 2,
                height / 3
            );
            ctx.save();
        }
    };

    new Chart(document.getElementById('produkChart'), {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: colors,
                borderWidth: 0
            }]
        },
        options: {
            cutout: '75%',
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        },
        plugins: [centerText]
    });
</script>
@endsection
