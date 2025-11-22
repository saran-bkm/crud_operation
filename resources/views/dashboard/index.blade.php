@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="row mb-4">

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="text-muted">Total Customers</h6>
                <h3 class="fw-bold text-primary">1,250</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="text-muted">Total Orders</h6>
                <h3 class="fw-bold text-success">3,842</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="text-muted">Active Customers</h6>
                <h3 class="fw-bold text-info">812</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="text-muted">Today New</h6>
                <h3 class="fw-bold text-warning">27</h3>
            </div>
        </div>
    </div>

</div>
@endsection
