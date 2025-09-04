@extends('app')
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $thirdtitle ?? '' }}</h3>
            <div align='right' class="mb-3">
                <a href="{{ route('transaction.index') }}" class="btn btn-secondary">Kembali</a>
            </div>

            <form action="{{ route('transaction.store') }}" method="post">
                @csrf
                <div class="row">
                    {{-- Kolom Transaksi Kiri --}}
                    <div class="col-sm-6">
                        {{-- No Transaksi --}}
                        <div class="mb-3 row">
                            <div class="col-sm-3">
                                <label for="" class="form-label">No Transaksi</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="trans_number" id=""
                                    value="{{ $trans_number }}" @error('trans_number') is-invalid @enderror readonly>
                            </div>
                            <div class="col-sm-12">
                                @error('trans_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- Anggota --}}
                        <div class="mb-3 row">
                            <div class="col-sm-3">
                                <label for="" class="form-label">Anggota</label>
                            </div>
                            <div class="col-sm-7">
                                <select name="anggota_id" id="anggota_id" class="form-select"
                                    @error('anggota_id') is-invalid @enderror>
                                    <option value="">Pilih Anggota</option>
                                    @foreach ($members as $member)
                                        <option value="{{ $member->id }}"
                                            {{ old('anggota_id') == $member->id ? 'selected' : '' }}>
                                            {{ $member->nama_anggota }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12">
                                @error('anggota_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- Kategori Buku --}}
                        <div class="mb-3 row">
                            <div class="col-sm-3">
                                <label for="" class="form-label">Kategori Buku</label>
                            </div>
                            <div class="col-sm-7">
                                <select name="category_id" id="category_id" class="form-select"
                                    @error('category_id') is-invalid @enderror>
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name_category }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12">
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- Buku --}}
                        <div class="mb-3 row">
                            <div class="col-sm-3">
                                <label for="" class="form-label">Buku</label>
                            </div>
                            <div class="col-sm-7">
                                <select name="books_id" id="books_id" class="form-select"
                                    @error('books_id') is-invalid @enderror>
                                    <option value="">Pilih Buku</option>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                @error('books_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Kolom Transaksi Kanan --}}
                    <div class="col-sm-6">
                        {{-- Tgl Pengembalian --}}
                        <div class="mb-3 row">
                            <div class="col-sm-3">
                                <label for="" class="form-label">Tanggal Pengembalian</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="date" class="form-control" name="return_date" id=""
                                    @error('return_date') is-invalid @enderror>
                            </div>
                            <div class="col-sm-12">
                                @error('return_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- Note --}}
                        <div class="mb-3 row">
                            <div class="col-sm-3">
                                <label for="" class="form-label">Catatan</label>
                            </div>
                            <div class="col-sm-7">
                                <textarea name="note" id="" cols="30" rows="10" class="form-control"
                                    @error('note') is-invalid @enderror></textarea>
                            </div>
                            <div class="col-sm-12">
                                @error('note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Kolom Table Keranjang Buku --}}
                    <div class="col-sm-12 mt-5">
                        <div align="right" class="mb-3">
                            <button type="button" id="addRow" class="btn btn-primary">Tambah Row</button>
                        </div>

                        <table class="table table-bordered" id="tableTrans">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <button class="mt-3 btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let category = document.getElementById('category_id');

        category.addEventListener('change', async function() {
            const id_category = this.value;
            const selectBuku = document.querySelector('#books_id');
            selectBuku.innerHTML = "<option value=''>Pilih Buku...</option>";

            if (!id_category) {
                return;
            }

            try {
                const res = await fetch(`/get-books/${id_category}`);
                if (!res.ok) {
                    throw new Error("Gagal mengambil data buku");
                }
                const data = await res.json();

                data.data.forEach(buku => {
                    const option = document.createElement('option');
                    option.value = buku.id;
                    option.textContent = buku.title;
                    selectBuku.appendChild(option);
                });
            } catch (error) {
                console.error("Error:", error);
            }
        });

        let count = 0;

        // Cara Pertama
        // document.querySelector('#addRow').addEventListener('click', function() {
        //     const selectBook = document.querySelector('#books_id');

        //     const bookName = selectBook.options[selectBook.selectedIndex]?.text || '';

        //     if (!selectBook.value) {
        //         alert('Silahkan pilih buku terlebih dahulu!');
        //         return
        //     }

        //     const tbody = document.querySelector('#tableTrans tbody');
        //     const tr = document.createElement('tr');

        //     count++;
        //     const tdNo = document.createElement('td');
        //     tdNo.textContent = count;
        //     tr.appendChild(tdNo);

        //     const tdNama = document.createElement('td');
        //     tdNama.textContent = bookName;
        //     tr.appendChild(tdNama);


        //     const tdAction = document.createElement('td');
        //     // tdAction.innerHTML = `<button class="btn btn-danger">Delete</button>`;
        //     tdAction.classList.add('text-center')
        //     const delBtn = document.createElement('button');
        //     delBtn.textContent = "Delete";
        //     // delBtn.classList.add('btn', 'btn-danger');
        //     delBtn.setAttribute("class", "btn btn-danger");
        //     tdAction.appendChild(delBtn);
        //     tr.appendChild(tdAction);

        //     tbody.appendChild(tr);
        // });

        // Cara Kedua
        document.getElementById('addRow').addEventListener('click', function() {
            const tbody = document.querySelector('#tableTrans tbody');
            const selectBook = document.getElementById('books_id');
            const idBook = selectBook.value;
            const nameBook = selectBook.options[selectBook.selectedIndex]?.text || '';

            if (!idBook) {
                alert('Pilih buku terlebih dahulu!!');
                return;
            }

            // const no = count += 1;
            const no = tbody.querySelectorAll('tr').length + 1;
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${no}</td>
                <td>${nameBook} <input type='hidden' name='books_id[]' value=${idBook}></td>
                <td><button type='button' class="btn btn-sm btn-danger delete-row"> Delete </button></td>
            `
            tbody.appendChild(tr);
            updateRowNumbers();
        });

        document.querySelector('#tableTrans tbody').addEventListener('click', function(e) {
            if (e.target.classList.contains('delete-row')) {
                e.target.closest('tr').remove();
                updateRowNumbers();
            }
        });

        function updateRowNumbers() {
            const rows = document.querySelectorAll('#tableTrans tbody tr');
            rows.forEach((row, index) => {
                row.querySelector('td:first-child').textContent = index + 1;
            });
        }
    </script>
@endsection
