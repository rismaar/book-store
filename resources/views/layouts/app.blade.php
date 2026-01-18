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
      <!-- SIDEBAR -->
      <nav id="sidebar" class="position-fixed d-lg-flex flex-column" 
         style="width: 280px; height: 100vh; z-index: 1035; background-color: #3B38A0;">
        <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none px-3 py-3">
          <i class="bi bi-grid-3x3-gap-fill me-2"></i>
          <span class="fs-3 fw-semibold text-white fw-bold">Griya Baca</span>
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
              <span class="fw-semibold">Griya Baca</span>
            @endguest
          </div>
          <form class="d-none d-md-flex ms-3 flex-grow-1" id="searchForm" role="search">
            <div class="input-group">
              <span class="input-group-text bg-white border-end-0">
                <i class="bi bi-search text-secondary"></i>
              </span>
              <input
                class="form-control border-start-0"
                type="search"
                placeholder="Search your product here.."
                aria-label="Search"
                id="searchInput"
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
    
      <!-- KONTEN HALAMAN -->
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


    
    
    <!-- <div class="sticky-bottom">
         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#e3eeb2" fill-opacity="1" d="M0,160L10.9,165.3C21.8,171,44,181,65,170.7C87.3,160,109,128,131,106.7C152.7,85,175,75,196,106.7C218.2,139,240,213,262,213.3C283.6,213,305,139,327,138.7C349.1,139,371,213,393,208C414.5,203,436,117,458,90.7C480,64,502,96,524,101.3C545.5,107,567,85,589,64C610.9,43,633,21,655,58.7C676.4,96,698,192,720,197.3C741.8,203,764,117,785,85.3C807.3,53,829,75,851,106.7C872.7,139,895,181,916,181.3C938.2,181,960,139,982,122.7C1003.6,107,1025,117,1047,138.7C1069.1,160,1091,192,1113,197.3C1134.5,203,1156,181,1178,181.3C1200,181,1222,203,1244,224C1265.5,245,1287,267,1309,277.3C1330.9,288,1353,288,1375,272C1396.4,256,1418,224,1429,208L1440,192L1440,320L1429.1,320C1418.2,320,1396,320,1375,320C1352.7,320,1331,320,1309,320C1287.3,320,1265,320,1244,320C1221.8,320,1200,320,1178,320C1156.4,320,1135,320,1113,320C1090.9,320,1069,320,1047,320C1025.5,320,1004,320,982,320C960,320,938,320,916,320C894.5,320,873,320,851,320C829.1,320,807,320,785,320C763.6,320,742,320,720,320C698.2,320,676,320,655,320C632.7,320,611,320,589,320C567.3,320,545,320,524,320C501.8,320,480,320,458,320C436.4,320,415,320,393,320C370.9,320,349,320,327,320C305.5,320,284,320,262,320C240,320,218,320,196,320C174.5,320,153,320,131,320C109.1,320,87,320,65,320C43.6,320,22,320,11,320L0,320Z"></path></svg>
    </div> --> 

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

        const searchForm   = document.getElementById('searchForm');
        const searchInput  = document.getElementById('searchInput');
        const productList  = document.getElementById('productList');
        const emptyMessage = document.getElementById('emptyMessage');

        function filterProducts(keyword) {
            const items = productList.querySelectorAll('.product-item');
            let anyVisible = false;

            items.forEach((col) => {
            const text = col.textContent.toLowerCase();
            const match = text.includes(keyword.toLowerCase());
            col.classList.toggle('d-none', !match);
            if (match) anyVisible = true;
            });

            emptyMessage.classList.toggle('d-none', anyVisible);
        }

        searchForm.addEventListener('submit', (e) => {
            e.preventDefault();
            filterProducts(searchInput.value.trim());
        });

        searchInput.addEventListener('input', () => {
            filterProducts(searchInput.value.trim());
        });
        $('#btnToggleSidebar').click(function() {
            $('#sidebar').toggleClass('show');
        });
   </script>
  @stack('scripts')
</body>
</html>
