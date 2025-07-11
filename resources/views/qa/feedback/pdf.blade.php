<!DOCTYPE html>
<html>

<head>
    <title>Customer Feedback</title>
    {{-- <link rel="icon" href="{{ public_path('/assets/img/logo-4.png') }}" type="image/x-icon"> --}}
    <style>
        table {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 14px;
            border-collapse: collapse;
            width: 100%;
            color: #63677b;
            margin-bottom: 33px;
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
            <th class="heading">Customer Feedback Form</th>
            <th class="heading">F-SOP-RAQA-010-01</th>
            <th class="heading">Revision No. 01</th>
        </tr>
    </table>

    @foreach ($row as $item)
        <table>
            <tr>
                <th>Name</th>
                <td>{{ $item->name }}</td>
            </tr>
            <tr>
                <th>Designation</th>
                <td>{{ $item->designation }}</td>
            </tr>
            <tr>
                <th>Organization</th>
                <td>{{ $item->organization }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $item->email }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th colspan="2" class="heading">Instrumentation</th>
            </tr>

            <tr>
                <th>Product Quality</th>
                <td>{{ $item->productquality_ins }}</td>
            </tr>
            <tr>
                <th>Economical Solution for Patients </th>
                <td>{{ $item->economicalsolution_ins }}</td>
            </tr>
            <tr>
                <th>Overall Services</th>
                <td>{{ $item->overallservices_ins }}</td>
            </tr>
            <tr>
                <th>Response to Complaints</th>
                <td>{{ $item->responsetocomplaints_ins }}</td>
            </tr>
            <tr>
                <th>Remarks</th>
                <td>{{ $item->remarks_ins }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th colspan="2" class="heading">Technical Service</th>
            </tr>

            <tr>
                <th>Response to Complaint</th>
                <td>{{ $item->responsetocomplaints_ts }}</td>
            </tr>
            <tr>
                <th>Call Attended in Scheduled Time</th>
                <td>{{ $item->callattendedinscheduledtime_ts }}</td>
            </tr>
            <tr>
                <th>Economical Solution</th>
                <td>{{ $item->economicalsolution_ts }}</td>
            </tr>
            <tr>
                <th>Overall Performance</th>
                <td>{{ $item->overallperformance_ts }}</td>
            </tr>
            <tr>
                <th>Remarks</th>
                <td>{{ $item->remarks_ts }}</td>
            </tr>
        </table>


        <table>
            <tr>
                <th colspan="2" class="heading">Intraocular Lens</th>
            </tr>

            <tr>
                <th>Product Quality</th>
                <td>{{ $item->productquality_iol }}</td>
            </tr>
            <tr>
                <th>Economical Solution for Patients </th>
                <td>{{ $item->economicalsolution_iol }}</td>
            </tr>
            <tr>
                <th>Overall Services</th>
                <td>{{ $item->overallservices_iol }}</td>
            </tr>
            <tr>
                <th>Response to Complaints</th>
                <td>{{ $item->responsetocomplaints_iol }}</td>
            </tr>
            <tr>
                <th>Remarks</th>
                <td>{{ $item->remarks_iol }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th colspan="2" class="heading">Dry Eye</th>
            </tr>

            <tr>
                <th>Product Quality</th>
                <td>{{ $item->productquality_de }}</td>
            </tr>
            <tr>
                <th>Economical Solution for Patients </th>
                <td>{{ $item->economicalsolution_de }}</td>
            </tr>
            <tr>
                <th>Overall Services</th>
                <td>{{ $item->overallservices_de }}</td>
            </tr>
            <tr>
                <th>Response to Complaints</th>
                <td>{{ $item->responsetocomplaints_de }}</td>
            </tr>
            <tr>
                <th>Remarks</th>
                <td>{{ $item->remarks_de }}</td>
            </tr>
        </table>
    @endforeach


</body>

</html>
