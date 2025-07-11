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
                <th>Attendee Name</th>
                <td>{{ $item->attendee_name }}</td>
            </tr>
            <tr>
                <th>Attendee Department</th>
                <td>{{ $item->attendee_department }}</td>
            </tr>
            <tr>
                <th>Attendee Designation</th>
                <td>{{ $item->attendee_designation }}</td>
            </tr>
            <tr>
                <th>Joining Date</th>
                <td>{{ \Carbon\Carbon::parse($item->joining_date)->format('d/M/Y') }}</td>
            </tr>
            <tr>
                <th>Trainer Name</th>
                <td>{{ $item->trainer_name }}</td>
            </tr>
            <tr>
                <th>Trainer Department</th>
                <td>{{ $item->trainer_department }}</td>
            </tr>
        </table>
        <table>
            <thead>
                <tr>
                    <th class="heading" style="width: 8%;">S. No.</th>
                    <th class="heading">Training Name</th>
                    <th class="heading">Training Date</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 20; $i++)
                    @if (!empty($item["training_name{$i}"]) || !empty($item["training_date{$i}"]))
                        <tr>
                            <td style="text-align:center">{{$i}}</td>
                            <td>{{ $item["training_name{$i}"] }}</td>
                            <td>{{ \Carbon\Carbon::parse($item["training_date{$i}"] )->format('d/M/Y') }}</td>
                        </tr>
                    @endif
                @endfor
            </tbody>
        </table>
    @endforeach
</body>

</html>
