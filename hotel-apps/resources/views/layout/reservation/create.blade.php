@extends('app')
@section('title', $title)
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ $title ?? '' }}</h3>
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-lg-6">
                            <!-- Guest Name -->
                            <div class="mb-3">
                                <label for="" class="form-label">Nama Tamu *</label>
                                <input type="text" class="form-control" name="guest_name"
                                    placeholder="Masukkan Nama Tamu" required>
                            </div>

                            <!-- Guest Phone -->
                            <div class="mb-3">
                                <label for="" class="form-label">Telpon/HP</label>
                                <input type="number" class="form-control" name="guest_phone"
                                    placeholder="Masukkan Nomor Telpon/HP">
                            </div>

                            <!-- Category Room -->
                            <div class="mb-3">
                                <label for="" class="form-label">Kategori Kamar *</label>
                                <select name="category_id" id="category_id" class="form-select">
                                    <option value="">Pilih Kategori Kamar</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Nomor Kamar -->
                            <div class="mb-3">
                                <label for="" class="form-label">Nomor Kamar *</label>
                                <select name="guest_room_number" id="" class="form-select">
                                    <option value="">Pilih Nomor Kamar</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Check In Kamar -->
                            <div class="mb-3">
                                <label for="" class="form-label">Check In *</label>
                                <input type="date" name="guest_check_in" id="checkin" class="form-control">
                            </div>

                            <!-- Payment -->
                            <div class="mb-3">
                                <label for="" class="form-label">Metode Pembayaran *</label>
                                <select name="payment_method" id="" class="form-select">
                                    <option value="cc">Credit Card</option>
                                    <option value="cash">Cash</option>
                                    <option value="bank">Bank Transfer</option>
                                </select>
                            </div>


                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-lg-6">
                            <!-- Guest Email -->
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="email" class="form-control" name="guest_email"
                                    placeholder="Masukkan Email">
                            </div>

                            <!-- Number of Guest -->
                            <div class="mb-3">
                                <label for="" class="form-label">Jumlah Tamu *</label>
                                <select name="guest_qty" id="" class="form-select" required>
                                    <option value="1">1 Tamu</option>
                                    <option value="2">2 Tamu</option>
                                    <option value="3">3 Tamu</option>
                                    <option value="4">4 Tamu</option>
                                </select>
                            </div>

                            <!-- Name Rooms -->
                            <div class="mb-3">
                                <label for="" class="form-label">Nama Kamar *</label>
                                <select name="room_id" id="room_id" class="form-select">
                                    <option value="">Pilih Kamar</option>

                                </select>
                            </div>

                            <!-- Special Request / Note -->
                            <div class="mb-3">
                                <label for="" class="form-label">Special Request / Note</label>
                                <textarea name="guest_note" id="" class="form-control"></textarea>
                            </div>

                            <!-- Check Out Kamar -->
                            <div class="mb-3">
                                <label for="" class="form-label">Check Out *</label>
                                <input type="date" name="guest_check_out" id="checkout" class="form-control">
                            </div>

                            <!-- Summary Payment  -->
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">Summary Payment</h6>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Harga Kamar (Per malam)</span>
                                        <span id="roomRate">Rp.0</span>
                                        <input type="hidden" name="roomRate" id="roomRateVal">
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Berapa Malam</span>
                                        <span id="totalNight">0</span>
                                        <input type="hidden" name="totalNight" id="totalNightVal">
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Subtotal</span>
                                        <span id="sub_total">Rp.0</span>
                                        <input type="hidden" name="sub_total" id="sub_totalVal">

                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Tax (10%)</span>
                                        <span id="tax">Rp.0</span>
                                        <input type="hidden" name="tax" id="taxVal">

                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <span>Grand Total</span>
                                        <span id="total_amount">Rp.0</span>
                                        <input type="hidden" name="total_amount" id="total_amountVal">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="mb-3">
                        <label for="" class="form-label">Gambar *</label>
                        <input type="file" name="image_cover" required>
                    </div> -->
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" id="save">Simpan</button>
                        <a href="{{ url()->previous() }}" class="text-muted">Kembali</a>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
@endsection