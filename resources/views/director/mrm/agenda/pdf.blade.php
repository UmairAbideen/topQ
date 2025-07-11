<!DOCTYPE html>
<html>

<head>
    <title>MRM Agenda</title>
    {{-- <link rel="icon" href="{{ public_path('/assets/img/logo-4.png') }}" type="image/x-icon"> --}}
    <style>
        table {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 14px;
            border-collapse: collapse;
            width: 100%;
            color: #63677b;
            margin-bottom: 30px;
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
            <th class="heading">Management Review Agenda</th>
            <th class="heading">F-SOP-RAQA-007-01</th>
            <th class="heading">Revision No. 01</th>
        </tr>
    </table>

    @foreach ($row as $item)
        <table>
            <tr>
                <th>Meeting Number</th>
                <td>{{ $item->meeting_no }}</td>

                <th>Meeting Date</th>
                <td>{{ \Carbon\Carbon::parse($item->meeting_date)->format('d/M/Y') }}</td>

            </tr>
            <tr>
                <th>Venue</th>
                <td>{{ $item->venue }}</td>

                <th>Review Period</th>
                <td>{{ $item->review_period }}</td>

            </tr>
            <tr>
                <th>Start Time</th>
                <td>{{ \Carbon\Carbon::parse($item->start_time)->format('h:i A') }}</td>

                <th>End Time</th>
                <td>{{ \Carbon\Carbon::parse($item->end_time)->format('h:i A') }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th class="heading" colspan="2">Review Items</th>
            </tr>
            <tr>
                <th style="width: 3%;">S. No.</th>
                <th>Review Item</th>
            </tr>
            @for ($i = 1; $i <= 20; $i++)
                @if (!is_null($item->{'review_item' . $i}))
                    <tr>
                        <td style="width: 3%;">{{ $i }}</td>
                        <td>{{ $item->{'review_item' . $i} }}</td>
                    </tr>
                @endif
            @endfor
        </table>

        <table>
            <tr>
                <th class="heading">Prepared By</th>
                <th class="heading">Approved By</th>
            </tr>
            <tr>
                <td>
                    @if ($item->prepared_by)
                        <div style="background-color: rgb(208, 216, 227);">
                            <b>{{ $item->prepared_by }}</b>
                            <p style="margin-top: 0px; margin-bottom: 0px;">{{ $item->preparator_designation }}</p>
                            <p style="margin-top: 0px; margin-bottom: 0px; font-size: 11px;">Digitally Signed By
                                {{ $item->prepared_by }}</p>
                            <p style="margin-top: 0px; font-size: 11px;">{{ $item->preparation_time }}</p>
                        </div>
                    @endif
                </td>
                <td>
                    @if ($item->approved_by)
                        <div style="background-color: rgb(208, 216, 227);">
                            <b>{{ $item->approved_by }}</b>
                            <p style="margin-top: 0px; margin-bottom: 0px;">{{ $item->approver_designation }}</p>
                            <p style="margin-top: 0px; margin-bottom: 0px; font-size: 11px;">Digitally Signed By
                                {{ $item->approved_by }}</p>
                            <p style="margin-top: 0px; font-size: 11px;">{{ $item->approval_time }}</p>
                        </div>
                    @endif
                </td>
            </tr>
        </table>
    @endforeach


</body>

</html>
