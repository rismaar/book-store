@extends('layouts.app')
@section('content')

<h3><i class="fa-solid fa-database mr-3" style="color: #8a1480;"></i><b>Request</b></h3>
<div class="container-fluid shadow-lg rounded-3 mt-3">
    <form action="{{ route('storeRest') }}" method="POST" class="p-5">
    @csrf
        <select name="supplier_id" id="supplier" class="form-control" required>
            <option value="">Pilih Supplier</option>
            @foreach($suppliers as $s)
                <option value="{{ $s->siup }}">{{ $s->nama_perusahaan }}</option>
            @endforeach
        </select>
        <hr>
        <div id="produk-wrapper">
            <div class="row mb-2">
                <div class="col-md-4">
                    <select name="produk[]" class="form-control product-select">
                        <option value="">Pilih Produk</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" name="qty[]" class="form-control" placeholder="Qty">
                </div>
                <div class="col-md-3">
                    <input type="number" name="harga[]" class="form-control price-input"
                        min="0" required>
                </div>
            </div>
        </div>
        <button type="button" id="addItem" class="btn btn-success mb-3"><i class="fa-solid fa-circle-plus mr-3"></i><b>Tambah Produk</b></button>
        <button type="submit" class="btn btn-primary mb-3"><b>Request Restock</b></button>
    </form>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            let productCache = new Map(); 
            let isLoading = false;

            function debounce(func, wait) {
                let timeout;
                return function (...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            }

            function populateProducts(products, targetSelect = null) {
                const options = ['<option value="">Pilih Produk</option>'];

                products.forEach(p => {
                    options.push(`<option value="${p.isbn}">${p.title}</option>`);
                });
                const html = options.join('');
                if (targetSelect) {
                    targetSelect.innerHTML = html;
                } else {
                    document
                        .querySelectorAll('.product-select')
                        .forEach(select => select.innerHTML = html);
                }
            }
            const supplierSelect = document.getElementById('supplier');
            if (!supplierSelect) {
                console.error('SELECT supplier TIDAK DITEMUKAN');
                return;
            }
            supplierSelect.addEventListener('change', debounce(function () {
                const supplierId = this.value;
                if (!supplierId) {
                    populateProducts([]);
                    return;
                }
                isLoading = true;
                if (productCache.has(supplierId)) {
                    populateProducts(productCache.get(supplierId));
                    isLoading = false;
                    return;
                }
                fetch(`/api/supplier/${supplierId}/products`)
                    .then(res => res.json())
                    .then(data => {
                        console.log('DATA API:', data); 
                        productCache.set(supplierId, data);
                        populateProducts(data);
                    })
                    .catch(err => console.error(err))
                    .finally(() => isLoading = false);

            }, 300));

            const addItemBtn = document.getElementById('addItem');
            const wrapper = document.getElementById('produk-wrapper');
            if (!addItemBtn) {
                console.error('BUTTON addItem TIDAK DITEMUKAN');
                return;
            }
            addItemBtn.addEventListener('click', function () {
                const row = document.createElement('div');
                row.classList.add('row', 'item-row', 'mb-3', 'mt-2');
                row.innerHTML = `
                    <div class="row">
                        <div class="col-md-4">
                            <select name="produk[]" class="form-control product-select">
                                <option value="">Pilih Produk</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="qty[]" class="form-control" placeholder="Qty">
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="harga[]" class="form-control price-input"
                                min="0" required>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-item"><i class="fa-solid fa-trash"></i></button>
                    </div>
                `;
                wrapper.appendChild(row);

                const newSelect = row.querySelector('.product-select');
                const supplierId = document.getElementById('supplier').value;

                if (supplierId && productCache.has(supplierId)) {
                    populateProducts(productCache.get(supplierId), newSelect);
                } else {
                    newSelect.innerHTML = '<option value="">Pilih Produk</option>';
                }
                document.addEventListener('click', function (e) {
                    if (e.target.classList.contains('remove-item')) {
                        e.target.closest('.item-row').remove();
                    }
                });
            });
        });
        document.addEventListener('change', function (e) {
            if (!e.target.classList.contains('product-select')) return;
            const isbn = e.target.value;
            const row = e.target.closest('.row').parentElement;
            const priceInput = row.querySelector('.price-input');
            if (!isbn) {
                priceInput.value = '';
                return;
            }
            fetch(`/buku/price/${isbn}`)
                .then(res => res.json())
                .then(data => {
                    priceInput.value = data.price;
                })
                .catch(err => {
                    console.error(err);
                    priceInput.value = '';
                });
        });

    </script>

@endpush
@endsection
