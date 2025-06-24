<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('APP-NAME') VDUC {{ env('APP_NAME') }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/logo1.png') }}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{ asset('css/typography.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        /* Remove underlines from links and list items */
        a,
        .list li {
            text-decoration: none !important;
        }

        /* Ensure modal content doesn't inherit unwanted underlines */
        .modal-content,
        .modal-content * {
            text-decoration: none !important;
        }
    </style>

    @yield('APP-CSS')

</head>

<body class="sidebar-main-active right-column-fixed">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Sidebar  -->
        <div class="iq-sidebar">
            <div class="iq-navbar-logo d-flex justify-content-between">
                <a href="index.html" class="header-logo">
                    <img src="{{ asset('images/logo1.png') }}" class="img-fluid rounded" alt="">
                    <span>VDUC</span>
                </a>
                <div class="iq-menu-bt align-self-center">
                    <div class="wrapper-menu">
                        <div class="main-circle"><i class="ri-menu-line"></i></div>
                        <div class="hover-circle"><i class="ri-close-fill"></i></div>
                    </div>
                </div>
            </div>
            <div id="sidebar-scrollbar">
                @if (auth()->user()->role === 'Admin')
                    @include('admin.sidebar')
                @elseif(auth()->user()->role === 'Employee')
                    @include('employee.sidebar')
                @elseif(auth()->user()->role === 'Survey Client')
                    @include('survey.sidebar')
                @elseif(auth()->user()->role === 'Student')
                    @include('student.sidebar')
                @elseif(auth()->user()->role === 'Rental Client')
                    @include('rental.sidebar')
                @endif
            </div>
        </div>
        <!-- TOP Nav Bar -->
        @include('layouts.topbar')
        <!-- TOP Nav Bar END -->

        <!-- Page Content  -->
        <div id="content-page" class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12" id="container-message"></div>
                    <div class="col-lg-12">
                        @yield('APP-CONTENT')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wrapper END -->
    <!-- Footer -->
    <footer class="iq-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                        <li class="list-inline-item"><a href="#">Terms of Use</a></li>
                    </ul>
                </div>
                <div class="col-lg-6 text-right">
                    Copyright @php echo date('Y') @endphp <a href="#">{{ env('APP_NAME') }}</a> All Rights Reserved.
                </div>
            </div>
        </div>
    </footer>

    @include('rental.terms')
    @include('student.terms')
    @include('survey.terms')

    <!-- Footer END -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Appear JavaScript -->
    <script src="{{ asset('js/jquery.appear.js') }}"></script>
    <!-- Countdown JavaScript -->
    <script src="{{ asset('js/countdown.min.js') }}"></script>
    <!-- Counterup JavaScript -->
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <!-- Wow JavaScript -->
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <!-- Apexcharts JavaScript -->
    <script src="{{ asset('js/apexcharts.js') }}"></script>
    <!-- Slick JavaScript -->
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <!-- Select2 JavaScript -->
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <!-- Owl Carousel JavaScript -->
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <!-- Magnific Popup JavaScript -->
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Smooth Scrollbar JavaScript -->
    <script src="{{ asset('js/smooth-scrollbar.js') }}"></script>
    <!-- lottie JavaScript -->
    <script src="{{ asset('js/lottie.js') }}"></script>
    <!-- am core JavaScript -->
    <script src="{{ asset('js/core.js') }}"></script>
    <!-- am charts JavaScript -->
    <script src="{{ asset('js/charts.js') }}"></script>
    <!-- am animated JavaScript -->
    <script src="{{ asset('js/animated.js') }}"></script>
    <!-- am kelly JavaScript -->
    <script src="{{ asset('js/kelly.js') }}"></script>
    <!-- am maps JavaScript -->
    <script src="{{ asset('js/maps.js') }}"></script>
    <!-- am worldLow JavaScript -->
    <script src="{{ asset('js/worldLow.js') }}"></script>
    <!-- Style Customizer -->
    <script src="{{ asset('js/style-customizer.js') }}"></script>
    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('js/chart-custom.js') }}"></script>
    <!-- Custom JavaScript -->
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.5.3/js/fileinput.min.js"></script>

    <script type="text/javascript">
        const types = {
            success: {
                bg: 'bg-success',
                icon: '<i class="ri-alert-line"></i>'
            },
            error: {
                bg: 'bg-danger',
                icon: '<i class="ri-information-line"></i>'
            },
            warning: {
                bg: 'bg-warning',
                icon: '<i class="ri-alert-line"></i>'
            },
            primary: {
                bg: 'bg-primary',
                icon: '<i class="ri-alert-line"></i>'
            }
        };

        function showContainerMessage(message, type = 'primary') {

            const {
                bg,
                icon
            } = types[type] || types.primary;

            const container = $('#container-message');

            container.html(`
                <div class="alert text-white ${bg}" role="alert">
                    <div class="iq-alert-icon">${icon}</div>
                    <div class="iq-alert-text">${message}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ri-close-line"></i>
                    </button>
                </div>`).show();

            $('html, body').animate({
                scrollTop: 0
            }, 'slow');

            setTimeout(() => container.fadeOut(), 5000);
        }

        function showModalMessage(message, type = 'primary') {

            const {
                bg,
                icon
            } = types[type] || types.primary;

            const container = $('#modal-message');

            container.html(`
                <div class="alert text-white ${bg}" role="alert">
                    <div class="iq-alert-icon">${icon}</div>
                    <div class="iq-alert-text">${message}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ri-close-line"></i>
                    </button>
                </div>`).show();

            $('html, body').animate({
                scrollTop: 0
            }, 'slow');

            setTimeout(() => container.fadeOut(), 5000);
        }

        function setModalMessage(modal, messageId = 'modal-message', messageClass = '', messageContent = '') {
            const modalBody = modal.find('.modal-body');
            modalBody.find(`#${messageId}`).remove();
            modalBody.prepend(`<div id="${messageId}" class="${messageClass}">${messageContent}</div>`);
        }

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#table').DataTable({
                paging: true,
                searching: true,
                info: true,
                "order": [],
            });
        });
    </script>
    @yield('APP-SCRIPT')
</body>

</html>
