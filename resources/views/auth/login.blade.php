<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link 
        rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        />


    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <title>Login</title>
</head>
<body class="bg-light justify-content-center d-flex align-items-center vh-100">
    <div class="container rounded-5 d-flex flex-column align-items-center w-25 mx-auto p-5 bg-light shadow-lg bg-opacity-25" >
        <i class="fa-solid fa-user fa-5x" style="color: #3B38A0;"></i>
            <form></form>
            <form action="{{ route('login.process') }}" method="POST" class="mb-5 mt-5 w-100 h-auto">
                @csrf
                @error('username')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="mb-3">
                    <input type="text" class="form-control-lg form-control rounded-4 p-3" id="username" name="username" placeholder="username" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control-lg form-control rounded-4 p-3" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn mb-3 mt-3 p-3 w-100 text-white rounded-5" style="background-color: #3B38A0"><b>Login</b></button>
            </form>
    </div>
</body>
</html>
