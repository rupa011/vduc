<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sign-in - {{ env('APP_NAME') }}</title>
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
    <style>
        .sign-in-page {
            background: linear-gradient(to right, #f5f7fa, #c3cfe2);
        }

        .form-control {
            border-radius: 8px;
            box-shadow: none;
            transition: 0.3s ease;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
            border-radius: 6px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>

<body>
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Sign in Start -->


    <section class="sign-up-page d-flex align-items-center min-vh-100 bg-light">


        <div class="container">

            <div class="row justify-content-center shadow rounded bg-white overflow-hidden">

                <div class="col-md-6 p-5">
                    <a href="{{ url('/') }}" class="back-button" aria-label="Back to homepage">
                        <i class="icon ion-arrow-left-c"></i>
                    </a>

                    <div class="text-center mb-4">
                        <img src="images/logo1.png" alt="logo" class="mb-3" style="height: 50px;">
                        <h2 class="mb-1">Welcome Back</h2>
                        <p class="text-muted">Please sign in to your account</p>
                    </div>
                    <form id="loginForm">
                        <div id="container-message"></div>
                        <div class="form-group mb-3">
                            <label>Email address</label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg"
                                placeholder="Enter email">
                        </div>
                        <div class="form-group mb-3">
                            <label>Password <a href="#"
                                    class="float-end small text-decoration-none">Forgot?</a></label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg"
                                placeholder="Password">
                        </div>
                        <div class="form-check mb-4">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <button class="btn btn-primary w-100 mb-3" type="submit">Sign In</button>
                        <p class="text-center text-muted">Don't have an account? <a href="{{ route('signup') }}">Sign
                                up</a></p>
                    </form>
                </div>
                <div class="col-md-6 d-none d-md-block bg-primary text-white p-5">
                    <div class="h-100 d-flex flex-column justify-content-center text-center">
                        <img src="images/diving-1.jpg" class="img-fluid rounded mb-4" alt="promo">
                        <h4 class="mb-2 text-white">Discover Your World</h4>
                        <p class="small">Join our network and explore endless possibilities.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sign in END -->

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
    <script>
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

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#loginForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route('login') }}',
                    method: 'POST',
                    data: {
                        email: $('#email').val(),
                        password: $('#password').val(),
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            showContainerMessage(response.message, 'success');
                            window.location.href = response.redirect;
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON;
                        let errorMsg = response.message;

                        if (response.errors) {
                            errorMsg = Object.values(response.errors).join('\n');
                        }
                        showContainerMessage(response.message ||
                            errorMsg,
                            'error');
                    }
                });
            });
        });
    </script>
</body>

</html>
