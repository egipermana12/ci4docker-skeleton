<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
    <!-- FontAwesome JS-->
    <link rel="stylesheet" href="<?= base_url("assets/fontawesome/css/all.min.css"); ?>">
    >
    </script>
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

<body>
    <div class="container">
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card py-3 px-4">
                    <h3 class="text-left mb-2 mt-4 fw-medium">Welcome Back</h3>
                    <p class="mb-4 text-secondary font-xs">Buat website travel anda sendiri <br> Sign in dan mulai lebih
                        dekat dengan pelanggan</p>
                    <form class="mt-2" id="loginForm">
                        <?= csrf_field(); ?>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-envelope"></i></span>
                            <input type="text" class="form-control" name="user_email" id="user_email"
                                placeholder="Email@your.com" aria-label="UserEmail" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3" id="show_hide_pass">
                            <span class="input-group-text" id="to">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                            <span class="input-group-text eyeshow" id="basic-addon2">
                                <i class="fa-solid fa-eye-slash"></i>
                            </span>
                        </div>
                        <div class="row justify-content-between mb-3">
                            <div class="col-auto">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label text-secondary font-sm" name="remember" id="remember"
                                        for="exampleCheck1">Remember
                                        Me</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="#" class="link-primary text-decoration-none text-end font-sm">Forgot
                                    password?</a>
                            </div>
                        </div>
                        <div class="d-grid gap-2 mb-4">
                            <button class="btn btn-primary" type="submit">Login</button>
                        </div>
                    </form>

                    <p class="text-secondary font-xs text-center">Or continue with</p>
                    <div class="row mx-auto">
                        <a href="!#" class="col-4">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="!#" class="col-4">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="!#" class="col-4">
                            <i class="fab fa-google"></i>
                        </a>
                    </div>
                    <p class="text-secondary font-xs text-center mt-2">Don't have account? <a
                            href="<?= base_url('register') ?>"
                            class="fw-medium link-secondary fw-bold text-decoration-none ">Sign Up Now!</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="/vite/app.js"></script>

    {{-- ajax --}}
    <script>
        $(document).ready(function () {
            $('#loginForm').submit(function (e) {
                e.preventDefault(); 

                const $btn = $('#loginForm').find('button[type="submit"]');

                $.ajax({
                    type: "post",
                    url: "{{ base_url('login') }}",
                    data: $(this).serialize(),
                    dataType: "json",
                    beforeSend: function () {
                        $btn.attr('disabled', true);
                        $btn.html('<i class="fa fa-spin fa-spinner"></i> Processing...');
                    },
                    success: function (response) {
                        if (response.status == 400) {
                            // Tampilkan pesan error
                            if (response.message === 'Email atau password salah') {
                                alert(response.message);
                            } else {
                                let errors = response.message;
                                const inputs = $('.form-control');

                                inputs.removeClass('is-invalid');
                                $('.invalid-feedback').remove();

                                for (const error in errors) {
                                    const input = $('#' + `${error}`);
                                    input.removeClass('is-invalid');
                                    $('.invalid-feedback[data-error="' + error + '"]').remove();

                                    input.addClass('is-invalid');
                                    input.closest('.input-group').before(
                                        '<div class="invalid-feedback d-block font-xs" data-error="' + error + '">' + errors[error] + '</div>'
                                    );
                                }
                            }

                            // Aktifkan tombol kembali karena gagal login
                            $btn.attr('disabled', false);
                            $btn.html('Login');
                        } else {
                            // Sukses login
                            $('#loginForm')[0].reset();
                            $btn.attr('disabled', true);
                            $btn.html('<i class="fa fa-spin fa-spinner"></i> Redirecting...');

                            // Redirect dengan delay agar render tombol
                            setTimeout(function () {
                                window.location.href = response.redirect;
                            }, 300);
                        }
                    },
                    error: function () {
                        alert("Terjadi kesalahan jaringan atau server.");
                        $btn.attr('disabled', false);
                        $btn.html('Login');
                    }
                });
            });
        });
    </script>
</body>

</html>