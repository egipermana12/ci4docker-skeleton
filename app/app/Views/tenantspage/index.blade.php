@extends('layout.layout_tenants')
@section('content')
<div class="bg-success py-4">
    <div class="container-fluid container-hight-two">
        <div class="card p-5">
            <form class="row g-4">
                <div class="col-lg-4 col-12">
                    <label for="inputState" class="form-label">Keberangkatan</label>
                    <select id="inputState" class="form-select">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                </div>
                <div class="col-lg-4 col-12">
                    <label for="inputState" class="form-label">Tujuan</label>
                    <select class="form-select" id="tujuan">
                        <option selected>Pilih Tujuan</option>
                        <option>Bandung</option>
                        <option>Jakarta</option>
                    </select>
                </div>
                <div class="col-lg-4 col-12">
                    <label for="inputState" class="form-label">Penumpang</label>
                    <select id="inputState" class="form-select">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                </div>
                <div class="col-lg-4 col-12">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail4">
                </div>
                <div class="col-lg-4 col-12">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail4">
                </div>
                <div class="col-lg-4 col-12">
                    <label for="inputState" class="form-label">Penumpang</label>
                    <select id="inputState" class="form-select">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tujuan').select2({
            theme: 'bootstrap-5'
        });
    });
</script>
@stop