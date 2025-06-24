<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Certificate of Underwater Hull Survey/Inspection</title>



    <style type="text/css" media="print">
        @page {
            size: Legal portrait;
            margin: 0;
        }
    </style>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 40px;
            line-height: 1.5;
        }

        .certificate {
            background-color: #fff;
            padding: 30px;
            border: 2px solid black;
            border-radius: 10px;
            max-width: 800px;
            margin: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header,
        .sub-header {
            text-align: center;
        }

        .header {
            margin-bottom: 10px;
        }

        .sub-header {
            font-size: 14px;
            margin-top: -10px;
        }

        h2 {
            margin-top: 30px;
            text-transform: uppercase;
            text-align: center;
            font-weight: bold;
        }

        h3 {
            margin-top: 20px;
            font-size: 18px;
            color: #000;
        }

        h4 {
            font-size: 16px;
            margin-top: 15px;
        }

        .bold {
            font-weight: bold;
        }

        .container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        td {
            vertical-align: top;
            padding: 4px;
        }

        ul {
            list-style: none;
            padding-left: 20px;
        }

        li {
            margin-bottom: 5px;
        }

        .sub-item {
            margin-left: 20px;
        }

        .note {
            font-size: 13px;
            font-style: italic;
            font-weight: bold;
            text-align: center;
            margin-top: 50px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-weight: bold;
        }

        input[type="checkbox"] {
            transform: scale(1.2);
        }
    </style>
</head>

<body>

    <div style="text-align: right; margin-top: 20px;">
        <button onclick="triggerPrint()" class="btn btn-success" class="btn btn-primary" style="margin-right: 10px;">Print
            Report</button>
    </div>

    <div class="certificate">
        <!-- HEADER SECTION -->
        <div class="header">
            <table>
                <tr>
                    <td style="width: 20%; text-align: center">
                        <img src="{{ asset('images/logo1.png') }}" alt="VDUC Logo"
                            style="height: 120px; width: 120px" />
                    </td>
                    <td style="width: 60%; text-align: left">
                        <p><strong>VISAYAN DIVERS UNDERWATER CONTRACTOR INC.</strong></p>
                        <p>620 Avenida Rizal St. Brgy. Nalibunan, Abuyog, Leyte</p>
                        <p style="color: blue">Contact #: 09171346062 / 09177850734</p>
                        <p>Email Address: visayan_divers@yahoo.com</p>
                        <p>Marina Accreditation Certificate No.: US-MR08-2022-07001</p>
                    </td>
                    <td style="width: 20%; text-align: center">
                        <img src="{{ asset('images/logo1.png') }}" alt="VDUC Logo"
                            style="height: 120px; width: 120px" />
                    </td>
                </tr>
            </table>
        </div>

        <!-- DATE -->
        <div class="container">
            <table>
                <tr>
                    <td>
                        <strong style="color: red">Date Conducted:</strong>
                        <span style="border-bottom: 2px solid red">{{ $inspectionReport->schedule_date }}</span>
                    </td>
                </tr>
            </table>
        </div>

        <!-- VESSEL INFO -->
        <div class="container">
            <table>
                <tr>
                    <td><strong>SUBJECT</strong></td>
                    <td>: <u>CERTIFICATE OF UNDERWATER HULL SURVEY/INSPECTION</u></td>
                </tr>
                <tr>
                    <td><strong>VESSEL NAME</strong></td>
                    <td>: <u>{{ $inspectionReport->vessel_name }}</u></td>
                </tr>
                <tr>
                    <td><strong>VESSEL OWNER</strong></td>
                    <td>: <u>{{ $inspectionReport->vessel_owner }}</u></td>
                </tr>
                <tr>
                    <td><strong>LOCATION</strong></td>
                    <td>: <u>{{ $inspectionReport->vessel_location }}</u></td>
                </tr>
            </table>
        </div>

        <!-- SHIP'S PARTICULARS -->
        <h2>SHIP'S PARTICULAR</h2>
        <div class="container">
            <table>
                <tr>
                    <td><strong>IMO OFFICIAL NUMBER</strong></td>
                    <td>: <u>{{ $inspectionReport->imo_on }}</u></td>
                    <td><strong>HOMEPORT</strong></td>
                    <td>: <u>{{ $inspectionReport->homeport }}</u></td>
                </tr>
                <tr>
                    <td><strong>PLACE OF BUILT</strong></td>
                    <td>: <u>{{ $inspectionReport->place_of_built }}</u></td>
                    <td><strong>TYPE OF SERVICE</strong></td>
                    <td>: <u>{{ $inspectionReport->type_of_service }}</u></td>
                </tr>
                <tr>
                    <td><strong>LENGTH</strong></td>
                    <td>: <u>{{ $inspectionReport->length }}</u></td>
                    <td><strong>NO. OF SCREW</strong></td>
                    <td>: <u>{{ $inspectionReport->no_screws }}</u></td>
                </tr>
                <tr>
                    <td><strong>BREADTH</strong></td>
                    <td>: <u>{{ $inspectionReport->breadth }}</u></td>
                    <td><strong>HULL MATERIAL</strong></td>
                    <td>: <u>{{ $inspectionReport->material }}</u></td>
                </tr>
                <tr>
                    <td><strong>DEPTH</strong></td>
                    <td>: <u>{{ $inspectionReport->depth }}</u></td>
                    <td><strong>GROSS TONNAGE</strong></td>
                    <td>: <u>{{ $inspectionReport->groostonnage }}</u></td>
                </tr>
                <tr>
                    <td><strong>ENGINE MAKE</strong></td>
                    <td>: <u>{{ $inspectionReport->engine }}</u></td>
                    <td><strong>NET TONNAGE</strong></td>
                    <td>: <u>{{ $inspectionReport->nettonnage }}</u></td>
                </tr>
                <tr>
                    <td><strong>YEAR BUILT</strong></td>
                    <td>: <u>{{ $inspectionReport->yearbuilt }}</u></td>
                    <td><strong>LAUNCH DATE</strong></td>
                    <td>: <u>{{ $inspectionReport->launch_date }}</u></td>
                </tr>
                <tr>
                    <td><strong>HORSE POWER</strong></td>
                    <td>: <u>{{ $inspectionReport->horse_power }}</u></td>
                </tr>
            </table>
        </div>

        <div class="container">
            <table>
                <tr>
                    <td><strong>EXPIRATION OF SHIP SAFETY CERTIFICATE</strong></td>
                    <td>: <u>{{ $inspectionReport->schedule_date }}</u></td>
                </tr>
            </table>
        </div>

        <!-- INSPECTION REPORT -->
        <h2>INSPECTION REPORT</h2>
        <div class="section">
            @php
                $titles = $vesselInspectionDetails->pluck('title')->toArray();
                $propellerBlades = $vesselInspectionDetails
                    ->filter(function ($item) {
                        return str_contains(strtolower($item['title']), 'blade');
                    })
                    ->values();
            @endphp

            @if ($propellerBlades->isNotEmpty())
                <h3>1. PROPELLER: ({{ $propellerBlades->count() }}
                    Blade{{ $propellerBlades->count() > 1 ? 's' : '' }})</h3>
                @foreach ($propellerBlades as $blade)
                    <div class="blade">
                        <h4>{{ $blade['title'] }}</h4>
                        <ul>
                            <li><strong>a) DAMAGE</strong></li>
                            <li class="sub-item">{{ $blade['description'] ?? 'N/A' }}</li>
                            <li><strong>b) MARINE GROWTH</strong></li>
                            <li class="sub-item">{{ $blade['marine_growth'] ?? 'N/A' }}</li>
                            <li><strong>c) CORROSION</strong></li>
                            <li class="sub-item">{{ $blade['corrosion'] ?? 'N/A' }}</li>
                            <li><strong>d) PAINT COATING</strong></li>
                            <li class="sub-item">{{ $blade['paint_coating'] ?? 'N/A' }}</li>
                        </ul>
                    </div>
                @endforeach
            @endif

            @if (in_array('2. Propeller Rope Guard', $titles))
                @php
                    $propellerRopeGuard = $vesselInspectionDetails->firstWhere('title', '2. Propeller Rope Guard');
                @endphp
                <h3>2. PROPELLER ROPE GUARD</h3>
                <div class="propeller_rope_guard">
                    <ul>
                        <li><strong>a) DAMAGE</strong></li>
                        <li class="sub-item">{{ $propellerRopeGuard['description'] ?? 'N/A' }}</li>
                        <li><strong>b) MARINE GROWTH</strong></li>
                        <li class="sub-item">{{ $propellerRopeGuard['marine_growth'] ?? 'N/A' }}</li>
                        <li><strong>c) CORROSION</strong></li>
                        <li class="sub-item">{{ $propellerRopeGuard['corrosion'] ?? 'N/A' }}</li>
                        <li><strong>d) PAINT COATING</strong></li>
                        <li class="sub-item">{{ $propellerRopeGuard['paint_coating'] ?? 'N/A' }}</li>
                    </ul>
                </div>
            @endif

            @if (in_array('3. Propeller Nut Case', $titles))
                @php
                    $propellerNutCase = $vesselInspectionDetails->firstWhere('title', '3. Propeller Nut Case');
                @endphp
                <h3>3. PROPELLER NUT CASE</h3>
                <div class="propeller_nut_case">
                    <ul>
                        <li><strong>a) DAMAGE</strong></li>
                        <li class="sub-item">{{ $propellerNutCase['description'] ?? 'N/A' }}</li>
                        <li><strong>b) MARINE GROWTH</strong></li>
                        <li class="sub-item">{{ $propellerNutCase['marine_growth'] ?? 'N/A' }}</li>
                        <li><strong>c) CORROSION</strong></li>
                        <li class="sub-item">{{ $propellerNutCase['corrosion'] ?? 'N/A' }}</li>
                        <li><strong>d) PAINT COATING</strong></li>
                        <li class="sub-item">{{ $propellerNutCase['paint_coating'] ?? 'N/A' }}</li>
                    </ul>
                </div>
            @endif

            @if (in_array('4. Rudder', $titles))
                @php
                    $rudder = $vesselInspectionDetails->firstWhere('title', '4. Rudder');
                @endphp
                <h3>4. RUDDER</h3>
                <div class="rudder">
                    <ul>
                        <li><strong>a) DAMAGE</strong></li>
                        <li class="sub-item">{{ $rudder['description'] ?? 'N/A' }}</li>
                    </ul>
                </div>
            @endif

            @if (in_array('5. Portside Astern Hull', $titles))
                @php
                    $portsideAsternHull = $vesselInspectionDetails->firstWhere('title', '5. Portside Astern Hull');
                @endphp
                <h3>5. PORTSIDE ASTERN HULL</h3>
                <div class="portside_astern_hull">
                    <ul>
                        <li><strong>a) DAMAGE</strong></li>
                        <li class="sub-item">{{ $portsideAsternHull['description'] ?? 'N/A' }}</li>
                        <li><strong>b) MARINE GROWTH</strong></li>
                        <li class="sub-item">{{ $portsideAsternHull['marine_growth'] ?? 'N/A' }}</li>
                        <li><strong>c) CORROSION</strong></li>
                        <li class="sub-item">{{ $portsideAsternHull['corrosion'] ?? 'N/A' }}</li>
                        <li><strong>d) PAINT COATING</strong></li>
                        <li class="sub-item">{{ $portsideAsternHull['paint_coating'] ?? 'N/A' }}</li>
                    </ul>
                </div>
            @endif

            @if (in_array('6. Starboard Astern Hull', $titles))
                @php
                    $starboardAsternHull = $vesselInspectionDetails->firstWhere('title', '6. Starboard Astern Hull');
                @endphp
                <h3>6. STARBOARD ASTERN HULL</h3>
                <div class="starboard_astern_hull">
                    <ul>
                        <li><strong>a) DAMAGE</strong></li>
                        <li class="sub-item">{{ $starboardAsternHull['description'] ?? 'N/A' }}</li>
                        <li><strong>b) MARINE GROWTH</strong></li>
                        <li class="sub-item">{{ $starboardAsternHull['marine_growth'] ?? 'N/A' }}</li>
                        <li><strong>c) CORROSION</strong></li>
                        <li class="sub-item">{{ $starboardAsternHull['corrosion'] ?? 'N/A' }}</li>
                        <li><strong>d) PAINT COATING</strong></li>
                        <li class="sub-item">{{ $starboardAsternHull['paint_coating'] ?? 'N/A' }}</li>
                    </ul>
                </div>
            @endif

            @if (in_array('7. Portside Amidship Hull', $titles))
                @php
                    $portsideAmidshipHull = $vesselInspectionDetails->firstWhere('title', '7. Portside Amidship Hull');
                @endphp
                <h3>7. PORTSIDE AMIDSHIP HULL</h3>
                <div class="portside_amidship_hull">
                    <ul>
                        <li><strong>a) DAMAGE</strong></li>
                        <li class="sub-item">{{ $portsideAmidshipHull['description'] ?? 'N/A' }}</li>
                        <li><strong>b) MARINE GROWTH</strong></li>
                        <li class="sub-item">{{ $portsideAmidshipHull['marine_growth'] ?? 'N/A' }}</li>
                    </ul>
                </div>
            @endif

            @if (in_array('8. Starboard Amidship Hull', $titles))
                @php
                    $starboardAmidshipHull = $vesselInspectionDetails->firstWhere(
                        'title',
                        '8. Starboard Amidship Hull',
                    );
                @endphp
                <h3>8. STARBOARD AMIDSHIP HULL</h3>
                <div class="starboard_amidship_hull">
                    <ul>
                        <li><strong>a) DAMAGE</strong></li>
                        <li class="sub-item">{{ $starboardAmidshipHull['description'] ?? 'N/A' }}</li>
                        <li><strong>b) MARINE GROWTH</strong></li>
                        <li class="sub-item">{{ $starboardAmidshipHull['marine_growth'] ?? 'N/A' }}</li>
                        <li><strong>c) CORROSION</strong></li>
                        <li class="sub-item">{{ $starboardAmidshipHull['corrosion'] ?? 'N/A' }}</li>
                        <li><strong>d) PAINT COATING</strong></li>
                        <li class="sub-item">{{ $starboardAmidshipHull['paint_coating'] ?? 'N/A' }}</li>
                    </ul>
                </div>
            @endif

            @if (in_array('9. Portside Forward Hull', $titles))
                @php
                    $portsideForwardHull = $vesselInspectionDetails->firstWhere('title', '9. Portside Forward Hull');
                @endphp
                <h3>9. PORTSIDE FORWARD HULL</h3>
                <div class="portside_forward_hull">
                    <ul>
                        <li><strong>a) DAMAGE</strong></li>
                        <li class="sub-item">{{ $portsideForwardHull['description'] ?? 'N/A' }}</li>
                        <li><strong>b) MARINE GROWTH</strong></li>
                        <li class="sub-item">{{ $portsideForwardHull['marine_growth'] ?? 'N/A' }}</li>
                        <li><strong>c) CORROSION</strong></li>
                        <li class="sub-item">{{ $portsideForwardHull['corrosion'] ?? 'N/A' }}</li>
                        <li><strong>d) PAINT COATING</strong></li>
                        <li class="sub-item">{{ $portsideForwardHull['paint_coating'] ?? 'N/A' }}</li>
                    </ul>
                </div>
            @endif

            @if (in_array('10. Starboard Forward Hull', $titles))
                @php
                    $starboardForwardHull = $vesselInspectionDetails->firstWhere('title', '10. Starboard Forward Hull');
                @endphp
                <h3>10. STARBOARD FORWARD HULL</h3>
                <div class="starboard_forward_hull">
                    <ul>
                        <li><strong>a) DAMAGE</strong></li>
                        <li class="sub-item">{{ $starboardForwardHull['description'] ?? 'N/A' }}</li>
                        <li><strong>b) MARINE GROWTH</strong></li>
                        <li class="sub-item">{{ $starboardForwardHull['marine_growth'] ?? 'N/A' }}</li>
                        <li><strong>c) CORROSION</strong></li>
                        <li class="sub-item">{{ $starboardForwardHull['corrosion'] ?? 'N/A' }}</li>
                        <li><strong>d) PAINT COATING</strong></li>
                        <li class="sub-item">{{ $starboardForwardHull['paint_coating'] ?? 'N/A' }}</li>
                    </ul>
                </div>
            @endif

            @if (in_array('11. Seachest (Port and Starboard)', $titles))
                @php
                    $seachest = $vesselInspectionDetails->firstWhere('title', '11. Seachest (Port and Starboard)');
                @endphp
                <h3>11. SEACHEST (PORT AND STARBOARD)</h3>
                <div class="seachest">
                    <ul>
                        <li><strong>a) DAMAGE</strong></li>
                        <li class="sub-item">{{ $seachest['description'] ?? 'N/A' }}</li>
                        <li><strong>b) MARINE GROWTH</strong></li>
                        <li class="sub-item">{{ $seachest['marine_growth'] ?? 'N/A' }}</li>
                        <li><strong>c) CORROSION</strong></li>
                        <li class="sub-item">{{ $seachest['corrosion'] ?? 'N/A' }}</li>
                        <li><strong>d) PAINT COATING</strong></li>
                        <li class="sub-item">{{ $seachest['paint_coating'] ?? 'N/A' }}</li>
                    </ul>
                </div>
            @endif

            <h3>REMARKS</h3>
            <div class="remarks">
                <ul>
                    @foreach ($vesselInspectionDetails as $detail)
                        @if ($detail['remarks'] && $detail['remarks'] !== 'N/A')
                            <li>{{ $detail['title'] }}: {{ $detail['remarks'] }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="note">
            <p>THIS CERTIFICATE IS ISSUED TO CERTIFY THAT THE ABOVE-MENTIONED VESSEL WAS INSPECTED AND SURVEYED.</p>
        </div>

        <div class="footer">
            <p>ISSUED BY: VISAYAN DIVERS UNDERWATER CONTRACTOR INC.</p>
        </div>
    </div>



</html>
</body>
<script>
    function triggerPrint() {
        window.print();
    }
</script>
