<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Underwater Hull Survey/Inspection</title>
    <style type="text/css" media="print">
        @page {
            size: Legal portrait;
            margin: 0;
        }
    </style>
    <style rel="stylesheet" type="text/css" media="all">
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            line-height: 1.5;
            padding: 20px;
        }

        .certificate {
            border: 2px solid black;
            padding: 20px;
            max-width: 800px;
            margin: auto;
        }

        .header {
            text-align: center;
            margin: 20px;
        }

        .sub-header {
            text-align: center;
            font-size: 14px;
            margin-top: -10px;
        }

        .section {
            margin: 20px 0;
        }

        .bold {
            font-weight: bold;
        }

        .note {
            font-size: 13px;
            margin-top: 50px;
            font-weight: bold;
            text-align: center;
            padding: 0 20px;
            font-style: italic;
        }

        .footer {
            margin-top: -1px;
            text-align: center;
            padding: 0 20px;
            font-weight: bold;
        }

        .centered {
            text-align: center;
        }

        .container {
            display: flex;
            justify-content: space-between;
            margin: 10px;
        }

        .left {
            flex: 1;
        }

        .right {
            flex: 1;
        }

        input[type="checkbox"] {
            transform: scale(1.2);
        }
    </style>
</head>

<body>
    <div class="certificate">
        <div class="header">
            <table style="width: 100%; margin-bottom: 20px;">
                <tr>
                    <td style="width: 20%; text-align: center;">
                        <img src="{{ asset('/dist/img/VDUC.png') }}" alt="VDUC Logo"
                            style="height: 120px; width: 120px;">
                    </td>
                    <td style="width: 60%; text-align: left;">
                        <p>VISAYAN DIVERS UNDERWATER CONTRACATOR INC.</p>
                        <p style="margin-top: -5px; font-weight: bolder;">620 Avenida Rizal St. Brgy. Nalibunan, Abuyog,
                            Leyte</p>
                        <p style="margin-top: -5px; color: blue; font-weight: bolder;">Contact #: 09171346062 /
                            09177850734</p>
                        <p style="margin-top: -5px;">Email Address: visayan_divers@yahoo.com</p>
                        <p style="margin-top: -5px;">Marina Accreditation Certificate No.: US-MR08-2022-07001</p>
                    </td>
                    <td style="width: 20%; text-align: center;">
                        <img src="{{ asset('/dist/img/VDUC.png') }}" alt="VDUC Logo"
                            style="height: 120px; width: 120px;">
                    </td>
                </tr>
            </table>
        </div>

        <div class="container">
            <table style="width: 100%; margin-bottom: 20px; margin-left: 10px; margin-right: 10px;">
                <tr>
                    <td style="width: 100%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: red;">Date Conducted</span>
                        <span style="border-bottom: 3px solid red;">{{ $inspectionReport->schedule_date }}</span>
                    </td>
                </tr>
            </table>
        </div>

        <div class="container">
            <table style="width: 100%; margin-bottom: 20px; margin-left: 10px; margin-right: 10px;">
                <tr>
                    <td style="width: 30%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black;">SUBJECT</span>
                    </td>
                    <td style="width: 70%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black; text-decoration: underline;">: CERTIFICATE OF
                            UNDERWATER HULL SURVEY/INSPECTION</span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black;">VESSEL NAME</span>
                    </td>
                    <td style="width: 70%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black; text-decoration: underline;">:
                            {{ $inspectionReport->vessel_name }}</span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black;">VESSEL OWNER</span>
                    </td>
                    <td style="width: 70%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black; text-decoration: underline;">:
                            {{ $inspectionReport->vessel_owner }}</span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black;">LOCATION</span>
                    </td>
                    <td style="width: 70%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black; text-decoration: underline;">:
                            {{ $inspectionReport->vessel_location }}</span>
                    </td>
                </tr>
            </table>
        </div>

        <div class="header" style="font-weight: bolder; margin-top: -5px; color: black;">
            <h2>SHIP'S PARTICULAR</h2>
        </div>

        <div class="container">
            <table style="width: 100%; margin-bottom: 20px; margin-left: 10px; margin-right: 10px;">
                <tr>
                    <td style="width: 25%; text-align: left; vertical-align: top; word-wrap: break-word;">
                        <span class="bold" style="color: black;">IMO OFFICIAL NUMBER</span>
                    </td>
                    <td style="width: 25%; text-align: left; vertical-align: top; word-wrap: break-word;">
                        <span class="bold"
                            style="color: black; text-decoration: underline; display: inline-block; width: 100%;">
                            : {{ $inspectionReport->imo_on }}
                        </span>
                    </td>
                    <td style="width: 25%; text-align: left; vertical-align: top; word-wrap: break-word;">
                        <span class="bold" style="color: black;">HOMEPORT</span>
                    </td>
                    <td style="width: 25%; text-align: left; vertical-align: top; word-wrap: break-word;">
                        <span class="bold"
                            style="color: black; text-decoration: underline; display: inline-block; width: 100%;">
                            : {{ $inspectionReport->homeport }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black;">PLACE OF BUILT</span>
                    </td>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black; text-decoration: underline;">:
                            {{ $inspectionReport->place_of_built }}</span>
                    </td>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black;">TYPE OF SERVICE</span>
                    </td>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black; text-decoration: underline;">:
                            {{ $inspectionReport->type_of_service }}</span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black;">LENGTH</span>
                    </td>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black; text-decoration: underline;">:
                            {{ $inspectionReport->length }}</span>
                    </td>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black;">NO. OF SCREW</span>
                    </td>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black; text-decoration: underline;">:
                            {{ $inspectionReport->no_screws }}</span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black;">BREADTH</span>
                    </td>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black; text-decoration: underline;">:
                            {{ $inspectionReport->breadth }}</span>
                    </td>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black;">HULL MATERIAL</span>
                    </td>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black; text-decoration: underline;">:
                            {{ $inspectionReport->material }}</span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black;">DEPTH</span>
                    </td>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black; text-decoration: underline;">:
                            {{ $inspectionReport->depth }}</span>
                    </td>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black;">GROSS TONNAGE</span>
                    </td>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black; text-decoration: underline;">:
                            {{ $inspectionReport->groostonnage }}</span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black;">ENGINE MAKE</span>
                    </td>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black; text-decoration: underline;">:
                            {{ $inspectionReport->engine }}</span>
                    </td>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black;">NET TONNAGE</span>
                    </td>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black; text-decoration: underline;">:
                            {{ $inspectionReport->nettonnage }}</span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black;">YEAR BUILT</span>
                    </td>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black; text-decoration: underline;">:
                            {{ $inspectionReport->yearbuilt }}</span>
                    </td>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black;">LAUNCH DATE</span>
                    </td>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black; text-decoration: underline;">:
                            {{ $inspectionReport->launch_date }}</span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black;">HORSE POWER</span>
                    </td>
                    <td style="width: 25%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black; text-decoration: underline;">:
                            {{ $inspectionReport->horse_power }}</span>
                    </td>
                </tr>
            </table>
        </div>
        <div class="container">
            <table style="width: 100%; margin-top: -30px; margin-left: 10px; margin-right: 10px;">
                <tr>
                    <td style="width: 50%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black;">EXPIRATION OF SHIP SAFETY CERTIFICATE</span>
                    </td>
                    <td style="width: 50%; text-align: left; vertical-align: top;">
                        <span class="bold" style="color: black; text-decoration: underline;">:
                            {{ $inspectionReport->schedule_date }}</span>
                    </td>
                </tr>
            </table>
        </div>

        <div class="header" style="font-weight: bolder; margin-top: -5px; color: black;">
            <h2>INSPECTION REPORT</h2>
        </div>
        {!! $html !!}
    </div>
</body>

</html>
