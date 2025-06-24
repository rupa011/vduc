@extends('landing.master')

@section('content')
    <!-- HERO SECTION  -->
    <div class="site-hero_2">
        <div class="page-title">
            <div class="big-title montserrat-text uppercase">our services</div>
            <div class="small-title montserrat-text uppercase">home / services</div>
        </div>
    </div>

    <!-- WHAT WE DO -->
    <section>
        <div class="container">
            <div class="row">
                <div class="section-title">
                    <span>what we do</span>
                    <p>Trusted underwater experts delivering reliable, professional solutions tailored to your maritime
                        projects.

                        Get in touch today and experience the difference!</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-15 wow fadeInUp">


                    <div class="col-md-6 wow fadeInUp" data-wow-delay=".1s">
                        <img src="/images/underwaterdive.jpg" alt="Underwater diving"
                            style="width: 100%; max-width: 500px; height: auto; display: block; margin: 0 auto; border-radius: 10px;">
                    </div>
                    
                    <div>
                        <div class="col-md-6">
                            <ul class="list">
                                <li>Underwater surveys and inspections</li>
                                <li>Welding and emergency repairs</li>
                                <li>Hull cleaning and thickness gauging</li>
                                <li>Underwater photography and video documentation</li>
                                <li>SCUBA equipment rental</li>
                                <li>Diving lessons</li>
                                <li>and many more</li>
                            </ul>

                            <a href="/operation_survey" class="btn green" style="margin-top:30px; max-width:150px;">
                                <span>check us out</span>
                            </a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <section class="pricing_plans">
        <div class="container">
            <div class="row">
                <div class="section-title">
                    <span>services</span>
                    <p>At Visayan Divers, we are committed to delivering reliable and professional underwater
                        and marine solutions that meet the needs of various industries. With a team of skilled divers and
                        advanced equipment,
                        we ensure high-quality, safe, and efficient operations at all times. To address the growing demands
                        of the maritime sector, we offer the following:</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12 wow fadeInUp">
                    <div class="pricing_plan">
                        <div class="plan_title montserrat-text uppercase">
                            <i class="icon ion-ios-checkmark"></i>
                            <span>underwater services</span>
                        </div>
                        <ul class="list">
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Consectetuer adipiscing elit</li>
                            <li>Sed diam nonummy</li>
                            <li>Nibh euismod tincidunt</li>
                            <li>Ut laoreet dolore</li>
                            <li>Magna aliquam erat volutpat</li>
                        </ul>
                        <a href="/operation_survey" class="btn green"><span>get started</span></a>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-delay=".1s">
                    <div class="pricing_plan">
                        <div class="plan_title montserrat-text uppercase">
                            <i class="icon ion-ios-briefcase"></i>
                            <span>rental</span>
                        </div>
                        <ul class="list">
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Consectetuer adipiscing elit</li>
                            <li>Sed diam nonummy</li>
                            <li>Nibh euismod tincidunt</li>
                            <li>Ut laoreet dolore</li>
                            <li>Magna aliquam erat volutpat</li>
                        </ul>
                        <a href="/operation_rental" class="btn green"><span>get started</span></a>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-delay=".2s">
                    <div class="pricing_plan">
                        <div class="plan_title montserrat-text uppercase">
                            <i class="icon ion-ios-navigate"></i>
                            <span>diving lesson</span>
                        </div>
                        <ul class="list">
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Consectetuer adipiscing elit</li>
                            <li>Sed diam nonummy</li>
                            <li>Nibh euismod tincidunt</li>
                            <li>Ut laoreet dolore</li>
                            <li>Magna aliquam erat volutpat</li>
                        </ul>
                        <a href="/operation_lesson" class="btn green"><span>get started</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-10 wow fadeInUp">
                    <div class="benefits_1_single">
                        <i class="icon ion-ios-people"></i>
                        <div class="title montserrat-text uppercase">experienced team</div>
                        <p>
                            Our team is composed of trained professionals committed to delivering reliable, high-quality
                            underwater solutions.
                        </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-10 wow fadeInUp" data-wow-delay=".1s">
                    <div class="benefits_1_single">
                        <i class="icon ion-ios-checkmark"></i>
                        <div class="title montserrat-text uppercase">proven reliability</div>
                        <p>
                            With a strong track record and satisfied clients, we’ve earned a reputation for dependability
                            and excellence.
                        </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-10 wow fadeInUp" data-wow-delay=".2s">
                    <div class="benefits_1_single">
                        <i class="icon ion-ios-body"></i>
                        <div class="title montserrat-text uppercase">safety focused</div>
                        <p>
                            We prioritize safety in every operation, following strict protocols to protect our team,
                            clients, and environment.
                        </p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-10 wow fadeInUp" data-wow-delay=".3s">
                    <div class="benefits_1_single">
                        <i class="icon ion-ios-star-outline"></i>
                        <div class="title montserrat-text uppercase">quality service</div>
                        <p>
                            We are dedicated to providing professional service and lasting value, tailored to meet your
                            unique needs.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
