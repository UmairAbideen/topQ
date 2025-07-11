<!DOCTYPE html>
<html>

<head>
    <title>CAPA Form</title>
    {{-- <link rel="icon" href="{{ public_path('/assets/img/logo-4.png') }}" type="image/x-icon"> --}}
    <style>
        table {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 12px;
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
            <th class="heading">CAPA Form</th>
            <th class="heading">F-SOP-RAQA-013-01</th>
            <th class="heading">Revision No. 01</th>
        </tr>
    </table>

    @foreach ($row as $item)
        <!-- Initial Information -->
        <table>
            <tr>
                <th class="heading" colspan="2">Initial Information</th>
            </tr>
            <tr>
                <th>CAPA No</th>
                <td>{{ $item->capa_no }}</td>
            </tr>
            <tr>
                <th>Initiation Date</th>
                <td>{{ $item->initiation_date }}</td>
            </tr>
            <tr>
                <th>Department</th>
                <td>{{ $item->department }}</td>
            </tr>
        </table>

        <!-- Details -->
        <table>
            <tr>
                <th class="heading" colspan="2">Details</th>
            </tr>
            <tr>
                <th>Source</th>
                <td>{{ $item->source }}</td>
            </tr>
            <tr>
                <th>Description of Deviation/Non-confimrity</th>
                <td>{{ $item->description }}</td>
            </tr>
        </table>

        <!-- Approvals -->
        <table>
            <tr>
                <th class="heading">Initiated By</th>
                <th class="heading">Verified By</th>
                <th class="heading">Reviewed By</th>
            </tr>
            <tr>
                <td>
                    @if ($item->initiator_signtime)
                        <div style="background-color: rgb(208, 216, 227);">
                            <b>{{ $item->initiator_name }}</b>
                            <p style="margin-top: 0px; margin-bottom: 0px;">{{ $item->initiator_designation }}</p>
                            <p style="margin-top: 0px; margin-bottom: 0px; font-size: 11px;">Digitally Signed By
                                {{ $item->initiator_name }}</p>
                            <p style="margin: 0px; font-size: 11px;">{{ $item->initiator_signtime }}</p>
                        </div>
                    @else
                        Pending
                    @endif
                </td>
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
                    @if ($item->department !== 'QA')
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
                    @else
                        Not Required
                    @endif
                </td>
            </tr>
        </table>

        <!-- Implementation (up to 10 actions) -->
        <table>
            <tr>
                <th class="heading" colspan="5">CAPA Implementation</th>
            </tr>

            <tr>
                <th style="width: 10%; text-align: center;">S No.</th>
                <th style="width: 55%; text-align: center;">Action</th>
                <th style="width: 15%; text-align: center;">Responsible</th>
                <th style="width: 15%; text-align: center;">Due Date</th>
                <th style="width: 15%; text-align: center;">Implementation Date</th>
            </tr>
            @for ($i = 1; $i <= 10; $i++)
                @if ($item->{'action' . $i})
                    <tr>
                        <td style="width: 5%; text-align: center;">{{ $i }}</td>
                        <td style="width: 55%; text-align: center;">{{ $item->{'action' . $i} }}</td>
                        <td style="width: 15%; text-align: center;">{{ $item->{'responsible' . $i} }}</td>
                        <td style="width: 15%; text-align: center;">{{ $item->{'due_date' . $i} }}</td>
                        <td style="width: 10%; text-align: center;">{{ $item->{'implementation_date' . $i} }}</td>
                    </tr>
                @endif
            @endfor
        </table>

        <!-- Approvals -->
        <table>
            <tr>
                <th>Approved By</th>
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

        <!-- Effectiveness -->
        <table>
            <tr>
                <th class="heading" colspan="2">Effectiveness</th>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $item->effectiveness }}</td>
            </tr>
        </table>

        <!-- Closer Information -->
        <table>
            <tr>
                <th>Closed By</th>
                <td>
                    @if ($item->closer_signtime)
                        <div style="background-color: rgb(208, 216, 227);">
                            <b>{{ $item->closer_name }}</b>
                            <p style="margin-top: 0px; margin-bottom: 0px;">{{ $item->closer_designation }}</p>
                            <p style="margin-top: 0px; margin-bottom: 0px; font-size: 11px;">Digitally Signed By
                                {{ $item->closer_name }}</p>
                            <p style="margin: 0px; font-size: 11px;">{{ $item->closer_signtime }}</p>
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
