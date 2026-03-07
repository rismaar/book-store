@extends('layouts.app')
@section('content')

<div class="container-fluid">
  <div class="row h-100 mt-3">
    <div class="col-sm-6 mb-3">
        <a href="{{ route('viewRest') }}" class="text-decoration-none">
            <div class="card h-100 shadow-lg border-0 stat-card">
                <div class="stat-header bg-warning text-white p-3">
                    <b>Request</b>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center p-5 gap-3 bg-light" >
                    <div class="d-flex align-items-center gap-3">
                        <i class="fa-solid fa-code-pull-request fa-3x"></i>
                        <h2 class="text-dark mb-0">Request</h2>
                    </div>
                    <span class="badge bg-warning text-white rounded-pill fs-2 fw-bold">{{$restockCount}}</span>
                </div>
            </div>
        </a>
    </div>


    <div class="col-sm-6 h-100">
        <a href="{{ route('viewApproved') }}" class="text-decoration-none">
            <div class="card h-100 border-0 shadow-lg stat-card">
                <div class="stat-header  text-white p-3" style="background-color: #B0CE88">
                    <b>Received</b>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center gap-3 p-5 bg-light">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fa-solid fa-bell-concierge fa-3x"></i>
                        <h2 class="text-dark mb-2">Received</h2>
                    </div>
                    <span class="badge text-white rounded-pill fs-2 fw-bold" style="background-color: #B0CE88">{{$receivedCount}}</span>
                </div>
            </div>     
        </a>
    </div>

    <div class="col-sm-6 h-100 mt-3">
        <a href="{{ route('recent') }}" class="text-decoration-none">
            <div class="card h-100 border-0 shadow-lg stat-card">
                <div class="stat-header bg-info text-white p-3">
                    <b>History</b>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center gap-3 p-5 bg-light">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fa-solid fa-clock-rotate-left fa-3x"></i>
                        <h2 class="text-dark mb-2">History</h2>
                    </div>
                    <span class="badge bg-info text-white rounded-pill fs-2 fw-bold">{{$historyCount}}</span>
                </div>
            </div>     
        </a>
    </div>
  </div>
</div>

@endsection