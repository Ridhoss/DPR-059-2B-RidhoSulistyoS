<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin | Publikasi Gaji DPR</title>
    @vite(['resources/css/app.css'])

    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="containers">
        <div
            class="header w-full h-[10vh] bg-purple-400 flex items-center justify-between px-10 border-b-1 border-gray-300">
            <h2 class="text-white text-xl font-medium">Publikasi Gaji DPR</h2>
            <div class="flex h-full gap-8 items-center justify-center">
                <a id="btn-nav" class="text-white hover:font-bold transition-all duration-300"
                    href="/admin/home">Home</a>
                <a id="btn-nav" class="text-white hover:font-bold transition-all duration-300"
                    href="/admin/penggajian">Gaji Anggota</a>
                <a id="btn-nav" class="text-white hover:font-bold transition-all duration-300"
                    href="/admin/anggota">Anggota</a>
                <a id="btn-nav" class="text-white hover:font-bold transition-all duration-300"
                    href="/admin/komponen">Komponen Gaji</a>
                <a class="text-white hover:text-red-500 hover:cursor-pointer hover:font-bold transition-all duration-300"
                    id="btn-logout">Sign Out</a>
            </div>
        </div>

        <div class="content w-full h-[85vh] px-5 py-2 position-relative overflow-y-scroll">
            @yield('content')
        </div>

        <div
            class="footer w-full h-[5vh] bg-gray-100 text-black border-t-1 border-gray-500 flex items-center justify-center">
            <p class="m-0">&copy; <?= date('Y') ?> My Website</p>
        </div>
    </div>

    <script>
        btnLogout = document.getElementById('btn-logout');

        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const links = document.querySelectorAll('#btn-nav');

            links.forEach(link => {
                const linkPath = link.getAttribute('href');
                if (currentPath === linkPath || currentPath.startsWith(linkPath + '/')) {
                    link.classList.add('font-bold');
                }
            });
        });

        btnLogout.addEventListener('click', function() {
            Swal.fire({
                title: "Sign Out?",
                confirmButtonColor: "#d33",
                confirmButtonText: "Sign Out",
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("/logout", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .content,
                            "Content-Type": "application/json",
                        },
                    }).then(() => {
                        window.location.href = "/";
                    });
                }
            });
        });
    </script>

    @yield('script')

</body>

</html>
