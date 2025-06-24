<nav class="iq-sidebar-menu">
    <ul id="iq-sidebar-toggle" class="iq-menu">
        <li class="@yield('dashboard-active')">
            <a href="#menu-level" class="iq-waves-effect collapsed"aria-expanded="false"><i
                    class="ri-record-circle-line iq-arrow-left">
                </i><span>Dashboard</span>
            </a>
        </li>

        <li class="@yield('services-active')">
            <a href="{{ route('survey_client.services') }}" class="iq-waves-effect collapsed">
                <i class="ri-record-circle-line iq-arrow-left"></i>
                <span>Services</span>
            </a>
        </li>

        <li class="@yield('vessel-active')">
            <a href="{{ route('survey_client.vessels') }}" class="iq-waves-effect collapsed">
                <i class="ri-record-circle-line iq-arrow-left"></i>
                <span>Vessels</span>
            </a>
        </li>

        <li class="@yield('schedule-active')">
            <a href="{{ route('survey_client.vesselSchedules') }}" class="iq-waves-effect collapsed">
                <i class="ri-record-circle-line iq-arrow-left"></i>
                <span>Vessel Schedule</span>
            </a>
        </li>

        <li class="@yield('inspection-active')">
            <a href="{{ route('survey_client.vesselInspections') }}" class="iq-waves-effect collapsed">
                <i class="ri-record-circle-line iq-arrow-left"></i>
                <span>Vessel Inspection</span>
            </a>
        </li>

       <li class="@yield('terms-of-service-active')">
            <a href="" data-toggle="modal" data-target="#termOfServiceSurvey" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
                <i class="ri-article-line iq-arrow-left"></i>
                <span>Terms of Services</span>
            </a>
        </li>

        <li>
            <a href="" class="iq-waves-effect collapsed">
                <i class="ri-record-circle-line iq-arrow-left"></i>
                <span>Contact VDUCI</span>
            </a>
        </li>


    </ul>
</nav>
<div class="p-3"></div>
