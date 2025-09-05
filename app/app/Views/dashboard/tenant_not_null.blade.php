@extends('layout.layout_dashboard')

@section('content')

@include('layout.navbar_tenant_not_null')

<div class="container-fluid container-hight-two mt-2">
    <h4>Dashboard</h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb font-sm">
            <li class="breadcrumb-item"><a href="#" style="text-decoration: none"><i class="fa-solid fa-house"></i></a>
            </li>
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

@stop