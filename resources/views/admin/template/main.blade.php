<!DOCTYPE html>
<html lang="en">
    <head>

        @include('admin.template.head')

    </head>
    <body class="sb-nav-fixed">
        @include('sweetalert::alert')

        @include('admin.template.nav')

        <div id="layoutSidenav">

            @include('admin.template.sidebar')

            <div id="layoutSidenav_content">

                @yield('content')

                @include('admin.template.footer')

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('admin/js/scripts.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('admin/assets/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('admin/assets/demo/chart-bar-demo.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('admin/js/datatables-simple-demo.js') }}"></script>

        <script>
            function confirmDelete(userId, what) {
                Swal.fire({
                    title: 'Hapus ' + what,
                    text: "Anda Yakin ingin menghapusnya ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + userId).submit();
                    }
                });
            }

            const input = document.getElementById("onlyNumber");

            input.addEventListener("input", function (e) {
                // Hapus karakter yang bukan angka
                this.value = this.value.replace(/[^0-9]/g, "");
            });

            @yield('js')
        </script>
    </body>
</html>
