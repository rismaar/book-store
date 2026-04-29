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
        padding: 8em;
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
    <h1 style="font-family:; font-size: 80px; font-weight:900; "
        class="title-text-center d-flex justify-content-center mt-5">TOP CATEGORIES
    </h1>
    <div class="container-fluid px-0 py-5 w-100">
        <div class="row g-4">
            <div class="col-12 col-lg-3">
                <div class="card h-100">
                    <img src="{{ asset('img/history.jpg') }}" class="card-img-top object-fit-cover"  style="height: 400px;" alt="...">
                    <div class="card-body d-flex justify-content-between">
                        <h2><b>History</b></h2>
                        <a href="{{ route('sejarah') }}" class="btn text-white rounded-pill fw-bold ms-auto" style="background-color: #3b38a0"><i class="fa-solid fa-angle-right fa-xl"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 ">
                <div class="card" >
                    <img src="{{ asset('img/mistery.jpeg') }}" class="card-img-top object-fit-cover" style="height: 400px;" alt="...">
                    <div class="card-body d-flex justify-content-between">
                        <h2><b>Mistery</b></h2>
                        <a href="{{ route('mistery') }}" class="btn text-white rounded-pill fw-bold ms-auto" style="background-color: #3b38a0"><i class="fa-solid fa-angle-right fa-xl"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 ">
                <div class="card h-100" >
                    <img src="{{ asset('img/fantasi.jpg') }}" class="card-img-top object-fit-cover" style="height: 400px;" alt="...">
                    <div class="card-body d-flex justify-content-between">
                        <h2><b>Fiction Fantasy</b></h2>
                        <a href="{{ route('fiksi') }}" class="btn text-white rounded-pill fw-bold ms-auto" style="background-color: #3b38a0"><i class="fa-solid fa-angle-right fa-xl"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card h-100" >
                    <img src="{{ asset('img/novel_cover.jpeg') }}" class="card-img-top object-fit-cover" style="height: 400px;" alt="...">
                    <div class="card-body d-flex justify-content-between">
                        <h2><b>Novel</b></h2>
                        <a href="{{ route('novels') }}" class="btn text-white rounded-pill fw-bold ms-auto" style="background-color: #3b38a0"><i class="fa-solid fa-angle-right fa-xl"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid rounded-5 p-5" style="background-color: #3b38a0">
        <p class="text-white">Our Books Recomendation</p>
        <div class="d-flex flex-wrap justify-content-center gap-5 py-5">
            <div class="text-center">
                <button class="btn" type="button" data-bs-toggle="popover" data-bs-title="Price" data-bs-content="IDR. 69.000">
                    <div class="bg-warning-subtle p-5 arc-frame" style="border-radius: 100px 100px 12px 12px;">
                        <img src="{{ asset('img/animal_farm.jpg') }}" style="height: 13rem; width: 10rem; " alt="" srcset="">
                    </div>
                </button>
                <font color="white">
                    <div class="mt-3">
                        <h5 class="mb-1">Animal Farm</h5>
                        <p>George Orwell</p>
                    </div>
                </font>
            </div>
            <div class="text-center">
                <button class="btn" type="button" data-bs-toggle="popover" data-bs-title="Price" data-bs-content="IDR. 150.000">
                    <div class="bg-warning-subtle p-5 arc-frame" style="border-radius: 100px 100px 12px 12px;">
                        <img src="{{ asset('img/catatan_pulau_buru.jpg') }}" style="height: 13rem; width: 10rem; " alt="" srcset="">
                    </div>
                </button>
                <font color="white">
                    <div class="mt-3">
                        <h5 class="mb-1">Perawan Remaja dalam</h5>
                            <h5>Cengkraman Militer</h5>
                        <p>Pramoedya Ananta Toer</p>
                    </div>
                </font>
            </div>
            <div class="text-center ">
                <button class="btn" type="button" data-bs-toggle="popover" data-bs-title="Price" data-bs-content="IDR. 135.000">
                    <div class="bg-warning-subtle p-5 arc-frame" style="border-radius: 100px 100px 12px 12px;">
                        <img src="{{ asset('img/laut_bercerita.jpg') }}" style="height: 13rem; width: 10rem; " alt="" srcset="">
                    </div>
                </button>
                <font color="white">
                    <div class="mt-3">
                        <h5 class="mb-1">Laut Bercerita</h5>
                        <p>Leila S. Chudori</p>
                    </div>
                </font>
            </div>
            <div class="text-center ">
                <button class="btn" type="button" data-bs-toggle="popover" data-bs-title="Price" data-bs-content="IDR. 120.000">
                    <div class="bg-warning-subtle p-5 arc-frame" style="border-radius: 100px 100px 12px 12px;">
                        <img src="{{ asset('img/ronggeng_dukuh.jpg') }}" style="height: 13rem; width: 10rem; " alt="" srcset="">
                    </div>
                </button>
                <font color="white">
                    <div class="mt-3">
                        <h5 class="mb-1">Ronggeng Dukuh</h5>
                        <p>Ahmad Tohari</p>
                    </div>
                </font>
            </div>
            <div class="text-center ">
                <button class="btn" type="button" data-bs-toggle="popover" data-bs-title="Price" data-bs-content="IDR. 300.000">
                    <div class="bg-warning-subtle p-5 arc-frame" style="border-radius: 100px 100px 12px 12px;">
                        <img src="{{ asset('img/madilog.jpg') }}" style="height: 13rem; width: 10rem; " alt="" srcset="">
                    </div>
                </button>
                <font color="white">
                    <div class="mt-3">
                        <h5 class="mb-1">Madilog</h5>
                        <p>Tan Malaka</p>
                    </div>
                </font>
            </div>
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
                        <th class="bg-warning text-light">Transaction Id</th>
                        <th class="bg-warning text-light">Date</th>
                        <th class="bg-warning text-light">Payment Method</th>
                        <th class="bg-warning text-light">Quantity</th>
                        <th class="bg-warning text-light">Amount</th>
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
                            <td class="p-3">IDR. {{ number_format($t->grand_total, 2) }}</td>
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
                            <div class="modal-header bg-warning text-white fw-bold">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ $t->id_transaksi }}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body invoice-content">
                                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($t->tanggal)->translatedFormat('d F Y') }}</p>
                                <table class="table table-stripped">
                                    <thead>
                                        <tr>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($t->details as $d)
                                        <tr>
                                        <td>{{ $d->buku->title ?? $d->nama_produk }}</td>
                                        <td>{{ $d->jumlah }}</td>
                                        <td>IDR. {{ number_format($d->price,2) }}</td>
                                        <td>IDR. {{ number_format($d->total,2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <p><strong>Amount:</strong> IDR.  {{ number_format($t->grand_total,2) }}</p>
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
                    <a href="{{ route('view.supp') }}" class="text-decoration-none flex-fill ">
                        <div class="card text-white h-100 p-3 bg-warning" style=" border: none;">
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
                        <th class="bg-warning text-light">Transaction Id</th>
                        <th class="bg-warning text-light">Date</th>
                        <th class="bg-warning text-light">Payment Method</th>
                        <th class="bg-warning text-light">Qty</th>
                        <th class="bg-warning text-light">Amount</th>
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
                            <td class="p-3">IDR. {{ number_format($t->grand_total, 2) }}</td>
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
                <div class="modal fade border-0" id="staticBackdrop{{ $t->id_transaksi }}" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-warning text-white">
                                <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">{{ $t->id_transaksi }}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body invoice-content">
                                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($t->tanggal)->translatedFormat('d F Y') }}</p>
                                <table class="table table-stripped">
                                    <thead>
                                        <tr>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($t->details as $d)
                                        <tr>
                                        <td>{{ $d->buku->title ?? $d->nama_produk }}</td>
                                        <td>{{ $d->jumlah }}</td>
                                        <td>IDR. {{ number_format($d->price,2) }}</td>
                                        <td>IDR. {{ number_format($d->total,2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <p><strong>Amount:</strong>IDR. {{ number_format($t->grand_total,2) }}</p>
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
            const ct = chart.ctx;

            ct.restore();
            ct.font = 'bold 40px Arial';
            ct.textAlign = 'center';
            ct.textBaseline = 'middle';
            ct.fillStyle = '#FF0000';

            ct.fillText(
                {{ $totalProduk }},
                width / 2,
                height / 3
            );
            ct.save();
        }
    };

    new Chart(document.getElementById('produkChart'), {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: colors,
                borderWidth: 3
            }]
        },
        options: {
            cutout: '70%',
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