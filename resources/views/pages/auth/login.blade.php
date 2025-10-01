<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ETS</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
        :root {
            --primary-color: #73C8D2;
            --secondary-color: #8FA31E;
            --third-color: #C6D870;
            --fourth-color: #F5F1DC;
        }

        * {
            margin: 0;
            padding: 0;
        }

        .containers {
            width: 100%;
            height: 100vh;
            background-color: var(--fourth-color);
        }

        .box-login {
            width: 30%;
            gap: 10px;
            background-color: var(--primary-color);
            padding: 1% 2%;
            border-radius: 20px;
        }
    </style>
</head>

<body>
    <div class="containers d-flex align-items-center justify-content-center">
        <div class="box-login d-flex align-items-center justify-content-center flex-column">
            <h2 class="text-white mb-3 text-center">Publikasi Gaji DPR</h2>
            <form action="/login" method="POST"
                class="w-100 d-flex align-items-center justify-content-center flex-column gap-2">
                @csrf
                <div class="w-100">
                    <label for="username" class="form-label fw-bold text-white">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
                <div class="w-100">
                    <label for="password" class="form-label fw-bold text-white">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary mt-3 w-100">Sign In</button>
            </form>
            {{-- <p class="mt-2 text-white">Doesn't have a account? <a href="/register">Sign Up</a></p> --}}
        </div>
    </div>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

</body>

</html>
