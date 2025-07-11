<!DOCTYPE html>
<html>

<head>
    <title>Deviation Approval Form</title>
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
            <th class="heading">Deviation Approval Form</th>
            <th class="heading">F-SOP-RAQA-012-01</th>
            <th class="heading">Revision No. 01</th>
        </tr>
    </table>

    @foreach ($row as $item)
        <table>
            <tr>
                <th class="heading" colspan="2">Initial Information</th>
            </tr>
            <tr>
                <th>Deviation Date</th>
                <td>{{ $item->deviation_date }}</td>
            </tr>
            <tr>
                <th>Deviation No</th>
                <td>{{ $item->deviation_no }}</td>
            </tr>
            <tr>
                <th>Initiator Name</th>
                <td>{{ $item->initiator_name }}</td>
            </tr>
            <tr>
                <th>Initiator Department</th>
                <td>{{ $item->initiator_department }}</td>
            </tr>
            <tr>
                <th>Initiator Designation</th>
                <td>{{ $item->initiator_designation }}</td>
            </tr>
        </table>


        <table>
            <tr>
                <th class="heading" colspan="2">Initial Assessment</th>
            </tr>
            <tr>
                <th>Subject</th>
                <td>{{ $item->subject }}</td>
            </tr>
            <tr>
                <th>Detail</th>
                <td>{{ $item->detail }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $item->status }}</td>
            </tr>
            <tr>
                <th>Statement</th>
                <td>{{ $item->statement }}</td>
            </tr>
            <tr>
                <th>Immediate Action(s)</th>
                <td>{{ $item->action }}</td>
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

        <table>
            <tr>
                <th class="heading" colspan="2">Root Cause Analysis</th>
            </tr>
            <tr>
                <th>Possible Root Cause(s)</th>
                <td>{{ $item->root_causes }}</td>
            </tr>
            <tr>
                <th>Remarks (If Any)</th>
                <td>{{ $item->root_cause_remarks }}</td>
            </tr>
        </table>


        <table>
            <tr>
                <th class="heading" colspan="2">Categorization</th>
            </tr>
            <tr>
                <th>Deviation Categorization</th>
                <td>{{ $item->categorization }}</td>
            </tr>
        </table>


        <table>
            <tr>
                <th class="heading" colspan=4>Review Committee</th>
            </tr>
            <tr>
                <th>Reviewer Name</th>
                <th>Designation</th>
                <th>Recommendation</th>
                <th>Signature</th>
            </tr>

            @if ($item->categorization === 'minor')
                <tr>
                    <td>Not Applicable</td>
                    <td>Not Applicable</td>
                    <td>Not Applicable</td>
                    <td>Not Applicable</td>
                </tr>
            @elseif ($item->categorization === 'critical' || $item->categorization === 'major')
                @for ($i = 1; $i <= 3; $i++)
                    @if ($item->{'reviewer_name' . $i})
                        <tr>
                            {{-- Reviewer Name --}}
                            <td>{{ $item->{'reviewer_name' . $i} }}</td>

                            {{-- Reviewer Designation --}}
                            @if ($item->{'reviewer_designation' . $i} && ($item->categorization === 'major' || $item->categorization === 'critical'))
                                <td>{{ $item->{'reviewer_designation' . $i} }}</td>
                            @elseif($item->categorization === 'minor')
                                <td>Not Applicable</td>
                            @else
                                <td>Pending</td>
                            @endif

                            {{-- Recommendation --}}
                            <td>{{ $item->{'recommendation' . $i} ?? '' }}</td>

                            {{-- Reviewer Signature Time --}}
                            @if ($item->{'reviewer_signtime' . $i})
                                <td>
                                    <div style="background-color: rgb(208, 216, 227);">
                                        <b>{{ $item->{'reviewer_name' . $i} }}</b>
                                        <p style="margin-top: 0px; margin-bottom: 0px;">
                                            {{ $item->{'reviewer_designation' . $i} }}
                                        </p>
                                        <p style="margin-top: 0px; margin-bottom: 0px; font-size: 11px;">Digitally
                                            Signed By
                                            {{ $item->{'reviewer_name' . $i} }}</p>
                                        <p style="margin: 0px; font-size: 11px;">
                                            {{ $item->{'reviewer_signtime' . $i} }}
                                        </p>
                                    </div>
                                </td>
                            @else
                                <td>Pending</td>
                            @endif
                        </tr>
                    @endif
                @endfor
            @endif
        </table>


        <table>
            <tr>
                <th class="heading" colspan="2">Impact Evaluation (By Manager)</th>
            </tr>
            <tr>
                <th>Medical Device Effected</th>
                <td>{{ $item->device_effected }}</td>
            </tr>
            <tr>
                <th>Patient Effected</th>
                <td>{{ $item->patient_effected }}</td>
            </tr>
            <tr>
                <th>Other Process or Service Effected</th>
                <td>{{ $item->other_effected }}</td>
            </tr>
            <tr>
                <th>Confimred By</th>
                <td>
                    @if ($item->confirmer_signtime)
                        <div style="background-color: rgb(208, 216, 227);">
                            <b>{{ $item->confirmer_name }}</b>
                            <p style="margin-top: 0px; margin-bottom: 0px;">{{ $item->confirmer_designation }}</p>
                            <p style="margin-top: 0px; margin-bottom: 0px; font-size: 11px;">Digitally Signed By
                                {{ $item->confirmer_name }}</p>
                            <p style="margin: 0px; font-size: 11px;">{{ $item->confirmer_signtime }}</p>
                        </div>
                    @else
                        Pending
                    @endif
                </td>
            </tr>
        </table>


        <table>
            <tr>
                <th class="heading" colspan="2">Impact Evaluation (By QA)</th>
            </tr>
            <tr>
                <th>Recall Required</th>
                <td>{{ $item->required_recall }}</td>
            </tr>
            <tr>
                <th>Recall Number</th>
                <td class="align-middle text-center text-sm">
                    @if (is_null($item->required_recall) && is_null($item->recall_no))
                        Pending
                    @elseif($item->required_recall === 'No' && is_null($item->recall_no))
                        Not Required
                    @elseif($item->required_recall === 'Yes' && !is_null($item->recall_no))
                        {{ $item->recall_no }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>CAPA Required</th>
                <td>{{ $item->required_capa }}</td>
            </tr>
            <tr>
                <th>CAPA Number</th>
                <td class="align-middle text-center text-sm">
                    @if (is_null($item->required_capa) && is_null($item->capa_no))
                        Pending
                    @elseif($item->required_capa === 'No' && is_null($item->capa_no))
                        Not Required
                    @elseif($item->required_capa === 'Yes' && !is_null($item->capa_no))
                        {{ $item->capa_no }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Change Control Required</th>
                <td>{{ $item->required_ccm }}</td>
            </tr>
            <tr>
                <th>Change Control Number</th>
                <td class="align-middle text-center text-sm">
                    @if (is_null($item->required_ccm) && is_null($item->ccm_no))
                        Pending
                    @elseif($item->required_ccm === 'No' && is_null($item->ccm_no))
                        Not Required
                    @elseif($item->required_ccm === 'Yes' && !is_null($item->ccm_no))
                        {{ $item->ccm_no }}
                    @endif
                </td>
            </tr>

        </table>


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
