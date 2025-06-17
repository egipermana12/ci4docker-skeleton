<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
    <!-- FontAwesome JS-->
    <link rel="stylesheet" href="<?= base_url("assets/fontawesome/css/all.min.css"); ?>">

    <script src=<?=base_url("assets/jquery/jquery.min.js"); ?>
        >
    </script>

    {{-- sweetalert --}}
    <script src=<?=base_url("assets/sweetalert/sweetalert.all.min.js"); ?>
        >
    </script>
    <link rel="stylesheet" href="<?= base_url("assets/sweetalert/sweetalert.all.min.css"); ?>">

    {{-- select2 --}}
    <script src=<?=base_url("assets/select2/select2.min.js"); ?>
        >
    </script>
    <link rel="stylesheet" href="<?= base_url("assets/select2/select2.min.css"); ?>">

    {{-- datatables --}}
    <script src=<?=base_url("assets/datatables/datatables.min.js"); ?>
        >
    </script>
    <link rel="stylesheet" href="<?= base_url("assets/datatables/datatables.min.css"); ?>">

    <style>
        body {
            padding-top: 0 !important;
        }
    </style>

    <!-- Theme CSS -->

    <!-- Saat production, load versi yang sudah dibuild -->
    <link rel="stylesheet" href="/vite/style.css">

</head>

<body class="bg-gray-600">
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light container-hight-two">
        <div class="container-fluid ">
            <a class="navbar-brand text-black" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-flex align-items-center gap-2">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item me-3 active">
                        <a class="nav-link text-black" href="#">Outlet <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link text-black" href="#">Blog</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link text-black" href="#">Lacak Paket</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link text-black" href="#">Cara Bayar</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link text-black" href="#">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <script src=<?=base_url("assets/plugins/popper.min.js"); ?>
        >
    </script>
    <script src=<?=base_url("assets/plugins/bootstrap/js/bootstrap.min.js"); ?>
        >
    </script>
    <script src="/vite/app.js"></script>
</body>

</html>