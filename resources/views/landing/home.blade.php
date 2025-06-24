@extends('landing.master')

@section('content')
    <!-- HERO SECTION  -->
    <div class="site-hero">
        <ul class="slides">
            <li>
                <div><span class="small-title uppercase montserrat-text">we're</span></div>
                <div class="big-title uppercase montserrat-text">Visayan Diver Underwater Construction Inc.</div>
                <p>We are a trusted provider of professional underwater construction,
                    inspection, and maintenance services, serving clients across the Visayas and beyond with safety,
                    precision, and expertise.</p>
            </li>

            <li>
                <div><span class="small-title uppercase montserrat-text">we offer</span></div>
                <div class="big-title uppercase montserrat-text">Survey Vessel Services</div>
                <p>Our survey vessel services support marine engineering and underwater operations by
                    delivering accurate hydrographic data and site assessments using advanced sonar
                    and navigation equipment.</p>
            </li>

            <li>
                <div><span class="small-title uppercase montserrat-text">we offer</span></div>
                <div class="big-title uppercase montserrat-text">Underwater Equipment Rental</div>
                <p>We provide high-quality underwater equipment rentals, including diving gear,
                    hydraulic tools, and remotely operated vehicles (ROVs),
                    ideal for various underwater construction and inspection needs.</p>
            </li>

            <li>
                <div><span class="small-title uppercase montserrat-text">we offer</span></div>
                <div class="big-title uppercase montserrat-text">Diving Lessons</div>
                <p>Our certified diving instructors offer comprehensive training programs
                    for recreational and commercial diving, ensuring students are well-prepared
                    for safe and effective underwater operations.</p>
            </li>

        </ul>
    </div>

    <!-- HISTORY OF AGENCY -->
    <div class="container">
        <div class="agency">
            <div class="col-md-5 col-sm-12">
                <div class="row">
                    <img src="assets/img/vducidivers.jpg" alt="image">
                </div>
            </div>
            <div class="col-md-offset-1 col-md-6 col-sm-12">
                <div class="row">
                    <div class="section-title">
                        <span>history of VDUCI</span>
                    </div>
                    <p class="about_text" style="text-indent: 50px;">
                        VISAYAN DIVERS UNDERWATER CONTRACTOR, INC (VDUCI)
                        was established in October 2015 and register marine engineering
                        and registered under the SECURITY AND EXCHANGE COMMISSION (SEC)
                        in providing expertise in marine engineering diving services an
                        underwastor survel/inspection and maintenance. Although newly founded,
                        the technical proficiency of VDUCI is based on the experience and skills of its managers, divers and
                        employees.
                    </p>
                    <a href="/about" class="btn green" style="float:right;margin-top:30px"><span>read more</span></a>
                </div>
            </div>
        </div>
    </div>


    <!-- WHY CHOOSE US -->
    <section class="services">
        <div class="container">
            <div class="row">
                <div class="section-title">
                    <span>why choose us</span>
                    <p>We deliver reliable underwater construction and diving services with expertise,
                        safety, and precision—trusted by clients across the Visayas region.</p>
                </div>
            </div>

            <div class="col-md-7 col-sm-12 services-left wow fadeInUp">
                <div class="row" style="margin-bottom:50px">
                    <div class="col-md-6 col-sm-12">
                        <div class="row">
                            <i class="icon ion-ios-briefcase"></i>
                            <span class="montserrat-text uppercase service-title"> Experience You Can Trust</span>
                            <p>With years of hands-on expertise in underwater construction, we deliver safe,
                                efficient, and professional results—every time.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="row">
                            <i class="icon ion-ios-star"></i>
                            <span class="montserrat-text uppercase service-title">Committed to Quality</span>
                            <p>We use top-grade equipment and trained divers to ensure every project
                                meets the highest industry standards.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="row">
                            <i class="icon ion-ios-people"></i>
                            <span class="montserrat-text uppercase service-title">Customer-First Approach</span>
                            <p>Your satisfaction is our priority. We work closely with clients to deliver
                                tailored solutions on time and within budget.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="row">
                            <i class="icon ion-ios-cog"></i>
                            <span class="montserrat-text uppercase service-title"> Full-Service Capability</span>
                            <p>From underwater surveys to diving lessons, we provide complete
                                marine services under one trusted name.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5 col-sm-12 services-right wow fadeInUp" data-wow-delay=".1s"
                style="margin-top:75px;
             box-shadow:0 4px 10px rgba(0,0,0,0.1); border: 2px solid rgba(30, 28, 28, 0.53);">

                <div class="row">
                    <img src="assets/img/preap.jpg" alt="image">
                </div>
            </div>

        </div>
    </section>


@endsection
