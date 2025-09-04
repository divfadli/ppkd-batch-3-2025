<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pinjam Buku</title>

    <style>
        @page {
            size: 80mm auto;
            margin: 0;
        }

        body {
            font-size: 12px;
            font-family: 'Courier New', Courier, monospace;
            margin: 10px;
            line-height: 1.4;
        }

        .text-center {
            text-align: center;
        }

        .text-bold {
            font-weight: bold;
        }

        .text-highlight {
            font-weight: bold;
            /* background: #f2f2f2; */
            padding: 2px 4px;
            border-radius: 3px;
        }

        .small {
            font-size: 11px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin: 2px 0;
        }

        .divider {
            border-top: 1px dashed #000;
            margin: 8px 0;
        }

        .double-divider {
            border-top: 2px dashed #000;
            margin: 10px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .table th,
        .table td {
            padding: 5px;
            border-bottom: 1px dashed #ccc;
        }

        .table th {
            text-align: left;
            font-weight: bold;
            background: #f8f8f8;
        }

        .table tr:nth-child(even) {
            background: #fdfdfd;
        }

        footer {
            margin-top: 12px;
            text-align: center;
            font-size: 11px;
        }

        footer div {
            margin: 2px 0;
        }

        @media print {
            body {
                font-family: monospace;
                font-size: 12px;
                width: 80mm;
                margin: 0;
                padding: 8px;
                background-color: rgb(255, 188, 3)
            }
        }
    </style>
</head>

<body onload="window.print(); setTimeout(()=>window.close(),500);">
    <h3 class="text-center">📚 Perpustakaan PPKD Jakpus</h3>
    <div class="text-center small">Jl. Karet Baru Benhill, Jakarta Pusat</div>

    <div class="double-divider"></div>

    <div class="small">
        <div class="row">
            <span>Kode Transaksi</span>
            <span class="text-highlight">{{ $borrow->trans_number ?? '' }}</span>
        </div>
        <div class="row">
            <span>Tanggal Pinjam</span>
            <span class="text-bold">{{ \Carbon\Carbon::parse($borrow->created_at)->format('d/m/Y') }}</span>
        </div>
        <div class="row">
            <span>Tanggal Pengembalian</span>
            <span class="text-bold">{{ \Carbon\Carbon::parse($borrow->return_date)->format('d/m/Y') }}</span>
        </div>
        <div class="row">
            <span>Nama Peminjam</span>
            <span class="text-highlight">{{ $borrow->member->nama_anggota ?? '' }}</span>
        </div>
    </div>

    <div class="divider"></div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penerbit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($borrow->detailBorrows as $key => $val)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $val->book->title }}</td>
                    <td>{{ $val->book->publisher }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="double-divider"></div>

    <footer>
        <div class="text-center"> &#128591;&#127999; Terima kasih telah meminjam buku</div>
        <div class="text-center">Tunjukkan struk ini saat mengembalikan</div>
        <div class="text-center"><em>Silakan kembalikan tepat waktu</em></div>
        <div class="small text-center">
            Dicetak: {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('d/m/Y H:i') }} WIB
        </div>
    </footer>
</body>

</html>
