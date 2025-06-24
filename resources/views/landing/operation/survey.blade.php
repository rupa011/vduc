@extends('landing.master')

@section('content')
    <!-- HERO SECTION -->
    <div class="site-hero_2">
        <div class="page-title">
            <div class="big-title montserrat-text uppercase">underwater survey</div>
            <div class="small-title montserrat-text uppercase">home / operation / survey</div>
        </div>
    </div>

    <section>
        <div class="container">
            <div class="section-title" style="margin: auto">
                <span>survey project</span>
                <p>
                    Reliable and detailed underwater inspections conducted by certified professionals.
                    Perfect for marine assessments, hull checks, and structural evaluations—ensuring safety and accuracy beneath the surface.
                </p>
            </div>

            <!-- Survey Image Gallery -->
            <div class="small-title montserrat-text uppercase text-center"
                 style="background-color: #64c9d8; color: #ffffff; border-radius: 5px; font-weight: 700; padding: 12px 20px; font-size: 1.2rem; margin: 30px;">
                Our Recent Projects
            </div>

            <div class="row">
                <div class="col-md-12 text-center" style="margin-bottom: 40px;">
                    <img src="{{ asset('images/pier3.jpg') }}" alt="Underwater survey at Lipata Port" class="img-responsive"
                         style="width: 100%; max-width: 700px; height: auto; border-radius: 5px; display: block; margin: 0 auto; margin-bottom: 20px;">
                </div>
            </div>

            <!-- Survey Description -->
            <div class="row">
                <div class="col-md-12 wow fadeInUp">
                    <p style="text-indent: 30px;">
                        On March 9, 2017, an underwater survey was conducted in Lipata,
                        Surigao to assess the condition of the port’s submerged structures.
                        The inspection focused on critical areas such as pier foundations,
                        support piles, and the surrounding seabed. Using modern diving equipment and
                        underwater imaging technology, the team documented the structural integrity and
                        identified any potential issues such as corrosion, marine growth, or damage caused by
                        constant exposure to tidal forces.
                    </p>
                    <p style="text-indent: 30px; margin-bottom: 75px;">
                        The results of the survey offered valuable insights for maintenance planning and
                        infrastructure improvement. By addressing potential risks early, the survey helped
                        ensure the long-term safety and reliability of Lipata Port operations. As one of
                        the key maritime gateways in Surigao, regular underwater assessments like this contribute
                        significantly to safe navigation,
                        efficient logistics, and the continued support of regional economic activities.
                    </p>
                </div>
            </div>

            <!-- Image Gallery -->
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4 text-center" style="margin-bottom: 30px;">
                    <div style="position: relative; overflow: hidden; border-radius: 5px;">
                        <img src="{{ asset('images/pier4.jpg') }}" alt="Pier foundation survey"
                             style="width: 100%; height: 250px; object-fit: cover; transition: transform 0.3s;">
                        <div
                            style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0, 0, 0, 0.6); color: #fff; padding: 10px; opacity: 0; transition: opacity 0.3s;">
                            Pier Foundation Analysis
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4 text-center" style="margin-bottom: 30px;">
                    <div style="position: relative; overflow: hidden; border-radius: 5px;">
                        <img src="{{ asset('images/pier.jpg') }}" alt="Seabed inspection"
                             style="width: 100%; height: 250px; object-fit: cover; transition: transform 0.3s;">
                        <div
                            style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0, 0, 0, 0.6); color: #fff; padding: 10px; opacity: 0; transition: opacity 0.3s;">
                            Seabed Condition Assessment
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4 text-center" style="margin-bottom: 30px;">
                    <div style="position: relative; overflow: hidden; border-radius: 5px;">
                        <img src="{{ asset('images/pier2.jpg') }}" alt="Support pile survey"
                             style="width: 100%; height: 250px; object-fit: cover; transition: transform 0.3s;">
                        <div
                            style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0, 0, 0, 0.6); color: #fff; padding: 10px; opacity: 0; transition: opacity 0.3s;">
                            Support Pile Integrity Check
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Clients -->

         <div class="container" style="border-top: 2px solid #000000; border-radius: 5px; margin-top: 50px;">
                <div class="section-title" style="margin-bottom: 20px;">
                    <h3 class="montserrat-text uppercase" style="color: #000000; font-size: 1.5rem; text-align: center;">Trusted by Leading Maritime Partners</h3>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 wow fadeInUp" data-wow-delay=".7s">
                        <div class="team_member" style="position: relative; background-color: #f8f9fa; border-radius: 5px;
                        height: 200px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                            <img src="/images/philharbor.png" alt="team image" style="width: 100%; height: 100%; object-fit: contain;"  >
                            <div class="team_member_hover">
                                <div class="team_member_info">
                                    <div class="team_member_name">philharbor ferries and port services inc</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 wow fadeInUp" data-wow-delay=".7s">
                        <div class="team_member" style="position: relative;background-color: #f8f9fa7c; border-radius: 5px;
                        height: 200px; display:flex; align-items: center; justify-content: center;">
                            <img src="/images/archi.jpg" alt="team image" style="width: 100%; height: 100%; object-fit: contain;"  >
                            <div class="team_member_hover">
                                <div class="team_member_info">
                                    <div class="team_member_name">archipelago philippine ferries inc</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 wow fadeInUp" data-wow-delay=".7s">
                        <div class="team_member" style="position: relative;background-color: #f8f9fa7c; border-radius: 5px;
                        height: 200px; display:flex; align-items: center; justify-content: center;">
                            <img src="/images/penta.jpg" alt="team image" style="width: 100%; height: 100%; object-fit: contain;"  >
                            <div class="team_member_hover">
                                <div class="team_member_info">
                                    <div class="team_member_name">penta maritime corporation</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 wow fadeInUp" data-wow-delay=".7s">
                        <div class="team_member" style="position: relative;background-color: #f8f9fa7c; border-radius: 5px;
                        height: 200px; display:flex; align-items: center; justify-content: center;">
                            <img src="/images/santiago.jpg" alt="team image" style="width: 100%; height: 100%; object-fit: contain;"  >
                            <div class="team_member_hover">
                                <div class="team_member_info">
                                    <div class="team_member_name">Santiago Shipyard & Shipbuilding Corporation</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

            <div style="text-align: right;">
                <a href="/sign-in" class="btn"
                   style="margin-top:30px; width:200px; background-color:#64c9d8; color:#ffffff; border-radius:5px;">
                    <span>Get Started</span>
                </a>
            </div>

    </section>

    <div class="container" style="width: 80%;">
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0 10px; margin-top: 50px;">
            <!-- Left Arrow Button -->
            <a href="{{ url('/operation_lesson') }}" title="Previous"
               style="display: inline-flex; align-items: center; justify-content: center;
                    width: 50px; height: 50px; border-radius: 50%;
                    background-color: #64c9d8; color: white; text-decoration: none;
                    font-size: 24px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                <i class="icon ion-arrow-left-c"></i>
            </a>
            <!-- Right Arrow Button -->
            <a href="{{ url('/operation_rental') }}" title="Next"
               style="display: inline-flex; align-items: center; justify-content: center;
                    width: 50px; height: 50px; border-radius: 50%;
                    background-color: #64c9d8; color: white; text-decoration: none;
                    font-size: 24px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                <i class="icon ion-arrow-right-c"></i>
            </a>
        </div>
    </div>
@endsection

