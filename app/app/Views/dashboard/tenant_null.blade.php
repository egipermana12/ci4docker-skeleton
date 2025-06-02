@extends('layout.layout_dashboard')

@section('content')

<div class="container-fluid container-hight-two mt-2">
    <div class="row justify-content-start">
        <div class="col-12 col-lg-6 py-2">
            <h4 class="text-gray-400">Hello Travel Agents</h4>
            <p class="mb-4 text-secondary font-sm">Kamu belum memiliki data travel, buat travel kamu dan rasakan
                kemudahan untuk para pelanggan</p>
        </div>
        <div class="col-12 col-lg-6 py-2">
            <div class="card py-3 px-5">
                <h4 class="text-left mb-4 mt-4 fw-medium text-primary">Registrasi Travel Baru</h4>
                <form class="" id="tenantForm" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <label for="basic-url" class="form-label text-secondary font-sm">Yor Travel Name</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-compass"></i></span>
                        <input type="text" class="form-control" name="tenant_name" id="tenant_name"
                            placeholder="sinar Jaya Travel" aria-label="Tenantsname" aria-describedby="basic-addon1">
                    </div>
                    <label for="basic-url" class="form-label text-secondary font-sm">Yor Email Travel</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-envelope"></i></span>
                        <input type="text" class="form-control" name="tenant_email" id="tenant_email"
                            placeholder="cs@travel.com" aria-label="TenantsEmail" aria-describedby="basic-addon1">
                    </div>
                    <label for="basic-url" class="form-label text-secondary font-sm">Yor Subdomain Travel</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i
                                class="fa-solid fa-earth-americas"></i></span>
                        <input type="text" class="form-control" name="subdomain" id="subdomain"
                            placeholder="sinarjaya.localhost.com" aria-label="subdomain"
                            aria-describedby="basic-addon1">
                    </div>
                    <label for="basic-url" class="form-label text-secondary font-sm">Yor Phone Travel</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-phone-volume"></i></span>
                        <input type="text" class="form-control" name="tenant_phone" id="tenant_phone"
                            placeholder="08************" aria-label="tenant_phone" aria-describedby="basic-addon1">
                    </div>
                    <label for="basic-url" class="form-label text-secondary font-sm">Yor Logo Travel</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-icons"></i></span>
                        <input type="file" class="form-control" name="tenant_logo" id="tenant_logo"
                            placeholder="your logo" aria-label="logo" aria-describedby="basic-addon1">
                    </div>
                    <label for="basic-url" class="form-label text-secondary font-sm">Yor Address Travel</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-location-dot"></i></span>
                        <textarea class="form-control" name="tenant_address" id="tenant_address"
                            aria-label="With textarea"></textarea>
                    </div>
                    <div class="d-grid gap-2 mb-4">
                        <button class="btn btn-primary" type="submit">Buat Travels</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="csrf_token_name"]').val()
                }
        });
        $("#tenantForm").submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            
            const $btn = $('#tenantForm').find('button[type="submit"]');
            $.ajax({
                type: "POST",
                url: "{{ base_url('tenants') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
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
                        let errors = response.errors;
                        
                        const inputs = $('.form-control');
                        inputs.removeClass('is-invalid');
                        $('.invalid-feedback').remove();

                        for (const error in errors) {
                            const input = $('#' + `${error}`);
                            input.removeClass('is-invalid');
                            $('.invalid-feedback[data-error="' + error + '"]').remove();
                            
                            input.addClass('is-invalid');
                            input.closest('.form-control').after(
                                '<div class="invalid-feedback d-block font-xs" data-error="' + error + '">' + errors[error] + '</div>'
                            );
                        }
                        // Aktifkan tombol kembali karena gagal login
                        $btn.attr('disabled', false);
                        $btn.html('Buat Travels');
                    }else{
                        Swal.fire({
                            title: 'Success!',
                            text: 'Travels berhasil dibuat',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        });
                        $('#tenantForm')[0].reset();
                        $btn.attr('disabled', true);
                        $btn.html('<i class="fa fa-spin fa-spinner"></i> Redirecting...');
                        setTimeout(function () {
                            window.location.href = "{{ base_url('dashboard') }}";
                        }, 2000);
                    }
                },
                error: function () {
                    alert("Terjadi kesalahan jaringan atau server.");
                    $btn.attr('disabled', false);
                    $btn.html('Buat Travels');
                }
            });
        })     
    });
</script>

@stop