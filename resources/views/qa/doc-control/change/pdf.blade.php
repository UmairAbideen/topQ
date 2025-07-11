<!DOCTYPE html>
<html>

<head>
    <title>Document Change Request Form</title>
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
            <th class="heading">Document Change Request Form</th>
            <th class="heading">F-SOP-RAQA-001-01</th>
            <th class="heading">Revision No. 01</th>
        </tr>
    </table>

    @foreach ($row as $item)
        <table>
            <tr>
                <th colspan="2" class="heading">General Information</th>
            </tr>
            <tr>
                <th>Change No.</th>
                <td>{{ $item->change_no ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Department</th>
                <td>{{ $item->department ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Document No</th>
                <td>{{ $item->doc_no ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Document Name</th>
                <td>{{ $item->doc_name ?? 'N/A' }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th class="heading">Description of Proposed Change</th>
                <th class="heading">Reason</th>
            </tr>
            @for ($i = 1; $i <= 5; $i++)
                @if (!empty($item->{'change' . $i}))
                    <tr>
                        <td>{{ $item->{'change' . $i} ?? 'N/A' }}</td>
                        <td>{{ $item->{'reason' . $i} ?? 'N/A' }}</td>
                    </tr>
                @endif
            @endfor
        </table>

        <table>
            <tr>
                <th>Impact (if any)</th>
                <td>{{ $item->impact ?? 'N/A' }}</td>
            </tr>
        </table>



        <table>
            <tr>
                <th class="heading">Verified By</th>
                <th class="heading">Approved By</th>
            </tr>

            <tr>
                <td>
                    @if ($item->verifier_signtime)
                        <div style="background-color: rgb(208, 216, 227);">
                            <b>{{ $item->verifier_name }}</b>
                            <p style="margin-top: 0px; margin-bottom: 0px;">{{ $item->verifier_designation }}</p>
                            <p style="margin-top: 0px; margin-bottom: 0px; font-size: 11px;">Digitally Signed By
                                {{ $item->verifier_name }}</p>
                            <p style="margin: 0px; font-size: 11px;">{{ $item->verifier_signtime }}</p>
                        </div>
                    @else
                        Pending
                    @endif
                </td>


                <td>
                    @if ($item->approver_signtime)
                        <div style="background-color: rgb(208, 216, 227);">
                            <b>{{ $item->approver_name }}</b>
                            <p style="margin-top: 0px; margin-bottom: 0px;">{{ $item->approver_designation }}</p>
                            <p style="margin-top: 0px; margin-bottom: 0px; font-size: 11px;">Digitally Signed By
                                {{ $item->approver_name }}</p>
                            <p style="margin: 0px; font-size: 11px;">{{ $item->approver_signtime }}</p>
                        </div>
                    @else
                        Pending
                    @endif
                </td>
            </tr>
        </table>
    @endforeach


</body>

</html>
