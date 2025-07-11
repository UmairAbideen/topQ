<!DOCTYPE html>
<html>

<head>
    <title>Change Request Form</title>
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
            <th class="heading">Change Request Form</th>
            <th class="heading">F-SOP-RAQA-005-05</th>
            <th class="heading">Revision No. 01</th>
        </tr>
    </table>

    @foreach ($row as $item)
        <table>
            <tr>
                <th>Request No.</th>
                <td>{{ $item->request_no }}</td>
                <th>Logging Date</th>
                <td>{{ \Carbon\Carbon::parse($item->logging_date)->format('d/M/Y') }}</td>
            </tr>
            <tr>
                <th>Initiator</th>
                <td>{{ $item->initiator }}</td>
                <th>Department</th>
                <td>{{ $item->department }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th colspan="4" class="heading">Description of Change</th>
            </tr>
            <tr>
                <th>Description</th>
                <td colspan="3">{{ $item->description }}</td>
            </tr>
            <tr>
                <th>Justification</th>
                <td colspan="3">{{ $item->justification }}</td>
            </tr>
            <tr>
                <th>Area</th>
                <td colspan="3">{{ $item->area }}</td>
            </tr>
            <tr>
                <th>Impact</th>
                <td colspan="3">{{ $item->impact }}</td>
            </tr>

            @for ($i = 1; $i <= 3; $i++)
                @php
                    $action = 'action' . $i; // Dynamically create the action key
                @endphp
                @if (!empty($item->$action))
                    <tr>
                        <th>Action # {{ $i }}</th>
                        <td colspan="3">{{ $item->$action }}</td>
                    </tr>
                @endif
            @endfor

            <tr>
                <th>Priority</th>
                <td>{{ $item->priority }}</td>
                <th>Required Date</th>
                <td>{{ \Carbon\Carbon::parse($item->required_date)->format('d/M/Y') }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th colspan="4" class="heading">Documents Effected</th>
            </tr>
            @php
                $hasDocument = false; // Flag to track if any document exists
            @endphp

            @for ($i = 1; $i <= 3; $i++)
                @php
                    $effectedDoc = 'effected_doc' . $i; // Dynamically create the document name key
                    $docNo = 'doc_no' . $i; // Dynamically create the document number key
                @endphp

                @if (!empty($item->$effectedDoc) && !empty($item->$docNo))
                    @php $hasDocument = true; @endphp <!-- Mark as true if any document exists -->
                    <tr>
                        <th>Effected Doc Name #{{ $i }}</th>
                        <td>{{ $item->$effectedDoc }}</td>
                        <th>Doc No.</th>
                        <td>{{ $item->$docNo }}</td>
                    </tr>
                @endif
            @endfor

            @if (!$hasDocument)
                <tr>
                    <th>Effected Doc Name #1</th>
                    <td>N/A</td>
                </tr>
            @endif

        </table>

        <table>
            <tr>
                <th class="heading">Initiated By</th>
                <th class="heading">Verified By</th>
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
            </tr>
        </table>



        <table>
            <tr>
                <th colspan="2" class="heading">Evalutaion of Change</th>
            </tr>
            <tr>
                <th>Classification</th>
                <td>{{ $item->classification }}</td>
            </tr>
        </table>


        <table>
            <tr>
                <th colspan="4" class="heading">Assessment of Change Control Review Committee</th>
            </tr>
            <tr>
                <th>Reviewer Name</th>
                <th>Designation</th>
                <th>Recommendation</th>
                <th>Signature</th>
            </tr>

            @if ($item->classification === 'Minor')
                <tr>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                </tr>
            @else
                @for ($i = 1; $i <= 3; $i++)
                    @if (!empty($item->{'reviewer_name' . $i}))
                        <!-- Only show row if name exists -->
                        <tr>
                            <td>{{ $item->{'reviewer_name' . $i} }}</td>
                            <td>{{ $item->{'reviewer_designation' . $i} }}</td>
                            <td>{{ $item->{'recommendation' . $i} }}</td>
                            <td>
                                @if ($item->{'reviewer_signtime' . $i})
                                    <div style="background-color: rgb(208, 216, 227);">
                                        <b>{{ $item->{'reviewer_name' . $i} }}</b>
                                        <p style="margin-top: 0px; margin-bottom: 0px;">
                                            {{ $item->{'reviewer_designation' . $i} }}</p>
                                        <p style="margin-top: 0px; margin-bottom: 0px; font-size: 11px;">Digitally
                                            Signed By
                                            {{ $item->{'reviewer_name' . $i} }}</p>
                                        <p style="margin: 0px; font-size: 11px;">
                                            {{ $item->{'reviewer_signtime' . $i} }}</p>
                                    </div>
                                @else
                                    Pending
                                @endif
                            </td>
                        </tr>
                    @endif
                @endfor
            @endif

        </table>


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


        <table>
            <tr>
                <th colspan="4" class="heading">Implementation</th>
            </tr>
            @foreach (range(1, 3) as $i)
                @if (!empty($item->{'task' . $i}))
                    <tr>
                        <th>Task #{{ $i }}</th>
                        <td colspan="3">{{ $item->{'task' . $i} }}</td>
                    </tr>
                    <tr>
                        <th>Responsible Person #{{ $i }}</th>
                        <td>{{ $item->{'responsible' . $i} }}</td>
                        <th>Completion Date #{{ $i }}</th>
                        <td>{{ \Carbon\Carbon::parse($item->{'completion_date' . $i})->format('d/M/Y') }}</td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <th>Summary</th>
                <td colspan="3">{{ $item->summary }}</td>
            </tr>
            <tr>
                <th>Implementation Date</th>
                <td colspan="3">{{ \Carbon\Carbon::parse($item->implementation_date)->format('d/M/Y') }}</td>
            </tr>
        </table>


        <table>
            <tr>
                <th colspan="2" class="heading">Close-out</th>
            </tr>
            <tr>
                <th>Final Assessment</th>
                <td>{{ $item->final_assessment }}</td>
            </tr>
            <tr>
                <th>Monitoring</th>
                <td>{{ $item->monitoring }}</td>
            </tr>
            <tr>
                <th>Change Closing Date</th>
                <td>{{ \Carbon\Carbon::parse($item->closer_signtime)->format('d/M/Y') }}
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
