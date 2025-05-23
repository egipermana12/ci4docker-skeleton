<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
    <!-- FontAwesome JS-->
    <link rel="stylesheet" href="<?= base_url("assets/fontawesome/css/all.min.css"); ?>">
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
            <div id="forAlert"></div>
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card py-3 px-4">
                    <h3 class="text-left mb-2 mt-4 fw-medium">Hey, Welcome</h3>
                    <p class="mb-4 text-secondary font-xs">Buat website travel anda sendiri <br> Sign in dan mulai lebih
                        dekat dengan pelanggan</p>
                    <form class="mt-2" id="registerForm">
                        <?= csrf_field(); ?>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-envelope"></i></span>
                            <input type="text" class="form-control" name="user_email" id="user_email"
                                placeholder="Email@yours.com" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                            <input type="text" class="form-control" name="user_name" id="user_name"
                                placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
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
                        <div class="input-group mb-3" id="show_hide_pass_repeat">
                            <span class="input-group-text" id="ti"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                                placeholder="Repeat Password" aria-label="Password" aria-describedby="basic-addon1">
                            <span class="input-group-text eyeshow" id="basic-addon2"><i
                                    class="fa-solid fa-eye-slash"></i></span>
                        </div>
                        <div class="d-grid gap-2 mb-4">
                            <button class="btn btn-primary" type="submit">Register</button>
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
                    <p class="text-secondary font-xs text-center mt-2">Already have account? <a
                            href="<?= base_url('login') ?>"
                            class="fw-medium link-secondary fw-bold text-decoration-none ">Sign In</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Theme JS -->
    <script src="/vite/app.js"></script>

    {{-- ajax --}}
    <script>
        $(document).ready(function () {
            $('#registerForm').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "{{ base_url('register') }}",
                    data: $(this).serialize(),
                    dataType: "json",
                    beforeSend: function () {
                        $('#registerForm').find('button[type="submit"]').attr('disabled',
                            true);
                        $('#registerForm').find('button[type="submit"]').html(
                            '<i class="fa fa-spin fa-spinner"></i> Processing...');
                    },
                    complete: function () {
                        $('#registerForm').find('button[type="submit"]').attr('disabled',
                            false);
                        $('#registerForm').find('button[type="submit"]').html(
                            'Register');
                    },
                    success: function (response) {
                        // jika validasi gagal, tampilkan pesa
                        if(response.status == 400){
                            let errors = response.message;
                            const inputs = $('.form-control'); // atau ganti selector sesuai kebutuhan

                            // Bersihkan semua error yang lama
                            inputs.removeClass('is-invalid');
                            $('.invalid-feedback').remove();
                            for (const error in errors) {
                                const input = $('#' + `${error}`);
                                input.removeClass('is-invalid');

                                // Hapus feedback sebelumnya yang spesifik
                                $('.invalid-feedback[data-error="' + error + '"]').remove();

                                input.addClass('is-invalid');
                                input.closest('.input-group').before(
                                    '<div class="invalid-feedback d-block font-xs" data-error="' + error + '">' + errors[error] + '</div>'
                                );
                            }
                        }else{
                            $('#registerForm')[0].reset();
                            $('#registerForm').find('button[type="submit"]').attr('disabled',
                                true);
                            let alertWrapper = $('#forAlert');
                            alertWrapper.html('<div class="alert alert-primary" role="alert">Akun berhasil dibuat, silahkan cek email untuk aktivasi akun.</div>');
                        }
                    }
                })
            })
        })
    </script>
</body>

</html>