<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{$title ?? 'Management Hotel'}}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta content="{{ csrf_token() }}" name="csrf-token">

    <!-- Favicons -->
    <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
    <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- Header -->
    @include('layout/inc/header')
    <!-- Sidebar -->
    @include('layout/inc/sidebar')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>@yield('title')</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Pages</li>
                    <li class="breadcrumb-item active">Blank</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            @yield('content')
        </section>

    </main><!-- End #main -->

    <!-- Footer -->
    @include('layout/inc/footer')



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('assets/vendor/quill/quill.js')}}"></script>
    <script src="{{assert('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{assert('assets/vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{assert('assets/vendor/php-email-form/validate.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{assert('assets/js/main.js')}}"></script>
    <script>
    const changeLocalStringRupiah = (price) => {
        return new Number(price).toLocaleString("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        })
    }

    const formattedRupiah = (price) => {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
        }).format(price)
    }

    // variable -> let, var, const
    let category_id = document.getElementById('category_id');
    let roomId = document.getElementById('room_id');
    const checkInInput = document.getElementById('checkin');
    const checkOutInput = document.getElementById('checkout');
    const roomRateText = document.getElementById('roomRate');
    const totalNightText = document.getElementById('totalNight');
    const subTotalText = document.getElementById('sub_total');
    const taxText = document.getElementById('tax');
    const totalAmountText = document.getElementById('total_amount');

    let roomRate = 0;

    category_id.addEventListener('change', async function() {
        const id_category = this.value;

        roomId.innerHTML = "<option value=''>Pilih Kamar..</option>";

        // fetch() / fetching yaitu ambil data dari backend. Ajax
        // axios()
        try {
            const response = await fetch(`/get-room-by-category/${id_category}`);
            const data = await response.json();

            data.data.forEach(room => {
                const opt = document.createElement('option');
                opt.value = room.id;
                opt.textContent = `${room.name}`;
                opt.setAttribute('data-price', room.price);
                roomId.appendChild(opt);
            });
        } catch (error) {
            console.log("error:", error);
        }
    })

    room_id.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        roomRate = selectedOption.getAttribute('data-price') || 0;

        roomRateText.textContent = formattedRupiah(roomRate);
        calculateTotal();
        document.getElementById('roomRateVal').value = roomRate;
    })

    function calculateTotal() {
        const checkin = new Date(checkInInput.value);
        const checkout = new Date(checkOutInput.value);

        if (checkin && checkout && checkout > checkin && roomRate) {
            const timeDiff = checkout - checkin;
            const night = timeDiff / (1000 * 60 * 60 *
                24); // 1000(milidetik) 60(jumlah menit/detik) 60(jumlah menit/jam) 24(24 jam) (86.400.000)

            const subTotal = parseFloat(roomRate) * night;
            const tax = subTotal * 0.1;
            const GrandTotal = subTotal + tax;

            document.getElementById('totalNightVal').value = night;
            document.getElementById('sub_totalVal').value = subTotal;
            document.getElementById('taxVal').value = tax;
            document.getElementById('total_amountVal').value = GrandTotal;

            totalNightText.textContent = night;
            subTotalText.textContent = formattedRupiah(subTotal);
            taxText.textContent = formattedRupiah(tax);
            totalAmountText.textContent = formattedRupiah(GrandTotal);
        }
    }

    checkInInput.addEventListener('change', calculateTotal);
    checkOutInput.addEventListener('change', calculateTotal);

    document.getElementById('save').addEventListener('click', async function() {
        // const guest_name = document.getElementsByName('guest_name').value
        const guest_name = document.querySelector('input[name="guest_name"]').value;
        const guest_email = document.querySelector('input[name="guest_email"]').value;
        const guest_phone = document.querySelector('input[name="guest_phone"]').value;
        const guest_qty = document.querySelector('select[name="guest_qty"]').value;
        const room_id = document.querySelector('#room_id').value;
        const guest_room_number = document.querySelector('select[name="guest_room_number"]').value;
        const guest_note = document.querySelector('textarea[name="guest_note"]').value;
        const guest_check_in = document.querySelector('input[name="guest_check_in"]').value;
        const guest_check_out = document.querySelector('input[name="guest_check_out"]').value;
        const payment_method = document.querySelector('select[name="payment_method"]').value;
        const sub_total = document.querySelector('#sub_totalVal').value;
        const total_night = document.querySelector('#totalNightVal').value;
        const tax = document.querySelector('#taxVal').value;
        const total_amount = document.querySelector('#total_amountVal').value;
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const reservation_number = "RSV-270893-001";

        console.log(guest_name, guest_email, guest_phone, guest_qty, room_id, guest_room_number, guest_note,
            guest_check_in, guest_check_out, payment_method, sub_total, tax, total_amount);

        const data = {
            guest_name: guest_name,
            guest_email: guest_email,
            guest_phone: guest_phone,
            guest_qty: guest_qty,
            room_id: room_id,
            guest_room_number: guest_room_number,
            guest_note: guest_note,
            guest_check_in: guest_check_in,
            guest_check_out: guest_check_out,
            total_night: total_night,
            payment_method: payment_method,
            sub_total: sub_total,
            tax: tax,
            total_amount: total_amount,
            reservation_number: reservation_number
        }
        try {
            const response = await fetch(`/reservation`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": token,
                },
                body: JSON.stringify(data)
            }); // url + ',' post

            const result = await response.json();
            if (response.ok) {
                alert("Reservasi Berhasil");
            }
        } catch (error) {
            console.log("error", error);
            alert("Reservasi Gagal");
        }
    });
    </script>
    <script>
    // Auto close alert setelah 3 detik (3000 ms)
    setTimeout(() => {
        let alertEl = document.querySelector('.alert');
        if (alertEl) {
            let alert = new bootstrap.Alert(alertEl);
            alert.close();
        }
    }, 3000);
    </script>

</body>

</html>