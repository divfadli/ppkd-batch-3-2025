@extends('app')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <!-- Total Buku Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Total Buku <span>| Semua</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-book"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $totalBooks ?? 0 }}</h6>
                                        <span class="text-success small pt-1 fw-bold">{{ $totalStock ?? 0 }}</span>
                                        <span class="text-muted small pt-2 ps-1">Stock</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Total Buku Card -->

                    <!-- Total Pinjam Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Buku yang sedang dipinjam</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-book"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $borrowedBooks ?? 0 }}</h6>
                                        <span class="text-success small pt-1 fw-bold"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Total Pinjam Card -->

                    <!-- Total Orang Sudah Mengembalikan Buku Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Sudah dikembalikan</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $returnedBooks ?? 0 }}</h6>
                                        <span class="text-success small pt-1 fw-bold"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Total Orang Sudah Mengembalikan Buku Card -->

                    <!-- Total Orang Belum Mengembalikan Buku Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Belum dikembalikan</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $notReturnedBooks ?? 0 }}</h6>
                                        <span class="text-success small pt-1 fw-bold"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Total Orang Belum Mengembalikan Buku Card -->
                </div>

                <div class="mt-3">
                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th>No Transaksi</th>
                                <th>Nama Anggota</th>
                                <th class="text-end">Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($fines as $val)
                                <tr>
                                    <td>{{ $val->trans_number }}</td>
                                    <td>{{ $val->member->nama_anggota ?? '-' }}</td>
                                    <td class="text-end text-danger fw-semibold">Rp.
                                        {{ number_format($val->fine, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted fst-italic">Tidak ada data denda</td>
                                </tr>
                            @endforelse
                            <tr class="fw-bold table-secondary">
                                <td colspan="2" class="text-end">Total Denda</td>
                                <td class="text-end">Rp. {{ number_format($totalFines ?? 0, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </section>
@endsection
