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
    <nav class="navbar sticky-top navbar-expand-lg bg-black container-hight">
        <div class="container-fluid ">
            <a class="navbar-brand text-light" href="#">Navbar</a>
            <div class="d-flex align-items-center gap-2">
                <div class="d-flex">
                    <img src="<?= base_url("vite/ficture/profile.jpg");?>" alt="" class="rounded" width="35px"
                    height="35px" class="bg-success">
                </div>
                <a class="btn btn-primary btn-sm btn-no-fw" href="<?= base_url('logout') ?>">Logout</a>
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