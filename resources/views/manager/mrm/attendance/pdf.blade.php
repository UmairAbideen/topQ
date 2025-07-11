<!DOCTYPE html>
<html>

<head>
    <title>MRM Attendance</title>
    {{-- <link rel="icon" href="{{ public_path('/assets/img/logo-4.png') }}" type="image/x-icon"> --}}
    <style>
        table {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 14px;
            border-collapse: collapse;
            width: 100%;
            color: #63677b;
            margin-bottom: 50px;
        }

        .heading {
            text-align: center;
            color: white;
            background-color: rgb(0, 112, 192);
        }

        th {
            border: 0.5px solid #808080;
            text-align: left;
            padding: 8px;
            width: 33%;
        }

        td {
            border: 0.5px solid #808080;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            /* background-color: #dddddd; */
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <th colspan="3" style="text-align: center;">
                <img width="250" src="{{ public_path('/assets/img/logo-4.png') }}"
                    style="display: block; margin: 0 auto;" />
            </th>
        </tr>
        <tr class="heading">
            <th class="heading">Management Review Attendance</th>
            <th class="heading">F-SOP-RAQA-007-03</th>
            <th class="heading">Revision No. 01</th>
        </tr>
    </table>


    <table>
        <tr>
            <th>Meeting Number</th>
            <td>{{ $row->agenda->meeting_no }}</td>
        </tr>
    </table>


    <table>
        <tr>
            <th class="heading">Attendee</th>
            <th class="heading">Department</th>
            <th class="heading">Signature</th>
        </tr>

        @for ($i = 1; $i <= 8; $i++)
            @if ($row->{'name' . $i})
                <tr>
                    <td>{{ $row->{'name' . $i} }}</td>
                    <td>{{ $row->{'department' . $i} }}</td>
                    <td>
                        @if ($row->{'absence' . $i} == 'yes')
                            Absent
                        @elseif (!is_null($row->{'name' . $i}) && !is_null($row->{'signature' . $i}))
                            <div style=" background-color: rgb(208, 216, 227);">
                                <b style="font-size: 12px;">{{ $row->{'signature' . $i} }}</b>
                                <p style="margin: 0px; font-size: 12px;">{{ $row->{'designation' . $i} }}</p>
                                <p style="margin: 0px; font-size: 11px;">Digitally Signed By
                                    {{ $row->{'signature' . $i} }}</p>
                                <p style="margin: 0px; font-size: 11px;">{{ $row->{'signature_time' . $i} }}</p>
                            </div>
                        @elseif(!is_null($row->{'name' . $i}) && is_null($row->{'signature' . $i}))
                            Pending
                        @endif
                    </td>
                </tr>
            @endif
        @endfor
    </table>


    <table>
        <tr>
            <th>Session Facilitator</th>
            <td>
                @if ($row->prepared_by)
                    <div style="background-color: rgb(208, 216, 227);">
                        <b>{{ $row->prepared_by }}</b>
                        <p style="margin-top: 0px; margin-bottom: 0px;">{{ $row->preparator_designation }}</p>
                        <p style="margin-top: 0px; margin-bottom: 0px; font-size: 11px;">Digitally Signed By
                            {{ $row->prepared_by }}</p>
                        <p style="margin-top: 0px; font-size: 11px;">{{ $row->preparation_time }}</p>
                    </div>
                @else
                    Pending
                @endif
            </td>
        </tr>
    </table>

</body>

</html>
