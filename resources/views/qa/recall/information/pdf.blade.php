<!DOCTYPE html>
<html>

<head>
    <title>Recall Information Form</title>
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
            <th class="heading">Recall Information Form</th>
            <th class="heading">F-SOP-RAQA-009-02</th>
            <th class="heading">Revision No. 01</th>
        </tr>
    </table>

    @foreach ($row as $item)
        <table>
            <tr>
                <th colspan="2" class="heading">Reporter Detail</th>
            </tr>
            <tr>
                <th>Reporter Name</th>
                <td>{{ $item->reporter_name }}</td>
            </tr>
            <tr>
                <th>Organization</th>
                <td>{{ $item->organization }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $item->address }}</td>
            </tr>
            <tr>
                <th>Contact</th>
                <td>{{ $item->contact }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $item->email }}</td>
            </tr>
            <tr>
                <th>Receipt Date</th>
                <td>{{ $item->receipt_date }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th colspan="2" class="heading">Product Detail</th>
            </tr>
            <tr>
                <th>Product Name</th>
                <td>{{ $item->product_name }}</td>
            </tr>
            <tr>
                <th>Registration Number</th>
                <td>{{ $item->registration_no }}</td>
            </tr>
            <tr>
                <th>Batch</th>
                <td>{{ $item->batch }}</td>
            </tr>
            <tr>
                <th>Serial</th>
                <td>{{ $item->serial }}</td>
            </tr>
            <tr>
                <th>Expiry Date</th>
                <td>{{ $item->expiry }}</td>
            </tr>
            <tr>
                <th>Manufacturing Date</th>
                <td>{{ $item->manufacturing_date }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th colspan="2" class="heading">Distribution Detail</th>
            </tr>
            <tr>
                <th>Initial Quantity</th>
                <td>{{ $item->qty_before }}</td>
            </tr>
            <tr>
                <th>Quantity Distributed</th>
                <td>{{ $item->qty_distributed }}</td>
            </tr>
            <tr>
                <th>Customer Name #1</th>
                <td>{{ $item->customer_name1 }}</td>
            </tr>
            <tr>
                <th>Distribution Date #1</th>
                <td>{{ $item->distribution_date1 }}</td>
            </tr>
            <tr>
                <th>Customer Name #2</th>
                <td>{{ $item->customer_name2 }}</td>
            </tr>
            <tr>
                <th>Distribution Date #2</th>
                <td>{{ $item->distribution_date2 }}</td>
            </tr>
            <tr>
                <th>Customer Name #3</th>
                <td>{{ $item->customer_name3 }}</td>
            </tr>
            <tr>
                <th>Distribution Date #3</th>
                <td>{{ $item->distribution_date3 }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th colspan="2" class="heading">Defect Detail</th>
            </tr>
            <tr>
                <th>Source of Problem</th>
                <td>{{ $item->source }}</td>
            </tr>
            <tr>
                <th>Problem Detail</th>
                <td>{{ $item->problem_detail }}</td>
            </tr>
            <tr>
                <th>No. of Complaints</th>
                <td>{{ $item->no_of_complaint }}</td>
            </tr>
            <tr>
                <th>Action Taken</th>
                <td>{{ $item->action_taken }}</td>
            </tr>
            <tr>
                <th>Risk Assessment</th>
                <td>{{ $item->risk_assessment }}</td>
            </tr>
            <tr>
                <th>Recall Type</th>
                <td>{{ $item->recall_type }}</td>
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
