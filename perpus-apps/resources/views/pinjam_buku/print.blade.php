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
            margin: 0;
            line-height: 1.4;
            background: #f7f7f7;
            /* preview layar lebih enak */
        }

        .receipt {
            /* max-width: 80mm; */
            /* margin: 10px auto; */
            padding: 12px;
            /* background: #fff; */
            /* border-radius: 6px; */
            /* box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1); */
        }

        .text-center {
            text-align: center;
        }

        .text-bold {
            font-weight: bold;
        }

        .small {
            font-size: 11px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin: 3px 0;
        }

        .divider {
            border-top: 1px dashed #000;
            margin: 8px 0;
        }

        .double-divider {
            border-top: 2px dashed #000;
            margin: 12px 0;
        }

        /* Table */
        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .table th,
        .table td {
            padding: 4px 5px;
            border-bottom: 1px dashed #ccc;
        }

        .table th {
            text-align: left;
            font-weight: bold;
            background: #ececec;
        }

        .table tr:nth-child(even) {
            background: #f9f9f9;
        }

        footer {
            margin-top: 12px;
            text-align: center;
            font-size: 11px;
        }

        footer div {
            margin: 2px 0;
        }

        footer em {
            font-style: italic;
            color: #444;
        }

        /* Mode Print */
        @media print {
            body {
                background: none;
                margin: 0;
                padding: 0;
                width: 80mm;
            }

            .receipt {
                /* kuning soft */
                background-color: #fff8d6;
                box-shadow: none;
                margin: 0 auto;
                padding: 10px;
                border-radius: 0;
            }

            .table th {
                background: #f0f0f0 !important;
            }
        }
    </style>
</head>

<body onload="window.print(); setTimeout(()=>window.close(),500);">
    <div class="receipt">
        <h3 class="text-center">📚 Perpustakaan PPKD Jakpus</h3>
        <div class="text-center small">Jl. Karet Baru Benhill, Jakarta Pusat</div>

        <div class="double-divider"></div>

        <div class="small">
            <div class="row">
                <span>Kode Transaksi</span>
                <span class="text-bold">{{ $borrow->trans_number ?? '' }}</span>
            </div>
            <div class="row">
                <span>Tanggal Pinjam</span>
                <span class="text-bold">{{ \Carbon\Carbon::parse($borrow->created_at ?? '')->format('d/m/Y') }}</span>
            </div>
            <div class="row">
                <span>Tanggal Pengembalian</span>
                <span class="text-bold">{{ \Carbon\Carbon::parse($borrow->return_date ?? '')->format('d/m/Y') }}</span>
            </div>
            <div class="row">
                <span>Nama Peminjam</span>
                <span class="text-bold">{{ $borrow->member->nama_anggota ?? '' }}</span>
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
                @forelse ($borrow->detailBorrows ?? [] as $key => $val)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $val->book->title ?? '-' }}</td>
                        <td>{{ $val->book->publisher ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada buku dipinjam</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="double-divider"></div>

        <footer>
            <div>🙏 <b>Terima kasih</b> telah meminjam buku</div>
            <div>Tunjukkan struk ini saat mengembalikan</div>
            <div><em>Silakan kembalikan tepat waktu</em></div>
            <div class="small">
                Dicetak: {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('d/m/Y H:i') }} WIB
            </div>
        </footer>
    </div>
</body>

</html>
