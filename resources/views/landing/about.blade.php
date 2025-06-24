@extends('landing.master')

@section('content')
    <style>
        .tab {
            color: gray;
            list-style-position: inside;
            padding-left: 20px;
        }

        .tab li {
            margin-bottom: 13px;
            padding-left: 20px;
        }
    </style>
    <!-- HERO SECTION  -->
    <div class="site-hero_2">
        <div class="page-title">
            <div class="big-title montserrat-text uppercase">about us</div>
            <div class="small-title montserrat-text uppercase">home / about</div>
        </div>
    </div>

    <section>
        <div class="container">
            <div class="row" style="display: flex; align-items: center; flex-wrap: wrap;">
                <div class="col-md-6">
                    <div class="section-title" style="text-align:left; width:100%; margin-bottom:0">
                        <span>about us</span>
                        <p class="montserrat-text uppercase">VISAYAN DIVERS UNDERWATER CONTRACTOR, INC (VDUCI)</p>
                    </div>
                    <p class="about_text" style="text-indent: 20px;">
                        was established in October 2015 and registered in marine engineering.
                        It is registered under the SEC (SECURITY AND EXCHANGE COMMISSION) and provides expertise in marine
                        engineering diving services, underwater survey/inspection, and maintenance. The company is based on
                        the
                        experience and skills of its managers, divers, and employees.
                    </p>

                    <p class="about_text" style="text-indent: 20px;">
                        The successful growth of VDUCI has been achieved through the provision of quality services.
                        Our operations are accredited by the Maritime Industry Authority of the Philippines (MARINA),
                        the governing body that regulates the maritime enterprises of the country.
                        The projects are executed by trained commercial divers and specialists.
                        It is with great pride that the company offers its best knowledge and skills to the
                        specifications of the client. We have invested on quality equipment enabling us to
                        perform a wide range of services.
                        Moreover, the company believes that its employees are its best asset and we ensure the safety of
                        the workers.
                    </p>
                </div>

                <div class="col-md-6 d-flex align-items-center justify-content-center">
                    <div style="width:100%; border-radius:10px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
                        <img src="images/vduc.jpg" alt="VDUC"
                            style="width:100%; height:auto; object-fit:cover; display:block;">
                    </div>
                </div>
            </div>
        </div>
    </section>

<section>
    <div class="container">
        <div class="row" style="display: flex; align-items: stretch; flex-wrap: wrap;">
            <div class="col-md-12 d-flex">
                <div style="width: 100%; text-align: left;">
                    <div class="section-title" style="margin-bottom: 0;">
                        <span>VISION</span>
                    </div>
                    <p class="about_text" style="text-indent: 20px; margin: 0 0 20px 0;">
                        To be the primary maritime services provider company that provides expertise in
                        marine engineering diving services, maintenance and underwater survey/inspection.
                    </p>
                    <div class="section-title" style="margin-bottom: 0;">
                        <span>MISSION</span>
                    </div>
                    <p class="about_text" style="text-indent: 20px; margin: 0;">
                        The mission of Visayan Divers Underwater Contractor Inc.
                        is providing quality marine engineering diving services, maintenance, and
                        underwater survey/inspection. The company is able to perform client oriented tasks
                        through the employment of skilled workers and acquisition of the latest equipment.
                        We had been accredited by Maritime Industry Authority (MARINA) and by some other companies
                        requiring our underwater services expertise. However, we aim for recognition and accreditation
                        by all of the accreditation societies International association of classification societies (IACS),
                        International Marine Contractor Association (IMCA), Philippine Contractors Accreditation Board (PCAB)
                        and International Organization for Standardization (ISO). Our scope of services have expanded from ship
                        survey/inspection/husbandry and port/pier/harbour plant inspection and maintenance, to almost all underwater works like underwater dredging, pipe laying, ensuring the company's growth and financial stability, we focus on quality operations that meet safety requirements without sacrificing efficiency.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>



    <section>
        <div class="container">
            <div class="row">
                <div class="section-title">
                    <span>some benefits</span>
                    <p>Discover the advantages of working with us — from expert solutions and advanced equipment to
                        a commitment to safety and client satisfaction.
                        Our services are designed to deliver long-term value and peace of mind.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12 benefits_2_single wow fadeInUp">
                    <i class="icon ion-ios-briefcase"></i>
                    <span class="title montserrat-text uppercase">Experience You Can Trust</span>
                    <p>With years of hands-on expertise in underwater construction,
                        we deliver safe, efficient, and professional results—every time. </p>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12 benefits_2_single wow fadeInUp" data-wow-delay=".1s">
                    <i class="icon ion-ios-star"></i>
                    <span class="title montserrat-text uppercase">Committed to Quality</span>
                    <p>We use top-grade equipment and trained divers to ensure every project meets the highest industry
                        standards.</p>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12 benefits_2_single wow fadeInUp" data-wow-delay=".2s">
                    <i class="icon ion-ios-people"></i>
                    <span class="title montserrat-text uppercase">Customer-First Approach</span>
                    <p>Your satisfaction is our priority. We work closely with clients
                        to deliver tailored solutions on time and within budget.</p>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12 benefits_2_single wow fadeInUp" data-wow-delay=".3s">
                    <i class="icon ion-ios-cog"></i>
                    <span class="title montserrat-text uppercase">Full-Service Capability </span>
                    <p>From underwater surveys to diving lessons, we provide complete marine services under one trusted
                        name.</p>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12 benefits_2_single wow fadeInUp" data-wow-delay=".4s">
                    <i class="icon ion-ios-lightbulb"></i>
                    <span class="title montserrat-text uppercase">Innovative Solutions</span>
                    <p>We combine experience and modern techniques to deliver smart and effective underwater engineering
                        solutions.</p>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12 benefits_2_single wow fadeInUp" data-wow-delay=".5s">
                    <i class="icon ion-ios-settings"></i>
                    <span class="title montserrat-text uppercase">Reliable Equipment</span>
                    <p>We use high-quality and well-maintained tools to ensure safety and precision in every project.</p>
                </div>
            </div>
        </div>
    </section>


    <section>

        <div class="container">
            <div class="row">
                <div class="section-title">
                    <span>meet the team</span>
                    <p>Meet the dedicated professionals behind Visayan Divers. Our team of
                        certified divers and marine specialists work with precision, safety,
                        and integrity to deliver top-quality underwater services.

                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp">
                    <div class="team_member">
                        <img src="/images/profile.jpg" alt="team image">
                        <div class="team_member_hover">
                            <div class="team_member_info">
                                <div class="team_member_name">CAPT. FRANCISCO B. ADOLFO, MM</div>
                                <div class="team_member_job">PRESIDENT</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-delay=".1s">
                    <div class="team_member">
                        <img src="/images/profile.jpg" alt="team image">
                        <div class="team_member_hover">
                            <div class="team_member_info">
                                <div class="team_member_name">CAPT. CALIXTO A. ADOLFO, MM</div>
                                <div class="team_member_job">VICE PRESIDENT</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-delay=".2s">
                    <div class="team_member">
                        <img src="/images/profile.jpg" alt="team image">
                        <div class="team_member_hover">
                            <div class="team_member_info">
                                <div class="team_member_name">ALPHECCA B. ADOLFO - MADRID, CPA, LLB</div>
                                <div class="team_member_job">CHEIF FINNANCE OFFICER</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-delay=".3s">
                    <div class="team_member">
                        <img src="/images/profile.jpg" alt="team image">
                        <div class="team_member_hover">
                            <div class="team_member_info">
                                <div class="team_member_name">HERACLEO C. OLVIS</div>
                                <div class="team_member_job">CHEIF UNDERWATER SERVICES</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-delay=".4s">
                    <div class="team_member">
                        <img src="/images/profile.jpg" alt="team image">
                        <div class="team_member_hover">
                            <div class="team_member_info">
                                <div class="team_member_name">WOLFGANG LENGERSDORF</div>
                                <div class="team_member_job">TECHNICAL CONSULTANAT</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-delay=".5s">
                    <div class="team_member">
                        <img src="/images/profile.jpg" alt="team image">
                        <div class="team_member_hover">
                            <div class="team_member_info">
                                <div class="team_member_name">ELVIRS L. LENGERSDORF</div>
                                <div class="team_member_job">TREASUSRER</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-delay=".6s">
                    <div class="team_member">
                        <img src="/images/profile.jpg" alt="team image">
                        <div class="team_member_hover">
                            <div class="team_member_info">
                                <div class="team_member_name">ADELAIDA B. ADOLFO, RN</div>
                                <div class="team_member_job">MARKETING</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-delay=".7s">
                    <div class="team_member">
                        <img src="/images/profile.jpg" alt="team image">
                        <div class="team_member_hover">
                            <div class="team_member_info">
                                <div class="team_member_name">RUTH A. ADOLFO, RN</div>
                                <div class="team_member_job">NURSE</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
