<!DOCTYPE html>
<html>

<head>
    <title>Closing Report of Product Recall</title>
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

        p {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 14px;
            color: #63677b;
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
            <th class="heading">Closing Report of Product Recall</th>
            <th class="heading">RR-009-01</th>
            <th class="heading">Revision No. 01</th>
        </tr>
    </table>

    @foreach ($row as $item)
        <table>
            <tr>
                <td><strong>Product Name</strong></td>
                <td>{{ $item->product }}</td>
            </tr>
            <tr>
                <td><strong>Recall Number</strong></td>
                <td>{{ $item->recall_no }}</td>
            </tr>
            <tr>
                <td><strong>Problem Detail</strong></td>
                <td>{{ $item->problem_detail }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th class="heading" colspan="2"><strong>Reconciliation of Recalled Product</strong></th>
            </tr>
            <tr>
                <td><strong>Batch Number</strong></td>
                <td>{{ $item->batch }}</td>
            </tr>
            <tr>
                <td><strong>Serial Number</strong></td>
                <td>{{ $item->serial }}</td>
            </tr>
            <tr>
                <td><strong>Expiry Date</strong></td>
                <td>{{ $item->expiry }}</td>
            </tr>
            <tr>
                <td><strong>Manufacturing Date</strong></td>
                <td>{{ $item->manufacturing_date }}</td>
            </tr>

            <!-- Commercial Quantities -->
            <tr>
                <td><strong>Commercial Qty. Distributed</strong></td>
                <td>{{ $item->distributed_c }}</td>
            </tr>
            <tr>
                <td><strong>Commercial Qty. Recovered</strong></td>
                <td>{{ $item->recovered_c }}</td>
            </tr>
            <tr>
                <td><strong>Commercial - Recovery Rate (%)</strong></td>
                <td>{{ $item->recovery_c }}%</td>
            </tr>

            <!-- Sample Quantities -->
            <tr>
                <td><strong>Sample Qty. Distributed</strong></td>
                <td>{{ $item->distributed_s ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Sample Qty. Recovered</strong></td>
                <td>{{ $item->recovered_s ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Sample - Recovery Rate (%)</strong></td>
                <td>{{ $item->recovery_s ?? 'N/A' }}%</td>
            </tr>

        </table>

        <table>
            <tr>
                <td><strong>Remarks</strong></td>
                <td>{{ $item->remarks ?? 'None' }}</td>
            </tr>
            <tr>
                <td><strong>Decision</strong></td>
                <td>{{ $item->decision }}</td>
            </tr>
        </table>




        <table>
            <tr>
                <th class="heading">Prepared By</th>
                <th class="heading">Approved By</th>
            </tr>
            <tr>
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
