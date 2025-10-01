<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Domastic</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
        :root {
            --primary-color: #556B2F;
            --secondary-color: #8FA31E;
            --third-color: #C6D870;
            --fourth-color: #EFF5D2;
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
            background-color: var(--third-color);
            padding: 1% 2%;
            border-radius: 20px;
        }
    </style>
</head>

<body>
    <div class="containers d-flex align-items-center justify-content-center">
        <div class="box-login d-flex align-items-center justify-content-center flex-column">
            <h2 class="text-white mb-3">Create Your Account.</h2>
            <form action="/register" method="POST"
                class="w-100 d-flex align-items-center justify-content-center flex-column gap-2">
                <?= csrf_field() ?>
                <div class="w-100">
                    <label for="username" class="form-label fw-bold text-white">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
                <div class="w-100">
                    <label for="password" class="form-label fw-bold text-white">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="w-100">
                    <label for="confirm-password" class="form-label fw-bold text-white">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm-password" name="confirm_password"
                        placeholder="Confirm Your Password">
                </div>
                <button type="submit" class="btn btn-success mt-3 w-100">Sign Up</button>
            </form>
            <p class="mt-2 text-white">Already have a account? <a href="/">Sign In</a></p>
        </div>
    </div>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

</body>

</html>
