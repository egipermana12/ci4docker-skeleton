@extends('layout.layout_dashboard')

@section('content')

@include('layout.navbar_tenant_not_null')

<div class="container-fluid container-hight-two mt-2">

    <div class="card px-4 py-3">
        <h4 class="mb-4">Travels</h4>
        <table class="table table-bordered dataTable no-footer table-hover font-sm" id="tenantsTable">
            <thead>
                <tr class="text-secondary">
                    <th scope="col">No</th>
                    <th scope="col">Nama Travel</th>
                    <th scope="col">Email Travel</th>
                    <th scope="col">subdomain</th>
                    <th scope="col">tenant_logo</th>
                    <th scope="col">tenant_address</th>
                    <th scope="col">tenant_phone</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
    $('#tenantsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/tenants/fetch',
        order: [],
        columnDefs: [
            { targets: 0, orderable: false},
            { targets: 4, orderable: false},
        ]
    });
});
</script>

@stop