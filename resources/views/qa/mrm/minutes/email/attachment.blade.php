<!DOCTYPE html>
<html>

<head>
    <title>MRM Minutes</title>
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
            <th class="heading">Management Review Minutes</th>
            <th class="heading">F-SOP-RAQA-007-02</th>
            <th class="heading">Revision No. 01</th>
        </tr>
    </table>

    <table>
        <tr>
            <th>Meeting Number</th>
            <td>{{ $mailData['meeting_no'] }}</td>
        </tr>
    </table>
    <table>
        <tr>
            <th class="heading">Decision</th>
            <th class="heading">Action</th>
            <th class="heading">Responsible</th>
            <th class="heading">Completion Date</th>
            <th class="heading">Remarks</th>
        </tr>

        @for ($i = 1; $i <= 10; $i++)
            <tr>
                <td>{{ $mailData['decision' . $i] }}</td>
                <td>{{ $mailData['action' . $i] }}</td>
                <td>{{ $mailData['responsible' . $i] }}</td>
                <td>{{ $mailData['completion_date' . $i] }}</td>
                <td>{{ $mailData['remarks' . $i] }}</td>
            </tr>
        @endfor
    </table>

    <table>
        <tr>
            <th class="heading">Prepared By</th>
            <th class="heading">Approved By</th>
        </tr>
        <tr>
            <td>
                @if (!empty($mailData['prepared_by']))
                    <div style="background-color: rgb(208, 216, 227);">
                        <b>{{ $mailData['prepared_by'] }}</b>
                        <p style="margin-top: 0px; margin-bottom: 0px;">{{ $mailData['preparator_designation'] }}</p>
                        <p style="margin-top: 0px; margin-bottom: 0px; font-size: 11px;">Digitally Signed By
                            {{ $mailData['prepared_by'] }}</p>
                        <p style="margin-top: 0px; font-size: 11px;">{{ $mailData['preparation_time'] }}</p>
                    </div>
                @endif
            </td>
            <td>
                @if (!empty($mailData['approved_by']))
                    <div style="background-color: rgb(208, 216, 227);">
                        <b>{{ $mailData['approved_by'] }}</b>
                        <p style="margin-top: 0px; margin-bottom: 0px;">{{ $mailData['approver_designation'] }}</p>
                        <p style="margin-top: 0px; margin-bottom: 0px; font-size: 11px;">Digitally Signed By
                            {{ $mailData['approved_by'] }}</p>
                        <p style="margin-top: 0px; font-size: 11px;">{{ $mailData['approval_time'] }}</p>
                    </div>
                @endif
            </td>
        </tr>
    </table>
</body>

</html>
