@php
    // Map text ratings to numeric scores
    $ratingMap = [
        'Poor' => 1,
        'Low' => 2,
        'Average' => 3,
        'Good' => 4,
        'Excellent' => 5,
    ];
    $inverseRatingMap = array_flip($ratingMap);

    // Columns to calculate averages for
    $columns = [
        'productquality_ins',
        'economicalsolution_ins',
        'overallservices_ins',
        'responsetocomplaints_ins',

        'responsetocomplaints_ts',
        'callattendedinscheduledtime_ts',
        'economicalsolution_ts',
        'overallperformance_ts',

        'productquality_iol',
        'economicalsolution_iol',
        'overallservices_iol',
        'responsetocomplaints_iol',

        'productquality_de',
        'economicalsolution_de',
        'overallservices_de',
        'responsetocomplaints_de',
    ];

    // Initialize sums and counts
    $sums = array_fill_keys($columns, 0);
    $counts = array_fill_keys($columns, 0);

    foreach ($feedbacks as $feedback) {
        foreach ($columns as $col) {
            $rating = $feedback->$col;
            if (isset($ratingMap[$rating])) {
                $sums[$col] += $ratingMap[$rating];
                $counts[$col]++;
            }
        }
    }

    // Calculate averages and map back to rating labels
    $averages = [];
    foreach ($columns as $col) {
        if ($counts[$col] > 0) {
            $avg = $sums[$col] / $counts[$col];
            $avgRounded = round($avg);
            $averages[$col] = $inverseRatingMap[$avgRounded] ?? '-';
        } else {
            $averages[$col] = '-';
        }
    }
@endphp

<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th>Name</th>
            <th>Designation</th>
            <th>Organization</th>
            <th>Email</th>
            <th>Date</th>

            {{-- Instrumentation --}}
            <th>Instr. Prod. Quality</th>
            <th>Instr. Market Price</th>
            <th>Instr. Overall Service</th>
            <th>Instr. Response Complaints</th>

            {{-- Technical Service --}}
            <th>Tech Resp. to Complaints</th>
            <th>Tech Call Attended On Time</th>
            <th>Tech Market Price</th>
            <th>Tech Overall Performance</th>

            {{-- Intraocular Lens --}}
            <th>IOL Product Quality</th>
            <th>IOL Market Price</th>
            <th>IOL Overall Services</th>
            <th>IOL Response Complaints</th>

            {{-- Dry Eye --}}
            <th>Dry Eye Product Quality</th>
            <th>Dry Eye Market Price</th>
            <th>Dry Eye Overall Services</th>
            <th>Dry Eye Response Complaints</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($feedbacks as $feedback)
            <tr>
                <td>{{ $feedback->name }}</td>
                <td>{{ $feedback->designation }}</td>
                <td>{{ $feedback->organization }}</td>
                <td>{{ $feedback->email }}</td>
                <td>{{ $feedback->created_at->format('d-m-Y') }}</td>

                {{-- Instrumentation --}}
                <td>{{ $feedback->productquality_ins }}</td>
                <td>{{ $feedback->economicalsolution_ins }}</td>
                <td>{{ $feedback->overallservices_ins }}</td>
                <td>{{ $feedback->responsetocomplaints_ins }}</td>

                {{-- Technical Service --}}
                <td>{{ $feedback->responsetocomplaints_ts }}</td>
                <td>{{ $feedback->callattendedinscheduledtime_ts }}</td>
                <td>{{ $feedback->economicalsolution_ts }}</td>
                <td>{{ $feedback->overallperformance_ts }}</td>

                {{-- Intraocular Lens --}}
                <td>{{ $feedback->productquality_iol }}</td>
                <td>{{ $feedback->economicalsolution_iol }}</td>
                <td>{{ $feedback->overallservices_iol }}</td>
                <td>{{ $feedback->responsetocomplaints_iol }}</td>

                {{-- Dry Eye --}}
                <td>{{ $feedback->productquality_de }}</td>
                <td>{{ $feedback->economicalsolution_de }}</td>
                <td>{{ $feedback->overallservices_de }}</td>
                <td>{{ $feedback->responsetocomplaints_de }}</td>
            </tr>
        @endforeach

        {{-- Overall rating row --}}
        <tr style="font-weight: bold; background-color: #e0e0e0;">
            <td colspan="5" style="text-align:center;">Overall Rating</td>

            {{-- Instrumentation --}}
            <td>{{ $averages['productquality_ins'] }}</td>
            <td>{{ $averages['economicalsolution_ins'] }}</td>
            <td>{{ $averages['overallservices_ins'] }}</td>
            <td>{{ $averages['responsetocomplaints_ins'] }}</td>

            {{-- Technical Service --}}
            <td>{{ $averages['responsetocomplaints_ts'] }}</td>
            <td>{{ $averages['callattendedinscheduledtime_ts'] }}</td>
            <td>{{ $averages['economicalsolution_ts'] }}</td>
            <td>{{ $averages['overallperformance_ts'] }}</td>

            {{-- Intraocular Lens --}}
            <td>{{ $averages['productquality_iol'] }}</td>
            <td>{{ $averages['economicalsolution_iol'] }}</td>
            <td>{{ $averages['overallservices_iol'] }}</td>
            <td>{{ $averages['responsetocomplaints_iol'] }}</td>

            {{-- Dry Eye --}}
            <td>{{ $averages['productquality_de'] }}</td>
            <td>{{ $averages['economicalsolution_de'] }}</td>
            <td>{{ $averages['overallservices_de'] }}</td>
            <td>{{ $averages['responsetocomplaints_de'] }}</td>
        </tr>
    </tbody>
</table>
