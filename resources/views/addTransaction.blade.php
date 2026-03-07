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
    <h3 style="align: center;" class="mb-3 ml-3 fw-bold" ><i class="fa-solid fa-cash-register me-2" style="color: #3B38A0"></i>New Transaction</h3>
    <form action="{{ route('TransactStore') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label><b>Date</b></label>
            <input type="date" name="tanggal" class="form-control p-3" required>
        </div>
        <div id="items-wrapper">
            <div class="row item-row mb-2">
                <div class="col-md-6">
                    <input type="text" name="items[0][nama_produk]" class="form-control p-3" placeholder="ISBN" required>
                </div>
                <div class="col-md-3">
                    <input type="number" name="items[0][jumlah]" class="form-control p-3" placeholder="Qty" min="1" required>
                </div>
            </div>
        </div>
        <button type="button" id="addItem" class="btn btn-success mb-3"><i class="fa-solid fa-circle-plus me-2"></i><b>Add Product</b></button>
        <div class="mb-3">
            <label><b>Payment Method</b></label>
            <select name="metode_pembayaran" class="form-select p-3" required>
                <option value="">Choose Payment Method</option>
                <option value="Cash">Cash</option>
                <option value="QRIS">QRIS</option>
            </select>
        </div>
        <button type="submit" class="btn" style="background-color: #3B38A0; color: white;"><b>Save</b></button>
    </form>
</div>
<script>
let index = 1;

document.getElementById('addItem').addEventListener('click', function () {
    const wrapper = document.getElementById('items-wrapper');

    const row = document.createElement('div');
    row.classList.add('row', 'item-row', 'mb-2');

    row.innerHTML = `
        <div class="col-md-6">
            <input type="text" name="items[${index}][nama_produk]" class="form-control p-3" placeholder="ISBN" required>
        </div>
        <div class="col-md-3">
            <input type="number" name="items[${index}][jumlah]" class="form-control p-3" placeholder="Qty" min="1" required>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-danger remove-item"><i class="fa-solid fa-trash-arrow-up"></i></button>
        </div>
    `;

    wrapper.appendChild(row);
    index++;
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-item')) {
        e.target.closest('.item-row').remove();
    }
});
</script>


@endsection