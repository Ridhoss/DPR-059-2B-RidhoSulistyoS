<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | Publikasi Gaji DPR</title>

    @vite(['resources/css/app.css'])
</head>

<body>
    <div class="flex h-screen w-screen">
        <div class="left-container bg-purple-400 w-[60%] h-full flex items-center justify-center">
            <img src="assets/img/login-img.svg" alt="login-img" class="w-[60%] h-auto">
        </div>
        <div class="right-container bg-white w-[40%] h-full flex items-center justify-center">
            <div class="w-[80%] border-2 border-gray-300 bg-white shadow-xl p-5 rounded-lg">
                <h2 class="text-center text-3xl font-medium">Publikasi Gaji DPR</h2>
                <form action="/login" method="POST" class="mt-5">
                    @csrf
                    <div class="flex flex-col mt-3">
                        <label for="username" class="">Username</label>
                        <input type="text" class="border border-gray-500 h-10 rounded-lg ps-2 mt-2" id="username" name="username" placeholder="Username">
                    </div>
                    <div class="flex flex-col mt-3">
                        <label for="password" class="">Password</label>
                        <input type="password" class="border border-gray-500 h-10 rounded-lg ps-2 mt-2" id="password" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="w-full h-10 mt-8 rounded-lg bg-purple-600 hover:bg-purple-400 text-white">Sign In</button>
                </form>
                <p class="text-sm text-center mt-5">Doesn't have a account? <a href="#" class="text-purple-800 hover:text-purple-500">Sign Up</a></p>
            </div>
        </div>
    </div>
</body>

</html>
