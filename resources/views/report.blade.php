<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            font-size: 14px;
        }

        th {
            background: #f2f2f2;
        }

        .total {
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
            font-size: 16px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Salemba Book</h2>
        <p>Sales Report</p>
        <p>Periode: {{ \Carbon\Carbon::parse($start)->translatedFormat('d F Y') ?? '-' }} s/d {{ \Carbon\Carbon::parse($end)->translatedFormat('d F Y') ?? '-' }}</p>
    </div>

    <button onclick="window.print()" class="no-print mb-2">Print</button>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Transaction ID</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @forelse($transact as $t)
                @php $rowCount = $t->details->count(); @endphp
                @foreach($t->details as $detail)
                    <tr>
                        @if($loop->first)
                            <td rowspan="{{ $rowCount }}">{{ $no++ }}</td>
                            <td rowspan="{{ $rowCount }}">
                                {{ \Carbon\Carbon::parse($t->tanggal)->translatedFormat('d F Y') ?? '-' }}
                            </td>
                            <td rowspan="{{ $rowCount }}">{{ $t->id_transaksi ?? '-' }}</td>
                        @endif
                        <td>{{ $detail->buku->title ?? '-' }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>IDR {{ number_format($detail->total,0,',','.') }}</td>
                    </tr>
                @endforeach

            @empty
                <tr>
                    <td colspan="6" style="text-align:center;">Nothing's here</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="total">
        Total Amount: IDR {{ number_format($total,0,',','.') }}
    </div>
    <br><br>
    <div style="text-align:right;">
        <p>Admin,</p>
        <br><br>
        <p>______________________</p>
    </div>
</body>
</html>
