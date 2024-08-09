<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<!-- DataTable -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<!-- End DataTable -->
<!-- 
<script>
    new DataTable('#example');
</script> -->

<script>
    new DataTable('#example', {
        paging: true, // Aktifkan paging (default: true)
        pageLength: 5, // Jumlah entri per halaman (default: 10)
        lengthMenu: [5, 10, 25, 50, 100] // Pilihan jumlah entri per halaman
    });
    new DataTable('#example_out', {
        paging: true, // Aktifkan paging (default: true)
        pageLength: 5, // Jumlah entri per halaman (default: 10)
        lengthMenu: [5, 10, 25, 50, 100] // Pilihan jumlah entri per halaman
    });
    new DataTable('#example2', {
        paging: true, // Aktifkan paging (default: true)
        pageLength: 5, // Jumlah entri per halaman (default: 10)
        lengthMenu: [5, 10, 25, 50, 100] // Pilihan jumlah entri per halaman
    });

    new DataTable('#example3', {
        paging: true, // Aktifkan paging (default: true)
        pageLength: 5, // Jumlah entri per halaman (default: 10)
        lengthMenu: [5, 10, 25, 50, 100] // Pilihan jumlah entri per halaman
    });
    new DataTable('#exampleUser', {
        paging: true, // Aktifkan paging (default: true)
        pageLength: 5, // Jumlah entri per halaman (default: 10)
        lengthMenu: [5, 10, 25, 50, 100] // Pilihan jumlah entri per halaman
    });
    new DataTable('#exampleUser2', {
        paging: true, // Aktifkan paging (default: true)
        pageLength: 5, // Jumlah entri per halaman (default: 10)
        lengthMenu: [5, 10, 25, 50, 100] // Pilihan jumlah entri per halaman
    });
    new DataTable('#exampleTf', {
        paging: true, // Aktifkan paging (default: true)
        pageLength: 5, // Jumlah entri per halaman (default: 10)
        lengthMenu: [5, 10, 25, 50, 100] // Pilihan jumlah entri per halaman
    });
    // new DataTable('#exampleTf2', {
    //     paging: true, // Aktifkan paging (default: true)
    //     pageLength: 5, // Jumlah entri per halaman (default: 10)
    //     lengthMenu: [5, 10, 25, 50, 100] // Pilihan jumlah entri per halaman
    // });
    // new DataTable('#exampleTf3', {
    //     paging: true, // Aktifkan paging (default: true)
    //     pageLength: 5, // Jumlah entri per halaman (default: 10)
    //     lengthMenu: [5, 10, 25, 50, 100] // Pilihan jumlah entri per halaman
    // });
    new DataTable('#users1', {
        paging: true, // Aktifkan paging (default: true)
        pageLength: 5, // Jumlah entri per halaman (default: 10)
        lengthMenu: [5, 10, 25, 50, 100] // Pilihan jumlah entri per halaman
    });
    new DataTable('#users2', {
        paging: true, // Aktifkan paging (default: true)
        pageLength: 5, // Jumlah entri per halaman (default: 10)
        lengthMenu: [5, 10, 25, 50, 100] // Pilihan jumlah entri per halaman
    });
    new DataTable('#users3', {
        paging: true, // Aktifkan paging (default: true)
        pageLength: 5, // Jumlah entri per halaman (default: 10)
        lengthMenu: [5, 10, 25, 50, 100] // Pilihan jumlah entri per halaman
    });
    new DataTable('#users4', {
        paging: true, // Aktifkan paging (default: true)
        pageLength: 5, // Jumlah entri per halaman (default: 10)
        lengthMenu: [5, 10, 25, 50, 100] // Pilihan jumlah entri per halaman
    });
</script>


<!-- <script src="/js/script.js"></script> -->


<script>
    $(document).ready(function() {
        $('.toggle-btn').click(function() {
            $('#sidebar').toggleClass('expand');
            $('.nav-custom').fadeToggle(300); // Use fadeToggle() for fade in/out effect
            $('.navbar-dropdown').collapse('hide');
            $('.adm-custom').toggleClass('d-none');

            // Gunakan setTimeout untuk menunggu sebelum menambah atau menghapus kelas 'text-center'
            setTimeout(function() {

            }, 250); // Waktu penundaan dalam milidetik
        });


        $(document).on('mouseenter mouseleave', '#sidebar.expand', function() {
            $('.nav-custom').fadeToggle(300); // Menampilkan atau menyembunyikan elemen dengan kelas .nav-custom saat hover pada #sidebar.expand
            $('.navbar-dropdown').collapse('hide');
            // $('.navbar-dropdown').collapse('toggle');
            $('.adm-custom').toggleClass('d-none');

        });

        $(document).on('mouseenter mouseleave', 'ul li', function() {



        });

    });
</script>


<!-- Script Js Expand -->
<script>
    const fullscreenButton = document.getElementById('fullscreen-button');
    fullscreenButton.addEventListener('click', () => {
        toggleFullscreen();
    });

    function toggleFullscreen() {
        // Mengecek jika dokumen tidak dalam mode fullscreen
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen(); // Meminta elemen utama dokumen masuk ke mode fullscreen
        } else {
            // Keluar dari mode fullscreen jika sudah dalam mode fullscreen
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
        }
    }
</script>

</body>

</html>