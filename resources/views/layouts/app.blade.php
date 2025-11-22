<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"><script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <style>
        body {
            min-height: 100vh;
            overflow-x: hidden;
        }
        .sidebar {
            width: 250px;
            min-height: 100vh;
            transition: all 0.3s;
        }
        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: white;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -250px;
                top: 0;
                z-index: 999;
            }
            .sidebar.show {
                left: 0;
            }
            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                z-index: 998;
            }
            .overlay.show {
                display: block;
            }
            .marquee-offer{
                display: none !important;
            }
        }

        .marquee-offer {
            background: linear-gradient(135deg, #ff6a00, #ff3d3d);
            color: #fff;
            padding: 6px 20px;
            display: inline-block;
            font-weight: 700;
            border-radius: 5px;
            text-transform: uppercase;
            font-size: 15px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }

.marquee-offer::after {
    content: "";
    position: absolute;
    right: -15px;
    top: 0;
    border-top: 16px solid #ff3d3d;
    border-bottom: 16px solid #ff3d3d;
    border-left: 15px solid transparent;
}
    </style>
</head>
<body>
    <div class="d-flex">

    @include('components.sidebar')

    <div class="overlay" id="overlay"></div>
    <div class="flex-grow-1">
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-3">
    <button class="btn btn-primary d-md-none me-2" id="sidebarToggle"><i class="fa fa-bars"></i></button>

    <marquee behavior="scroll" direction="left" scrollamount="6">
        <span class="marquee-offer position-relative">
            FOOD COUPONS & OFFERS — UP TO 50% + ₹150 OFF — NOV 2025
        </span>
    </marquee>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fa fa-user-circle fa-lg"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a href="{{url('/logout')}}" class="dropdown-item">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
        <div id="content" class="p-4">
            @yield('content')
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.getElementById('overlay');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    </script>

    <script>

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>
</body>
</html>
