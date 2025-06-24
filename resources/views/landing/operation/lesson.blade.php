@extends('landing.master')
@section('content')

<style>
    .image-wrapper {
        width: 100%;
        height: 250px;
        overflow: hidden;
        border: 2px solid #000;
        border-radius: 8px;
        margin: 10px 0;
    }

    .image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<!-- HERO SECTION -->
<div class="site-hero_2">
    <div class="page-title">
        <div class="big-title montserrat-text uppercase">Lesson</div>
        <div class="small-title montserrat-text uppercase">home / operation / lesson</div>
    </div>
</div>

<section class="portfolio">
    <div>
        <div class="row g-8 align-items-start">
            <!-- LEFT COLUMN: COURSE OVERVIEW -->
            <div class="col-md-6">
                <div class="section-title" style="text-align: center;">
                    <span>Overview</span>
                    <div style="border-top: 2px solid #000000; border-radius: 5px; margin-top: 0;">
                        <p>Whether you're just starting out or looking to level up your diving skills, we offer
                            structured and professionally guided lessons tailored to every experience level.</p>

                        <h3 class="montserrat-text uppercase" style="color: #000000; font-size: 1.5rem; text-align: left; margin-top: 30px;">Course Levels Offered:</h3>
                        <ul class="list" style="text-align: left">
                            <li>IntroDive – For absolute beginners; no prior experience required</li>
                            <li>Open Water Diver – Basic certification-level skills</li>
                            <li>Advanced Open Water Diver – Expands diving skills and depth limits</li>
                            <li>Rescue Diver – Focused on safety, self-rescue, and helping others</li>
                            <li>Dive Master – Prepares you for leadership-level diving roles</li>
                        </ul>

                        <h3 class="montserrat-text uppercase" style="color: #000000; font-size: 1.5rem; text-align: left; margin-top: 30px;">Requirements:</h3>
                        <ul class="list" style="text-align: left">
                            <li>Courses must be taken in order unless a valid certificate is presented</li>
                            <li>Valid diving certificate and ID required for higher-level courses</li>
                            <li>Medical clearance required for all participants</li>
                        </ul>

                        <h3 class="montserrat-text uppercase" style="color: #000000; font-size: 1.5rem; text-align: left; margin-top: 30px;">Important Note:</h3>
                        <p>We provide <strong>training and lessons only</strong>. We do not issue official diving certifications, but we can recommend accredited partners for certification assessment and processing.</p>

                        <h3 class="montserrat-text uppercase" style="color: #000000; font-size: 1.5rem; text-align: left; margin-top: 30px;">How It Works:</h3>
                        <p>After registration, clients will join instructor-led sessions that include classroom-style instruction, safety briefings, and supervised in-water practice. All diving gear is provided during training sessions.</p>
                    </div>
                </div>
            </div>

                <!-- RIGHT COLUMN: IMAGE GALLERY & DESCRIPTION -->
              <div class="col-md-5" style="text-align: left;">
                        <div class="small-title montserrat-text uppercase"
                    style="margin-top: 0px; background-color:#64c9d8; color:#ffffff; border-radius:5px; text-align: center; font-weight: 700; padding: 12px 20px; font-size: 18px;">
                    one of our journey
                </div>

                <!-- FLEX GRID FOR IMAGES -->
                <div class="d-flex flex-wrap justify-content-between mt-3" style="padding-left: 200px">
                    <div class="image-wrapper" style="width: 65%; text-align: center;">
                        <img src="images/diving-1.jpg" alt="Diving Image 1" style="max-width: 100%; display: block; margin: 0 auto;">
                    </div>
                    <div class="image-wrapper" style="width: 65%; text-align: center;">
                        <img src="images/diving-2.jpg" alt="Diving Image 2" style="max-width: 100%; display: block; margin: 0 auto;">
                    </div>
                    <div class="image-wrapper" style="width: 65%; text-align: center;">
                        <img src="images/diving-3.jpg" alt="Diving Image 3" style="max-width: 100%; display: block; margin: 0 auto;">
                    </div>
                    <div class="image-wrapper" style="width: 65%; text-align: center;">
                        <img src="images/diving-4.jpg" alt="Diving Image 4" style="max-width: 100%; display: block; margin: 0 auto;">
                    </div>
                </div>
                <div class="mt-4">
                    <p style="text-indent: 30px;">
                        Our diving lessons are designed to cater to all skill levels, from beginners to advanced divers.
                        Each course is structured to provide comprehensive training, ensuring participants gain the
                        necessary skills and knowledge for safe and enjoyable diving experiences. Our certified instructors
                        guide students through practical exercises and theoretical knowledge, covering essential topics
                        such as dive planning, safety protocols, and underwater navigation.
                    </p>
                </div>

                <div style="text-align: left;">
                    <a href="/sign-in" class="btn"
                        style="margin-top:30px; width:200px; background-color:#64c9d8; color:#ffffff; border-radius:5px;">
                        <span>Enroll Now</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PAGINATION NAVIGATION -->
<div class="container" style="width: 80%;">
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 0 10px; margin-top: 50px;">
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


