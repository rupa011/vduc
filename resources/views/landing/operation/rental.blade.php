@extends('landing.master')

@section('content')
    <!-- HERO SECTION  -->
    <div class="site-hero_2">
        <div class="page-title">
            <div class="big-title montserrat-text uppercase">Rent</div>
            <div class="small-title montserrat-text uppercase">home / operation/ rent</div>
        </div>
    </div>

    <!-- PORTFOLIO -->
    <section class="portfolio">
        <div class="container">
         <div class="row">
                <div class="section-title">
                    <span>Overview</span>
                     <div style="border-top: 2px solid #000000; border-radius: 5px; margin-top: 0;">

                    <p>We offer high-quality diving gear for rent,
                        suitable for certified and experienced divers only.
                        Our rental service is designed to ensure safety, reliability, and responsible use of equipment.</p>

                        <h3 class="montserrat-text uppercase"
                        style="color: #000000; font-size: 1.5rem; text-align: left; margin-top: 30px;">Requirements:</h3>

                            <ul class="list" style="text-align: left">
                                <li> Must be a certified professional diver</li>
                                <li> A valid diving license is required upon bookingt</li>
                                <li> Valid ID for verification</li>
                                <li> Rental service is primarily for clients based in Leyte</li>
                                <li> Additional service fees apply for rentals outside Leyte province</li>
                            </ul>

                            <h3 class="montserrat-text uppercase"
                            style="color: #000000; font-size: 1.5rem; text-align: left; margin-top: 30px;">Policies:</h3>

                            <ul class="list" style="text-align: left">
                                <li> Late returns will incur a daily penalty fee</li>
                                <li> Equipment must be returned in the same condition it was borrowed</li>
                                <li> Damaged or lost items will be charged accordingly based on assessed repair or replacement cost</li>
                            </ul>

                            <h3 class="montserrat-text uppercase"
                            style="color: #000000; font-size: 1.5rem; text-align: left; margin-top: 30px;">How It Works:</h3>

                            <p>Clients can reserve equipment online or in person.
                                Upon verification, gear will be released on the scheduled date.
                                A checklist will be provided during pickup and reviewed upon return to ensure all
                                items are accounted for and in proper condition.</p>
                            </div>
                    </div>
                </div>
    </section>


<section class="portfolio" style="margin-top: 0px;">
        <div class="container">
             <div class="row">
            <!-- categories  -->
            <div class="col-md-3">
                <div class="row categories-grid wow fadeInLeft">
                    <span class="montserrat-text uppercase">choose category</span>

                    <nav class="categories">
                        <ul class="portfolio_filter">
                            <li><a href="" class="active" data-filter="*">all</a></li>
                            <li><a href="" data-filter=".personal">Personal Diving Gear</a></li>
                            <li><a href="" data-filter=".breathing">Breathing Apparatus</a></li>
                            <li><a href="" data-filter=".dive">Dive Instruments</a></li>
                            <li><a href="" data-filter=".communication">Communication & Safety Tools</a></li>
                            <li><a href="" data-filter=".special">Specialized Survey Equipment</a></li>
                        </ul>
                    </nav>
                </div>

                <div style="text-align: left;">
                <a href="/sign-in" class="btn"
                    style="margin-top:30px; width:200px; background-color:#64c9d8; color:#ffffff; border-radius:5px;">
                    <span>rent now</span>
                </a>
            </div>

            </div>



            <!-- all works -->
            <div class="col-md-9">
                <div class="row portfolio_container" >

                    <div class="col-md-4 personal">
                        <a href="sign-in" class="portfolio_item work-grid wow fadeInUp">
                            <img src="images/scuba diving mask.jpg" alt="image">
                            <div class="portfolio_item_hover">
                                <div class="item_info">
                                    <span>scuba diving mask</span>
                                    <em> Personal Diving Gear</em>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4 fashion breathing">
                        <a href="sign-in" class="portfolio_item work-grid wow fadeInUp" data-wow-delay=".2s">
                            <img src="images/scuba tank.jpg" alt="image">
                            <div class="portfolio_item_hover">
                                <div class="item_info">
                                    <span>Scuba Tank</span>
                                    <em>Breathing Apparatus</em>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4 fashion dive">
                        <a href="sign-in" class="portfolio_item work-grid wow fadeInUp" data-wow-delay=".2s">
                            <img src="images/watch.jpg" alt="image">
                            <div class="portfolio_item_hover">
                                <div class="item_info">
                                    <span>Dive Computer</span>
                                    <em>Dive Instruments</em>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4 fashion communication">
                        <a href="sign-in" class="portfolio_item work-grid wow fadeInUp" data-wow-delay=".2s">
                            <img src="images/smb.jpg" alt="image">
                            <div class="portfolio_item_hover">
                                <div class="item_info">
                                    <span>Surface Marker Buoy (SMB)</span>
                                    <em>Communication & Safety Tools</em>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4 fashion special">
                        <a href="sign-in" class="portfolio_item work-grid wow fadeInUp" data-wow-delay=".2s">
                            <img src="images/camera.jpg" alt="image">
                            <div class="portfolio_item_hover">
                                <div class="item_info">
                                    <span>Underwater Camera </span>
                                    <em>Specialized Survey Equipment</em>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4 personal">
                        <a href="sign-in" class="portfolio_item work-grid wow fadeInUp">
                            <img src="images/scuba fins.jpg" alt="image">
                            <div class="portfolio_item_hover">
                                <div class="item_info">
                                    <span>scuba fins</span>
                                    <em> Personal Diving Gear</em>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4 fashion breathing">
                        <a href="sign-in" class="portfolio_item work-grid wow fadeInUp" data-wow-delay=".2s">
                            <img src="images/regulator.jpg" alt="image">
                            <div class="portfolio_item_hover">
                                <div class="item_info">
                                    <span>Regulator</span>
                                    <em>Breathing Apparatus</em>
                                </div>
                            </div>
                        </a>
                    </div>

                   <div class="col-md-4 fashion">
                    <a href="sign-in" class="portfolio_item work-grid wow fadeInUp" data-wow-delay=".2s">
                        <div style="position: relative; border-radius: 10px; overflow: hidden">
                            <img src="images/pressure.jpg" alt="Pressure vessel rental" style="width: 100%; height: auto; opacity: 100%;  background: rgba(150, 144, 144, 0.192)">
                            <div class="item_overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.6); color: #ffffff; display: flex; flex-direction: column; align-items: center; justify-content: center; opacity: 50;">
                               <span style="font-size: 8rem;">9+</span>
                               <div class="portfolio_item_hover">
                                 <div class="item_info" style="font-size: 2rem;">
                                    <em>Rent Now</em>
                                 </div>
                                </div>

                            </div>
                        </div>
                    </a>
                    </div>



                    <!-- end single work -->
                </div>
                <!-- end row -->
            </div>
            <!-- all works end -->
        </div>
        <!-- end container -->
    </section>
    <!-- portfolio -->




        <div class="container" style="width: 80%;">
            <div
                style="display: flex; justify-content: space-between; align-items: center; padding: 0 10px; margin-top: 50px;">

                <!-- Left Arrow Button -->
                <a href="{{ url('/operation_survey') }}" title="Previous"
                    style="display: inline-flex; align-items: center; justify-content: center;
                        width: 50px; height: 50px; border-radius: 50%;
                        background-color: #64c9d8; color: white; text-decoration: none;
                        font-size: 24px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <i class="icon ion-arrow-left-c"></i>
                </a>

                <!-- Right Arrow Button -->
                <a href="{{ url('/operation_lesson') }}" title="Next"
                    style="display: inline-flex; align-items: center; justify-content: center;
                        width: 50px; height: 50px; border-radius: 50%;
                        background-color: #64c9d8; color: white; text-decoration: none;
                        font-size: 24px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <i class="icon ion-arrow-right-c"></i>
                </a>

            </div>
        </div>
@endsection
