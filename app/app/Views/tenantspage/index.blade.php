@extends('layout.layout_tenants') @section('content')

<div class="bg-blue-dark py-4">
    <div class="container-fluid container-hight-two">
        <div class="card p-5">
            <form class="row g-4" id="formCariSchedule">
                <?= csrf_field(); ?>
                <div class="col-lg-4 col-12">
                    <label for="inputState" class="form-label text-secondary"
                        >Keberangkatan</label
                    >

                    <select class="form-select" id="berangkat">
                        <option selected>Pilih Keberangkatan</option>
                        @foreach ($departure as $city)
                        <optgroup label="{{$city['city_name']}}" data-parent-id="{{$city['city_id']}}">
                            @foreach($city['depature'] as $pt)
                            <option value="{{$city['city_id']}}.{{$pt['depature_id']}}"> {{$pt['daparture_name']}}</option>
                            @endforeach()
                        </optgroup>
                        @endforeach()
                    </select>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="d-flex">
                        <label
                            for="inputState"
                            class="form-label text-secondary"
                            >Tujuan</label
                        >
                        <div id="loadingSmall">

                        </div>
                    </div>
                    <select class="form-select" id="tujuan"></select>
                </div>
                <div class="col-lg-4 col-12">
                    <label for="inputState" class="form-label text-secondary"
                        >Penumpang</label
                    >
                    <select class="form-select" id="orang">
                        <?php $penumpang = [ 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5
                        => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, ]; ?>
                        @foreach ($penumpang as $key => $value)
                        <option value="$key">{{$value}} Orang</option>
                        @endforeach()
                    </select>
                </div>
                <div class="col-lg-4 col-12">
                    <label for="inputEmail4" class="form-label text-secondary"
                        >Tanggal Berangkat</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="tglberangkat"
                        readonly
                    />
                </div>
                <div class="col-lg-4 col-12">
                    <label for="inputEmail4" class="form-label text-secondary"
                        >Tanggal Puang</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="tglpulang"
                        readonly
                    />
                </div>
                <div class="col-lg-4 col-12">
                    <label for="inputEmail4" class="form-label text-secondary"
                        >&nbsp;</label
                    >
                    <button class="btn btn-primary d-block w-100" type="submit">
                        <i class="fas fa-search"></i> &nbsp; Cari Seat
                    </button>
                </div>
            </form>
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
        $('#tujuan').select2({
            closeOnSelect: true,
            dropdownCssClass: 'selectgroup',
        });
        $('#berangkat').select2({
            closeOnSelect: true,
            dropdownCssClass: 'selectgroup',
        });
        $('#orang').select2({
            closeOnSelect: true,
        });

        var tglBerangkat = new Date();
        var pickerPulang;

        var picker = new Pikaday({
            field: $('#tglberangkat')[0],
            format: 'D MMM YYYY', // format input (bisa disesuaikan)
            minDate: tglBerangkat,
            onSelect: function () {
                // Ambil moment dan format tanggal
                var selectedDate = this.getDate(); // <- Ini yang sebelumnya belum ada
                var formattedDate =
                    moment(selectedDate).format('dddd, D MMMM YYYY');
                // Jika ingin mengisi input dengan format ini:
                $('#tglberangkat').val(formattedDate);

                // Set minDate picker pulang menjadi sama dengan tgl berangkat
                if (pickerPulang) {
                    pickerPulang.setMinDate(selectedDate);

                    var currentPulang = pickerPulang.getDate();
                    if (currentPulang && currentPulang < selectedDate) {
                        $('#tglpulang').val('');
                        pickerPulang.setDate(selectedDate); // Set default ke tanggal berangkat
                    }
                }
            },
        });
        picker.setDate(tglBerangkat);

        pickerPulang = new Pikaday({
            field: $('#tglpulang')[0],
            format: 'D MMM YYYY', // format input (bisa disesuaikan)
            minDate: tglBerangkat,
            onSelect: function () {
                // Ambil moment dan format tanggal
                var selectedDate = this.getDate(); // <- Ini yang sebelumnya belum ada
                var formattedDate =
                    moment(selectedDate).format('dddd, D MMMM YYYY');

                // Jika ingin mengisi input dengan format ini:
                $('#tglpulang').val(formattedDate);
            },
        });
        pickerPulang.setDate(tglBerangkat);

        $('#berangkat').on('change', function (e) {
            e.preventDefault();

            let id_kota_berangkat = $('#berangkat').val();
            $.ajax({
                type: "post",
                url: "{{ base_url('tujuan_tenant') }}",
                data: {city_id: id_kota_berangkat},
                crossDomain: true,
                dataType: "json",
                beforeSend: function () {
                    loadingSmall();
                },
                success: function(response){
                    //refresh csrf token
                    if(response.csrf){
                        refreshToken(response.csrf.name, response.csrf.value);
                    }
                    console.log(response);
                    clearLoadingSmall();
                }
            });

        });
    });
</script>
@stop
