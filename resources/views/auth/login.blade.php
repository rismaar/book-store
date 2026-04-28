<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" ref="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="icon" href="{{ asset('img/lo.png') }}" type="image/png">
    <title>Login</title>
</head>
<style>
    ::placeholder{
        color: #ffffff4b !important;
        opacity: 1 !important;
        font-weight: 500;
    }
    .btn-log:hover{
        color: #ffde42 !important;
        background-color: #3B38A0 !important;
        cursor: pointer;
        box-shadow: 0 8px 8px rgba(255, 255, 255, 0.2);
    }
</style>
<body class="bg-light justify-content-center d-flex align-items-center vh-100">
    <div class="container rounded-5 d-flex flex-column align-items-center w-25 mx-auto p-5  shadow-lg bg-opacity-25" style="background-color: #3B38A0">
        <img src="{{ asset('img/lo.png') }}" style="width: 15em" alt="">
            <form></form>
            <form action="{{ route('login.process') }}" method="POST" class="mb-5 mt-5 w-100 h-auto">
                @csrf
                @error('username')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="mb-3 ">
                    <input type="text" class="form-control-lg form-control rounded-5 p-4 border-0" id="username" name="username" placeholder="Username" style="background-color: #ffffff42" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control-lg form-control rounded-5 p-4 border-0" id="password" name="password" placeholder="Password" style="background-color: #ffffff42;" required>
                </div>
                <button type="submit" class="btn btn-log mb-3 mt-3 p-3 w-100 rounded-5 fw-bold" style="background-color: #ffde42; color: #3B38A0; font-size: 1rem;"><b>Login</b></button>
            </form>
    </div>
</body>
</html>
