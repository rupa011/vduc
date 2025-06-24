<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sign-up - {{ env('APP_NAME') }}</title>
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
                <div class="col-md-6 d-none d-md-block bg-primary text-white p-5">
                    <div class="h-100 d-flex flex-column justify-content-center text-center">
                        <img src="images/diving-1.jpg" class="img-fluid rounded mb-4" alt="promo">
                        <h4 class="mb-2 text-white">Discover Your World</h4>
                        <p class="small">Join our network and explore endless possibilities.</p>
                    </div>
                </div>
                <div class="col-md-6 p-5">
                    <div class="text-center mb-4">
                        <img src="images/logo1.png" alt="logo" class="mb-3" style="height: 50px;">
                        <h2 class="mb-1">Create Your Account</h2>
                        <p class="text-muted">Sign up to get started</p>
                    </div>
                    <form id="registerForm">
                        <input type="hidden" name="role" id="role">
                        <div id="container-message"></div>
                        <div class="form-group mb-3">
                            <label>First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control form-control-lg"
                                placeholder="Enter first name">
                        </div>
                        <div class="form-group mb-3">
                            <label>Middle Name</label>
                            <input type="text" name="middle_name" id="middle_name"
                                class="form-control form-control-lg" placeholder="Enter middle name (optional)">
                        </div>
                        <div class="form-group mb-3">
                            <label>Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control form-control-lg"
                                placeholder="Enter last name">
                        </div>
                        <div class="form-group mb-3">
                            <label>Extension Name</label>
                            <input type="text" name="extension_name" id="extension_name"
                                class="form-control form-control-lg" placeholder="Enter extension name (optional)">
                        </div>
                        <div class="form-group mb-3">
                            <label>Email Address</label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg"
                                placeholder="Enter email">
                        </div>
                        <div class="form-group mb-3">
                            <label>Password</label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg"
                                placeholder="Enter password">
                        </div>
                        <div class="form-group mb-3">
                            <label>Contact</label>
                            <input type="text" name="contact" id="contact" class="form-control form-control-lg"
                                placeholder="Enter contact number">
                        </div>
                        <button class="btn btn-primary w-100 mb-3" type="submit">Sign Up</button>
                        <p class="text-center text-muted">Already have an account? <a href="#">Sign in</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Role Selection Modal -->
    <div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roleModalLabel">Select Your Role</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-4">Please select the role you want to register for:</p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body text-center d-flex flex-column">
                                    <h5 class="card-title">Student</h5>
                                    <p class="card-text text-muted flex-grow-1">Register as a student to enroll in
                                        professional
                                        diving lessons.</p>
                                    <button class="btn btn-outline-primary w-100 select-role mt-auto"
                                        data-role="Student">Select</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body text-center d-flex flex-column">
                                    <h5 class="card-title">Survey Client</h5>
                                    <p class="card-text text-muted flex-grow-1">Register as a survey client for
                                        comprehensive
                                        vessel inspections.</p>
                                    <button class="btn btn-outline-primary w-100 select-role mt-auto"
                                        data-role="Survey Client">Select</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body text-center d-flex flex-column">
                                    <h5 class="card-title">Rental Client</h5>
                                    <p class="card-text text-muted flex-grow-1">Register as a rental client to access
                                        high-quality
                                        equipment rentals.</p>
                                    <button class="btn btn-outline-primary w-100 select-role mt-auto"
                                        data-role="Rental Client">Select</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submitRole">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

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

            $(document).on('click', '.select-role', function() {
                const selectedRole = $(this).data('role');
                $('#role').val(selectedRole);
                $('.select-role').removeClass('btn-primary').addClass('btn-outline-primary');
                $(this).removeClass('btn-outline-primary').addClass('btn-primary');
            });

            $('#registerForm').on('submit', function(e) {
                e.preventDefault();
                const isValid = $('#registerForm')[0].checkValidity();
                if (isValid) {
                    $('#roleModal').modal('show');
                } else {
                    $('#registerForm')[0].reportValidity();
                }
            });

            $('#submitRole').on('click', function() {
                const role = $('#role').val();
                const description = $('#description').val();
                $('#roleModal').modal('hide');

                $.ajax({
                    url: '{{ route('register') }}',
                    method: 'POST',
                    data: {
                        first_name: $('#first_name').val(),
                        middle_name: $('#middle_name').val(),
                        last_name: $('#last_name').val(),
                        extension_name: $('#extension_name').val(),
                        email: $('#email').val(),
                        password: $('#password').val(),
                        contact: $('#contact').val(),
                        role: role,
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            showContainerMessage(response.message, 'success');
                            window.location.href = response.redirect;
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON;
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
