<!DOCTYPE html>
<html>

<head>
    <title>Complaint</title>
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
            <th class="heading">Complaint Form</th>
            <th class="heading">F-SOP-RAQA-008-01</th>
            <th class="heading">Revision No. 01</th>
        </tr>
    </table>

    @foreach ($row as $item)
        <table>
            <tr>
                <th>Complaint No.</th>
                <td>{{ $item->complaint_no }}</td>
            </tr>

            <tr>
                <th>Date of Receipt</th>
                <td>{{ $item->receipt_date }}</td>
            </tr>
            <tr>
                <th>Customer</th>
                <td>{{ $item->customer }}</td>
            </tr>
            <tr>
                <th>Complaint Detail</th>
                <td>{{ $item->detail }}</td>
            </tr>
            <tr>
                <th>Complaint Category</th>
                <td>{{ $item->category }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th colspan="2" class="heading">Product Detail</th>
            </tr>

            <tr>
                <th>Name</th>
                <td>{{ $item->product }}</td>
            </tr>
            <tr>
                <th>Batch No.</th>
                <td>{{ $item->batch }}</td>
            </tr>
            <tr>
                <th>Serial No.</th>
                <td>{{ $item->serial }}</td>
            </tr>
            <tr>
                <th>Expiry</th>
                <td>{{ $item->expiry }}</td>
            </tr>
            <tr>
                <th>Quantity</th>
                <td>{{ $item->quantity }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th colspan="2" class="heading">
                    CAPA</th>
            </tr>
            <tr>
                <th>Initialization Date</th>
                <td>{{ $item->capa_init }}</td>
            </tr>
            <tr>
                <th>Number</th>
                <td>{{ $item->capa_no }}</td>
            </tr>
            <tr>
                <th class="">Status</th>
                <td>{{ $item->capa_status }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th colspan="2" class="heading">
                    Assocaite Details</th>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $item->associate_name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $item->associate_email }}</td>
            </tr>
        </table>
    @endforeach


</body>

</html>
