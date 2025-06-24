<nav class="iq-sidebar-menu">
    <ul id="iq-sidebar-toggle" class="iq-menu">
        <li class="@yield('dashboard-active')">
            <a href="{{ route('student.dashboard')}}" class="iq-waves-effect collapsed"aria-expanded="false"><i
                    class="ri-dashboard-line iq-arrow-left">
                </i><span>Dashboard</span>
            </a>
        </li>

         <li class="@yield('diving-lessons-active')">
            <a href="{{ route('student.divingLesson') }}" class="iq-waves-effect collapsed">
                <i class="ri-book-line iq-arrow-left"></i>
                <span>Diving Lessons</span>
            </a>
        </li>

         <li class="@yield('diving-application-active')">
            <a href="{{ route('student.divingApplications') }}" class="iq-waves-effect collapsed">
                <i class="ri-clipboard-line iq-arrow-left"></i>
                <span>Diving Application</span>
            </a>
        </li>

         <li class="@yield('dive-logs-active')">
            <a href="{{ route('student.employeeDiversLogs') }}" class="iq-waves-effect collapsed">
                <i class="ri-file-line iq-arrow-left"></i>
                <span>Dive Logs</span>
            </a>
        </li>

         <li class="@yield('terms-of-service-active')">
            <a href="" data-toggle="modal" data-target="#termOfServiceStudent" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
                <i class="ri-article-line iq-arrow-left"></i>
                <span>Terms of Services</span>
            </a>
        </li>

          <li class="@yield('contact-vduci-active')">
            <a href="" class="iq-waves-effect collapsed">
                <i class="ri-phone-line iq-arrow-left"></i>
                <span>Contact VDUCI</span>
            </a>
        </li>

    </ul>
</nav>
<div class="p-3"></div>
