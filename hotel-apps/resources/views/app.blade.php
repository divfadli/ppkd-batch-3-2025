<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{$title ?? 'Management Hotel'}}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

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
    // variable -> let, var, const
    let category_id = document.getElementById('category_id');
    let roomId = document.getElementById('room_id');

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
        const price = selectedOption.getAttribute('data-price') || 0;
        // const price = this.selectedOption[0]?.getAttribute('data-price') || 0; // ERROR

        // Cara Pertama
        // const rupiah = new Intl.NumberFormat("id-ID", {
        //     style: "currency",
        //     currency: "IDR"
        // }).format(price)

        // const formatted = Number(price).toLocaleString("id-ID", {
        //     style: "currency",
        //     currency: "IDR",
        //     minimumFractionDigits: 0,
        //     maximumFractionDigits: 0
        // });

        document.getElementById('roomRate').textContent = Number(price).toLocaleString("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        });

    })
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