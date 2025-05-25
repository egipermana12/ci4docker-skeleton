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
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid container-hight-two">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item me-3">
                        <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#">Account</a>
                    </li>
                    <li class="nav-item me-3 dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Page
                        </a>
                        <ul class="dropdown-menu dropdown-menu-custom">
                            <li><a class="dropdown-item" href="#">About</a></li>
                            <li><a class="dropdown-item" href="#">Our Team</a></li>
                            <li><a class="dropdown-item" href="#">Contac Us</a></li>
                        </ul>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#">Help</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid container-hight-two mt-2">
        <h4>Dashboard</h4>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb font-sm">
                <li class="breadcrumb-item"><a href="#" style="text-decoration: none"><i
                            class="fa-solid fa-house"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
        <div class="row justify-content-center mt-2">
            <div class="col-12 col-lg-4 py-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Card title</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 py-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Card title</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src=<?=base_url("assets/plugins/popper.min.js"); ?>
        >
    </script>
    <script src=<?=base_url("assets/plugins/bootstrap/js/bootstrap.min.js"); ?>
        >
    </script>
    <script src="/vite/app.js"></script>
</body>

</html>