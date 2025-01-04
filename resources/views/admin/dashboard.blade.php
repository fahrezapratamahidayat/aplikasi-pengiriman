@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Pelanggan</h5>
                    <p class="card-text display-6">{{ App\Models\User::where('role_id', 3)->count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Supir</h5>
                    <p class="card-text display-6">{{ App\Models\User::where('role_id', 2)->count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Mobil</h5>
                    <p class="card-text display-6">{{ App\Models\Mobil::count() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
