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

<body>
    <div class="container">
        <div class="row d-flex justify-content-center mt-5">
            <div>
                <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>
            </div>
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
                                    <input type="checkbox" class="form-check-input" name="remember" id="remember">
                                    <label class="form-check-label text-secondary font-sm" for="remember">Remember
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

                    <p class="text-secondary font-sm fw-semibold text-center">Or</p>
                    <div class="d-grid gap-2">
                        <a href="<?= base_url('auth/facebook') ?>" class="btn btn-light">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17.5 0H2.5C1.12125 0 0 1.12125 0 2.5V17.5C0 18.8787 1.12125 20 2.5 20H17.5C18.8787 20 20 18.8787 20 17.5V2.5C20 1.12125 18.8787 0 17.5 0Z"
                                    fill="#1976D2" />
                                <path
                                    d="M16.875 10H13.75V7.5C13.75 6.81 14.31 6.875 15 6.875H16.25V3.75H13.75C11.6788 3.75 10 5.42875 10 7.5V10H7.5V13.125H10V20H13.75V13.125H15.625L16.875 10Z"
                                    fill="#FAFAFA" />
                            </svg>
                            &nbsp;&nbsp; <span class="text-secondary font-sm fw-light">Continue with Facebook</span>
                        </a>
                        <a href="<?= base_url('auth/google') ?>" class="btn btn-light">
                            <svg width="20" height="20" viewBox="0 0 28 28" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M27.9851 14.2618C27.9851 13.1146 27.8899 12.2775 27.6837 11.4094H14.2788V16.5871H22.1472C21.9886 17.8738 21.132 19.8116 19.2283 21.1137L19.2016 21.287L23.44 24.4956L23.7336 24.5242C26.4304 22.0904 27.9851 18.5093 27.9851 14.2618Z"
                                    fill="#4285F4" />
                                <path
                                    d="M14.279 27.904C18.1338 27.904 21.37 26.6637 23.7338 24.5245L19.2285 21.114C18.0228 21.9356 16.4047 22.5092 14.279 22.5092C10.5034 22.5092 7.29894 20.0754 6.15663 16.7114L5.9892 16.7253L1.58205 20.0583L1.52441 20.2149C3.87224 24.7725 8.69486 27.904 14.279 27.904Z"
                                    fill="#34A853" />
                                <path
                                    d="M6.15656 16.7113C5.85516 15.8432 5.68072 14.913 5.68072 13.9519C5.68072 12.9907 5.85516 12.0606 6.14071 11.1925L6.13272 11.0076L1.67035 7.62109L1.52435 7.68896C0.556704 9.58024 0.00146484 11.7041 0.00146484 13.9519C0.00146484 16.1997 0.556704 18.3234 1.52435 20.2147L6.15656 16.7113Z"
                                    fill="#FBBC05" />
                                <path
                                    d="M14.279 5.3947C16.9599 5.3947 18.7683 6.52635 19.7995 7.47204L23.8289 3.6275C21.3542 1.37969 18.1338 0 14.279 0C8.69485 0 3.87223 3.1314 1.52441 7.68899L6.14077 11.1925C7.29893 7.82856 10.5034 5.3947 14.279 5.3947Z"
                                    fill="#EB4335" />
                            </svg>
                            &nbsp;&nbsp; <span class="text-secondary font-sm fw-light">Continue with Google</span>
                        </a>
                    </div>
                    <p class="text-secondary font-xs text-center mt-4">Don't have account? <a
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="csrf_token_name"]').val()
                }
            });
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
                        
                        //refresh csrf token
                        if(response.csrf){
                            refreshToken(response.csrf.name, response.csrf.value);
                        }

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