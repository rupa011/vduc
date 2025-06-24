<nav class="iq-sidebar-menu">
    <ul id="iq-sidebar-toggle" class="iq-menu">
        <li class="@yield('dashboard-active')">
            <a href="#menu-level" class="iq-waves-effect collapsed"aria-expanded="false"><i
                    class="ri-record-circle-line iq-arrow-left">
                </i><span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="#menu-level" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i
                    class="ri-record-circle-line iq-arrow-left">
                </i><span>User Account</span>
                <i class="ri-arrow-right-s-line iq-arrow-right"></i>
            </a>
            <ul id="menu-level" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                <li class="@yield('employee-active')"><a href="{{ route('admin.employees') }}"><i
                            class="ri-record-circle-line"></i>Employees</a></li>
                <li class="@yield('student-active')"><a href="{{ route('admin.students') }}"><i
                            class="ri-record-circle-line"></i>Students</a></li>
                <li class="@yield('survey-active')"><a href="{{ route('admin.surveys') }}"><i
                            class="ri-record-circle-line"></i>Survey Clients</a></li>
                <li class="@yield('rental-active')"><a href="{{ route('admin.rentals') }}"><i
                            class="ri-record-circle-line"></i>Rental Clients</a></li>
            </ul>

        <li class="@yield('vessels-active')">
            <a href="#menu-vessels" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i
                    class="ri-ship-line iq-arrow-left"></i><span>Vessels</span><i
                    class="ri-arrow-right-s-line iq-arrow-right"></i></a>
            <ul id="menu-vessels" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                <li class="@yield('vessel-active')"><a href="{{ route('employee.vessels') }}"><i
                            class="ri-file-line"></i>Lists</a></li>
                <li class="@yield('service-active')"><a href="{{ route('employee.services') }}"><i
                            class="ri-function-line"></i>Services</a></li>
                <li class="@yield('schedule-active')"><a href="{{ route('employee.schedules') }}"><i
                            class="ri-calendar-line"></i>Schedules</a></li>
                <li class="@yield('inspection-active')"><a href="{{ route('employee.inspection') }}"><i
                            class="ri-search-eye-line"></i>Inspections</a></li>
            </ul>
        </li>

        <li class="@yield('diving-active')">
            <a href="#menu-diving" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i
                    class="ri-compass-3-line iq-arrow-left"></i><span>Diving</span><i
                    class="ri-arrow-right-s-line iq-arrow-right"></i></a>
            <ul id="menu-diving" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                <li class="@yield('lesson-active')"><a href="{{ route('admin.lesson') }}"><i
                            class="ri-book-open-line"></i>Lesson</a></li>
                <li class="@yield('applications-active')"><a href="{{ route('employee.applications') }}"><i
                            class="ri-clipboard-line"></i>Applications</a></li>
                <li class="@yield('student-active')"><a href="{{ route('employee.students') }}"><i
                            class="ri-user-line"></i>Student</a></li>
            </ul>
        </li>

        <li class="@yield('equipments-active')">
            <a href="#menu-equipments" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i
                    class="ri-archive-drawer-line iq-arrow-left"></i><span>Equipments</span><i
                    class="ri-arrow-right-s-line iq-arrow-right"></i></a>
            <ul id="menu-equipments" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                <li class="@yield('equipment-active')"><a href="{{ route('admin.items') }}"><i
                            class="ri-inbox-line"></i>Items</a></li>
                <li class="@yield('rental-active')"><a href="{{ route('admin.rentals') }}"><i
                            class="ri-file-list-line"></i>Rentals</a></li>
            </ul>
        </li>


        <li class="@yield('reports-active')">
            <a href="#menu-reports" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i
                    class="ri-bar-chart-line iq-arrow-left"></i><span>Reports</span><i
                    class="ri-arrow-right-s-line iq-arrow-right"></i></a>
            <ul id="menu-reports" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                <li class="@yield('equipment-report-active')"><a href="{{ route('reports.equipment') }}"><i
                            class="ri-archive-drawer-line"></i>Equipments</a></li>
                <li class="@yield('equipment-report-active')"><a href="{{ route('reports.rental') }}"><i
                            class="ri-archive-drawer-line"></i>Rentals</a></li>
                <li class="@yield('diving-report-active')"><a href="{{ route('reports.diving') }}"><i
                            class="ri-compass-line"></i>Diving</a></li>
                {{-- <li class="@yield('vessel-report-active')"><a href="{{ route('reports.vesselReportIndex') }}"><i
                            class="ri-ship-line"></i>Vessels</a></li> --}}
            </ul>
        </li>

        <li>
            <a href="{{ route('admin.messages') }}" class="iq-waves-effect collapsed">
                <i class="ri-record-circle-line iq-arrow-left"></i>
                <span>Messages</span>
            </a>
        </li>
    </ul>
</nav>
