@extends('layouts.app')
@section('content')

<div class="container-fluid">
  <div class="row h-100 mt-3">
    <div class="col-sm-6 mb-3 mb-sm-0 h-100">
        <a href="{{ route('viewRest') }}" class="d-block h-100" style="text-decoration: none;">
            <div class="card h-100 p-5 d-flex align-items-center shadow-lg" 
                style="border: none; background-color: #0F2854;">
                <div class="card-body text-light d-flex align-items-start gap-3 w-100">
                    <i class="fa-solid fa-code-pull-request fa-3x flex-shrink-0 mt-1"></i>
                    <div class="flex-grow-1">
                        <h3 class="card-title mb-2">Request</h3>
                        <p class="card-text mb-0">With supporting text below as a natural lead-in.</p>
                    </div>
                </div>
            </div>     
        </a>
    </div>

    <div class="col-sm-6 h-100">
        <a href="{{ route('viewApproved') }}" class="d-block h-100" style="text-decoration: none;">
            <div class="card h-100 p-5 d-flex align-items-center shadow-lg" 
                style="border: none; background-color: #F5C857;">
                <div class="card-body text-light d-flex align-items-start gap-3 w-100">
                    <i class="fa-solid fa-bell-concierge fa-3x flex-shrink-0 mt-1"></i>
                    <div class="flex-grow-1">
                        <h3 class="card-title mb-2">Received</h3>
                        <p class="card-text mb-0">With supporting text below as a natural lead-in.</p>
                    </div>
                </div>
            </div>     
        </a>
    </div>

    <div class="col-sm-6 h-100 mt-3">
        <a href="{{ route('recent') }}" class="d-block h-100" style="text-decoration: none;">
            <div class="card h-100 p-5 d-flex align-items-center shadow-lg" 
                style="border: none; background-color: #970e59;">
                <div class="card-body text-light d-flex align-items-start gap-3 w-100">
                    <i class="fa-solid fa-clock-rotate-left fa-3x flex-shrink-0 mt-1"></i>
                    <div class="flex-grow-1">
                        <h3 class="card-title mb-2">History</h3>
                        <p class="card-text mb-0">With supporting text below as a natural lead-in.</p>
                    </div>
                </div>
            </div>     
        </a>
    </div>
  </div>
</div>


@endsection