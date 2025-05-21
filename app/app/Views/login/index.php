<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
    <!-- FontAwesome JS-->
    <script defer src=<?= base_url("assets/fontawesome/js/all.min.js"); ?>></script>
    <style>
        body {
            padding-top: 0 !important;
        }
    </style>

    <!-- Theme CSS -->
    <?php if (ENVIRONMENT === 'development'): ?>
        <!-- Saat development, load Vite dev server -->
        <script type="module" src="http://localhost:5173/js/app.js"></script>
    <?php else: ?>
        <!-- Saat production, load versi yang sudah dibuild -->
        <link rel="stylesheet" href="/vite/style.css">
        <script src="/vite/app.js" type="module"></script>
    <?php endif; ?>
</head>

<body>
    <div class="container">
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card py-3 px-4">
                    <p class="text-center mb-3 mt-2">Login</p>
                    <p class="text-center"><span>Masuk Dengan Email</span></p>
                    <form class="">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12 mb-2">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label text-secondary fs-sm" for="exampleCheck1">Remember Me</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 mb-4">
                            <button class="btn btn-primary" type="button">Login</button>
                        </div>
                    </form>
                    <div class="row mx-auto ">
                        <div class="col-4">
                            <i class="fab fa-twitter"></i>
                        </div>
                        <div class="col-4">
                            <i class="fab fa-facebook"></i>
                        </div>
                        <div class="col-4">
                            <i class="fab fa-google"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>