<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link 
        rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        />
        <link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.css" />
        
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <title>Salemba Book</title>
  <style>
    .nav-link.active{
      background-color: #BDE8F5 !important;
      color: #0F2854 !important;
      font-weight: 700;
    }
    @media (min-width: 992px) {
        .sidebar-offset {
            margin-left: 280px !important;
        }
    }
    @media (max-width: 991px) {
        #sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        #sidebar.show {
            transform: translateX(0);
        }
    }
    .stat-card {
      border-radius: 20px;
      overflow: hidden; 
    }
    .btn-login {
      background-color:  #9593c46b !important;
      color: #fff;
      font-weight: 700;
    }
    .btn-login:hover {
      background-color: #3B38A0 !important;
      color: #fff;
    }
  </style>
</head>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.js"></script>
<body>

<div class="container-fluid">
  <div class="row flex-nowrap">
   
  @auth
      <nav id="sidebar" class="position-fixed d-lg-flex flex-column" 
         style="width: 280px; height: 100vh; z-index: 1000; background-color: #3B38A0;">
        <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none px-2 py-3">
          <i class="bi bi-grid-3x3-gap-fill me-2"></i>
          <img src="{{ asset('img/lo.png') }}" style="width: 13em" class="mt-2 d-flex justify-content-center" alt="">
        </a>

        <hr class="text-white">

        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item mb-3">
                <a href="{{ route('dashboard') }}"
                  class="nav-link d-flex align-items-center p-3 text-white fw-bold
                  {{ Request::routeIs('dashboard') ? 'active' : 'text-dark' }}">
                    <i class="fa-solid fa-house fa-lg me-3"></i>
                    Dashboard
                </a>
            </li>
            @if (in_array(auth()->user()->role, ['admin']))
              <li class="nav-item mb-3">
                <a href="{{ route('index.kat') }}"
                  class="nav-link d-flex align-items-center p-3 text-white fw-bold
                  {{ Request::routeIs('index.kat') ? 'active' : 'text-dark' }}">
                    <i class="fa-solid fa-book fa-lg me-3"></i>Product Category</a>
            </li>
            @endif
            @if (in_array(auth()->user()->role, ['admin','kasir']))
              <li class="nav-item">
                <a href="{{ route('viewTrans') }}"
                  class="nav-link d-flex align-items-center p-3 text-white fw-bold
                  {{ Request::routeIs('viewTrans') ? 'active' : 'text-dark' }}">
                    <i class="fa-solid fa-server fa-lg me-3"></i>Data Transaction</a>
            </li>
            @endif
        </ul>

        <div class="dropdown dropup mb-5 ms-3">
            <button class="btn p-0 border-0 bg-transparent text-white"
                    type="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                <i class="fa-solid fa-user fa-2x"></i>
            </button>

            <ul class="dropdown-menu dropdown-menu-end">
                <li class="dropdown-item">
                    <b>{{ auth()->user()->name }}</b>
                </li>

                <li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="dropdown-item" type="submit">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
      </nav>
  @endauth
    
    

   @guest
     <div class="col px-0">
      <nav class="navbar navbar-expand-lg sticky-top p-4 shadow-lg" style="background-color: #3B38A0;" >
        <div class="container-fluid">
          <div class="d-flex align-items-center">
            <button class="btn btn-light d-lg-none me-2" id="btnToggleSidebar">
              <i class="bi bi-list"></i>
            </button>
            @guest
              <img src="{{ asset('img/lo.png') }}" style="width: 10em" alt="">
            @endguest
          </div>
          <form class="d-none d-md-flex ms-3 flex-grow-1" role="search" action="{{ route('search') }}" method="GET">
            <div class="input-group">
              
              <input
                class="form-control border-start-0 p-3" style="border: none;"
                type="search"
                placeholder="Search your product here.."
                aria-label="Search"
                name="q" value="{{ request('q') }}"
              >
            </div>
          </form>

          <div class="d-flex align-items-center gap-2 ms-3">
            @guest
              <a href="{{ route('login') }}" class="btn btn-login d-flex align-items-center justify-content-center">
                Login
              </a>
            @endguest
          </div>
        </div>
      </nav>
   @endguest 
      <div class="container-fluid p-3 w-100">
        @guest
            @if (session('success'))
                <div class="alert alert-success"><i class="fa-solid fa-circle-check me-2"></i>
                    {{ session('success') }}
                </div>
            @endif
        @endguest
        <main class="@auth sidebar-offset @endauth flex-grow-1">
          @yield('content')
        </main>
      </div>
    </div>
  </div>
</div>
   <script>
        $(document).ready(function () {
          const table = $('#myTable').DataTable({
              autoWidth: false,
              columnDefs: [
                  {
                      targets: -1,
                      orderable: false,
                      className: 'text-end'
                  }
              ]
          });
        });

        const btnToggleSidebar = document.getElementById('btnToggleSidebar');
        const sidebar = document.getElementById('sidebar');

        if(btnToggleSidebar && sidebar){
          btnToggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('show');
          });
        }
   </script>
  @stack('scripts')
</body>
</html>
