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
        color: #00000056 !important;
        opacity: 1 !important;
        font-weight: 500;
    }
    .input:focus{
        box-shadow: 0 0 0 0.25rem #3B38A0 !important;
    }
</style>
<body class="bg-light d-flex align-items-center p-5 vh-100">
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row bg-light shadow-lg rounded-5 w-100 overflow-hidden" style="width: 900px">
        <div class="col-md-6 d-flex align-items-center justify-content-center" style="background-color: #3B38A0">
            <img src="{{ asset('img/vect.png') }}" class="img-fluid mb-4 p-5" style="max-width: 85%;" alt="">
        </div>
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center p-5">
            <h1 class="fw-bold mb-5">Let's Go to Work!</h1>
            <form action="{{ route('login.process') }}" method="POST" class="w-75">
                @csrf
                @error('username')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="mb-3">
                    <input type="text" class="form-control form-control-lg rounded-4 p-3 border-0 bg-secondary-subtle" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control form-control-lg rounded-4 p-3 border-0 bg-secondary-subtle" name="password" placeholder="Password" required>
                </div>
                <hr class="mt-4 mb-4">
                <button type="submit" class="btn w-100 text-white rounded-4 fw-bold p-3"
                    style="background-color: #3B38A0;">Login</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
