<!DOCTYPE html>
<html>

<head>
    <title>Risk Assessment</title>
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
            <th class="heading">Risk Assessment Form</th>
            <th class="heading">F-SOP-RAQA-002-03</th>
            <th class="heading">Revision No. 01</th>
        </tr>
    </table>

    @foreach ($row as $item)
        <table>
            <tr>
                <th>QRE No.</th>
                <td>{{ $item->qre_no }}</td>
            </tr>
            <tr>
                <th>Date of Identification</th>
                <td>{{ \Carbon\Carbon::parse($item->receipt_date)->format('d/M/Y') }}</td>
            </tr>
            <tr>
                <th>Department</th>
                <td>{{ $item->department }}</td>
            </tr>
            <tr>
                <th>Area</th>
                <td>{{ $item->area }}</td>
            </tr>
            <tr>
                <th>Coordinator</th>
                <td>{{ $item->coordinator }}</td>
            </tr>

        </table>
        <table>
            <tr>
                <th colspan="2" class="heading">Risk Description</th>
            </tr>
            <tr>
                <td colspan="2">{{ $item->description }}</td>
            </tr>
        </table>
        <table>
            <tr>
                <th colspan="2" class="heading">Existing Controls</th>
            </tr>
            <tr>
                <td colspan="2">{{ $item->existing_controls }}</td>
            </tr>
        </table>
        <table>
            <tr>
                <th colspan=5 class="heading">Risk Category - Before</th>
            </tr>
            <tr>
                <th class="">Severity</th>
                <th class="">Probablity</th>
                <th class="">Detectability</th>
                <th class="">RPN No.</th>
                <th class="">Criticality</th>
            </tr>
            <tr>
                <td>{{ $item->severity_before }}</td>
                <td>{{ $item->probablity_before }}</td>
                <td>{{ $item->detectability_before }}</td>
                <td>{{ $item->rpn_before }}</td>
                <td>{{ $item->criticality_before }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th colspan="4" class="heading">Recommended Actions</th>
            </tr>
            <tr>
                <th style="width: 10%">S. No.</th>
                <th>Action</th>
                <th>Responsibility</th>
                <th>Completion Date</th>
            </tr>
            @for ($i = 1; $i <= 5; $i++)
                @if (
                    !is_null($item->{'action' . $i}) ||
                        !is_null($item->{'responsibility' . $i}) ||
                        !is_null($item->{'completion_date' . $i}))
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $item->{'action' . $i} ?? '' }}</td>
                        <td>{{ $item->{'responsibility' . $i} ?? '' }}</td>
                        <td>{{ $item->{'completion_date' . $i} ?? '' }}</td>
                    </tr>
                @endif
            @endfor
        </table>


        <table>
            <tr>
                <th colspan=5 class="heading">Risk Category - After</th>
            </tr>
            <tr>
                <th class="">Severity</th>
                <th class="">Probablity</th>
                <th class="">Detectability</th>
                <th class="">RPN No.</th>
                <th class="">Criticality</th>
            </tr>
            <tr>
                <td>{{ $item->severity_after }}</td>
                <td>{{ $item->probablity_after }}</td>
                <td>{{ $item->detectability_after }}</td>
                <td>{{ $item->rpn_after }}</td>
                <td>{{ $item->criticality_after }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th class="heading">Verified By</th>
                <th class="heading">Reviewed By</th>
                <th class="heading">Approved By</th>
            </tr>
            <tr>
                <td>
                    @if ($item->department === 'QA')
                        Not Required
                    @elseif($item->department !== 'QA')
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
                    @endif
                </td>

                <td>
                    @if ($item->reviewer_signtime)
                        <div style="background-color: rgb(208, 216, 227);">
                            <b>{{ $item->reviewer_name }}</b>
                            <p style="margin-top: 0px; margin-bottom: 0px;">{{ $item->reviewer_designation }}</p>
                            <p style="margin-top: 0px; margin-bottom: 0px; font-size: 11px;">Digitally Signed By
                                {{ $item->reviewer_name }}</p>
                            <p style="margin: 0px; font-size: 11px;">{{ $item->reviewer_signtime }}</p>
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
