<!DOCTYPE html>
<html>

<head>
    <title>Training Attendance</title>
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
            <th class="heading">Training Attendance</th>
            <th class="heading">F-SOP-RAQA-005-01</th>
            <th class="heading">Revision No. 01</th>
        </tr>
    </table>

    @foreach ($row as $item)
        <table>
            <tr>
                <th>Training Name</th>
                <td>{{ $item->training_name }}</td>
            </tr>
            <tr>
                <th>Location</th>
                <td>{{ $item->location }}</td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{ \Carbon\Carbon::parse($item->date)->format('d/M/Y') }}</td>
            </tr>
            <tr>
                <th>Time</th>
                <td>{{ \Carbon\Carbon::parse($item->from)->format('h:i A') }} to
                    {{ \Carbon\Carbon::parse($item->to)->format('h:i A') }}</td>
            </tr>
            <tr>
                <th>Department</th>
                <td>{{ $item->department }}</td>
            </tr>
            <tr>
                <th>Trainer Name</th>
                <td>{{ $item->trainer_name }}</td>
            </tr>
            <tr>
                <th>Trainer Signature</th>
                <td>
                    @if (!is_null($item->trainer_signtime))
                        <div style="background-color: rgb(208, 216, 227);">
                            <b>{{ $item->trainer_name }}</b>
                            <p style="margin-top: 0px; margin-bottom: 0px;">{{ $item->trainer_designation }}</p>
                            <p style="margin-top: 0px; margin-bottom: 0px; font-size: 11px;">Digitally Signed By
                                {{ $item->trainer_name }}</p>
                            <p style="margin: 0px; font-size: 11px;">{{ $item->trainer_signtime }}</p>
                        </div>
                    @else
                        Pending
                    @endif
                </td>
            </tr>
            </tr>
        </table>

        <!-- Attendees Table -->
        <table>
            <tr>
                <th class="heading">Attendee Name</th>
                <th class="heading">Signature</th>
            </tr>

            @for ($i = 1; $i <= 10; $i++)
                @php
                    $nameField = "attendee_name{$i}";
                    $departmentField = "attendee_department{$i}";
                    $designationField = "attendee_designation{$i}";
                    $signtimeField = "attendee_signtime{$i}";
                    $absenceField = "absence{$i}";
                @endphp


                @if (!is_null($item->$nameField))
                    <tr>
                        <td>
                            {{ $item->$nameField }}
                        </td>
                        <td>
                            @if ($item->$absenceField === 'no')
                                @if ($item->$signtimeField)
                                    <div style="background-color: rgb(208, 216, 227);">
                                        <b>{{ $item->$nameField }}</b>
                                        <p style="margin-top: 0px; margin-bottom: 0px;">{{ $item->$designationField }}
                                        </p>
                                        <p style="margin-top: 0px; margin-bottom: 0px; font-size: 11px;">Digitally
                                            Signed By
                                            {{ $item->$nameField }}</p>
                                        <p style="margin: 0px; font-size: 11px;">{{ $item->$signtimeField }}</p>
                                    </div>
                                @else
                                    Pending
                                @endif
                            @elseif($item->$absenceField === 'yes')
                                Absent
                            @endif
                        </td>
                    </tr>
                @endif
            @endfor
        </table>
    @endforeach
</body>

</html>
