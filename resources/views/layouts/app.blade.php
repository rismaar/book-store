<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link 
        rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        />
        <link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.css" />
        <script src="https://cdn.datatables.net/2.3.5/js/dataTables.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Book Store</title>
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
</style>
</head>
<body>

<div class="container-fluid">
  <div class="row flex-nowrap">

    @if (auth()->check())
      <nav id="sidebar" class="position-fixed d-lg-flex flex-column" 
         style="width: 280px; height: 100vh; z-index: 1035; background-color: #3B38A0;">
        <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none px-3 py-3">
          <i class="bi bi-grid-3x3-gap-fill me-2"></i>
          <span class="fs-3 fw-semibold text-white fw-bold">Salemba</span>
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

            <li class="nav-item mb-3">
                <a href="{{ route('index.kat') }}"
                  class="nav-link d-flex align-items-center p-3 text-white fw-bold
                  {{ Request::routeIs('index.kat') ? 'active' : 'text-dark' }}">
                    <i class="fa-solid fa-book fa-lg me-3"></i>
                    Data Kategori
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('viewTrans') }}"
                  class="nav-link d-flex align-items-center p-3 text-white fw-bold
                  {{ Request::routeIs('viewTrans') ? 'active' : 'text-dark' }}">
                    <i class="fa-solid fa-server fa-lg me-3"></i>
                    Data Transaksi
                </a>
            </li>
        </ul>

        <div class="dropup mb-5 ms-3">
            <i class="fa-solid fa-user fa-2x href="#" style="color: #ffffff" role="button" data-bs-toggle="dropdown" aria-expanded="false""></i>
            <ul class="dropdown-menu dropdown-menu-lg-end">
              <form action="{{ route('logout') }}" method="post">
                @csrf
                  <li class="dropdown-item"><b>{{ auth()->user()->name }}</b></li>
                  <li><button class="btn btn-light dropdown-item" type="submit"><i class="fa-solid fa-right-from-bracket"></i>Logout</button></li>
              </form>
            </ul>
        </div>
      </nav>
    @endif
    

   @guest
     <div class="col px-0">
      <nav class="navbar navbar-expand-lg bg-body border-bottom sticky-top shadow-sm">
        <div class="container-fluid">
          <div class="d-flex align-items-center">
            <button class="btn btn-light d-lg-none me-2" id="btnToggleSidebar">
              <i class="bi bi-list"></i>
            </button>
            @guest
              <span class="fw-semibold">Salemba</span>
            @endguest
          </div>
          <form class="d-none d-md-flex ms-3 flex-grow-1" role="search" action="{{ route('search') }}" method="GET">
            <div class="input-group">
              <span class="input-group-text bg-white border-end-0">
                <i class="bi bi-search text-secondary"></i>
              </span>
              <input
                class="form-control border-start-0"
                type="search"
                placeholder="Search your product here.."
                aria-label="Search"
                name="q" value="{{ request('q') }}"
              >
            </div>
          </form>

          <div class="d-flex align-items-center gap-2 ms-3">
            @guest
              <a href="{{ route('login') }}" class="btn btn-dark d-flex align-items-center justify-content-center">
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
                <div class="alert alert-success">
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

        btnToggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('show');
        });

        // const searchForm   = document.getElementById('searchForm');
        // const searchInput  = document.getElementById('searchInput');
        // function filterProducts(keyword) {
        //     const items = productList.querySelectorAll('.product-item');
        //     let anyVisible = false;

        //     items.forEach((col) => {
        //     const text = col.textContent.toLowerCase();
        //     const match = text.includes(keyword.toLowerCase());
        //     col.classList.toggle('d-none', !match);
        //     if (match) anyVisible = true;
        //     });

        //     emptyMessage.classList.toggle('d-none', anyVisible);
        // }

        // searchForm.addEventListener('submit', (e) => {
        //     e.preventDefault();
        //     filterProducts(searchInput.value.trim());
        // });

        // searchInput.addEventListener('input', () => {
        //     filterProducts(searchInput.value.trim());
        // });
        $('#btnToggleSidebar').click(function() {
            $('#sidebar').toggleClass('show');
        });
   </script>
  @stack('scripts')
</body>
</html>
