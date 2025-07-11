@extends('officer.layout.app')

@section('title')
    Dashboard
@endsection

@section('page-name')
    Dashboard
@endsection

@section('active-link-db')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid pt-4 pb-1">

        <!-- Cards -->
        <div class="row">

            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">radar</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0">Risk Assessment</p>
                            <h4 class="mb-0">{{ $riskCount }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        @if ($riskChangePercentage < 0)
                            <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                                    -{{ number_format($riskChangePercentage, 0) }}%</span> than last six months
                            </p>
                        @elseif($riskChangePercentage > 0)
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                                    +{{ number_format($riskChangePercentage, 0) }}%</span> than last six months
                            </p>
                        @else
                            <p class="mb-0"><span class="text-sm font-weight-bolder">
                                    0%</span> than last six months
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">check</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">CAPA</p>
                            <h4 class="mb-0">2</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+50% </span>than last
                            six months
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">description</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0">Number of SOPs</p>
                            <h4 class="mb-0">{{ $sopCount }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        @if ($sopChangePercentage < 0)
                            <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                                    {{ number_format($sopChangePercentage, 0) }}%</span> than last six months
                            </p>
                        @elseif($sopChangePercentage > 0)
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                                    +{{ number_format($sopChangePercentage, 0) }}%</span> than last six months
                            </p>
                        @else
                            <p class="mb-0"><span class="text-sm font-weight-bolder">
                                    0%</span> than last six months
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0">Number of Users</p>
                            <h4 class="mb-0">{{ $userCount }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0">
                            @if ($userChangePercentage < 0)
                                <span class="text-danger text-sm font-weight-bolder">
                                    {{ number_format($userChangePercentage, 0) }}% </span>
                                than last six months
                            @elseif ($userChangePercentage > 0)
                                <span class="text-success text-sm font-weight-bolder">
                                    +{{ number_format($userChangePercentage, 0) }}% </span>
                                than last six months
                            @else
                                <span class="text-sm font-weight-bolder">0% </span> than last six months
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Graphs -->
            <div class="row mt-4">

                <div class="col-lg-4 col-md-6 mt-4 mb-4">
                    <div class="card z-index-2">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0">Customer Feedback</h6>
                            <p>
                                @if ($feedbackChangePercentage > 0)
                                    <span
                                        class="text-success text-bold">+{{ number_format($feedbackChangePercentage, 0) }}%</span>
                                @elseif ($feedbackChangePercentage < 0)
                                    <span
                                        class="text-danger text-bold">-{{ number_format($feedbackChangePercentage, 0) }}%</span>
                                @else
                                    <span class="text-bold">{{ number_format($feedbackChangePercentage, 0) }}%</span>
                                @endif
                                <span class="text-sm">than last six months</span>
                            </p>
                            {{-- <hr class="dark horizontal"> --}}
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto me-1"></i>
                                <p class="mb-0 text-sm"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mt-4 mb-4">
                    <div class="card z-index-2  ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 "> Customer Complaint </h6>
                            <p>
                                @if ($complaintChangePercentage > 0)
                                    <span
                                        class="text-danger text-bold">+{{ number_format($complaintChangePercentage, 0) }}%</span>
                                @elseif ($complaintChangePercentage < 0)
                                    <span
                                        class="text-success text-bold">-{{ number_format($feedbackChangePercentage, 0) }}%</span>
                                @else
                                    <span class="text-bold">{{ number_format($complaintChangePercentage, 0) }}%</span>
                                @endif
                                <span class="text-sm">than last six months</span>
                            </p>
                            {{-- <hr class="dark horizontal"> --}}
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto me-1"></i>
                                <p class="mb-0 text-sm"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mb-3">
                    <div class="card z-index-2 ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-info shadow-info border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 ">Trainings</h6>
                            <p>
                                <span class="text-bold text-success">95%</span>
                                <span class="text-sm">on time vs scheduled</span>
                            </p>
                            {{-- <hr class="dark horizontal"> --}}
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto me-1"></i>
                                <p class="mb-0 text-sm"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Policy Document -->
            <div class="row mb-4">
                <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
                    <div class="card my-4">

                        <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Policy Documents</h6>
                            </div>
                        </div>

                        <div class="card-body ps-3 pe-2 pb-5 pt-4">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                                S No.</th>
                                            <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                                Document No.</th>
                                            <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                                Name</th>
                                            <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                                Effective Date</th>
                                            <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                                Revision No.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($policies as $policy)
                                            <tr>
                                                <td class="align-middle text-center text-sm">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    {{ $policy->doc_no }}
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    {{ $policy->doc_name }}
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    {{ $policy->eff_date }}
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    {{ $policy->revision_no }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>


            </div>

            <!-- QA SOps -->

            <div class="row mb-4">
                <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">QA SOPs</h6>
                            </div>
                        </div>

                        @if (session('status'))
                            <div class="px-3">
                                <div class="alert alert-secondary alert-dismissible text-white fade show" role="alert">
                                    <small>{{ session('status') }}</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif

                        <div class="card-body ps-3 pe-2 pb-5 pt-4">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                                S No.</th>
                                            <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                                Document No.</th>
                                            <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                                Name</th>
                                            <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                                Effective Date</th>
                                            <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                                Revision No.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sops as $sop)
                                            <tr>
                                                <td class="align-middle text-center text-sm">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    {{ $sop->doc_no }}
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    {{ $sop->doc_name }}
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    {{ $sop->eff_date }}
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    {{ $sop->revision_no }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var ctx = document.getElementById("chart-bars").getContext("2d");

            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: ["Ex.", "Good", "Low", "Avg.", "Poor"],
                    datasets: [{
                        label: "Feedback",
                        tension: 0.4,
                        borderWidth: 0,
                        borderRadius: 6,
                        borderSkipped: false,
                        backgroundColor: "rgba(255, 255, 255, .8)",
                        data: @json(array_values($feedback)),
                        maxBarThickness: 6
                    }, ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5],
                                color: 'rgba(255, 255, 255, .2)'
                            },
                            ticks: {
                                suggestedMin: 0,
                                suggestedMax: 500,
                                beginAtZero: true,
                                padding: 10,
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                                color: "#fff"
                            },
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5],
                                color: 'rgba(255, 255, 255, .2)'
                            },
                            ticks: {
                                display: true,
                                color: '#f8f9fa',
                                padding: 10,
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            })



            var ctx2 = document.getElementById("chart-line").getContext("2d");

            new Chart(ctx2, {
                type: "line",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
                    datasets: [{
                        label: "Mobile apps",
                        tension: 0,
                        borderWidth: 0,
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(255, 255, 255, .8)",
                        pointBorderColor: "transparent",
                        borderColor: "rgba(255, 255, 255, .8)",
                        borderColor: "rgba(255, 255, 255, .8)",
                        borderWidth: 4,
                        backgroundColor: "transparent",
                        fill: true,
                        data: @json(array_values($complaintCount)),
                        maxBarThickness: 6

                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5],
                                color: 'rgba(255, 255, 255, .2)'
                            },
                            ticks: {
                                display: true,
                                color: '#f8f9fa',
                                padding: 10,
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#f8f9fa',
                                padding: 10,
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });

            var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

            new Chart(ctx3, {
                type: "line",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
                    datasets: [{
                        label: "Mobile apps",
                        tension: 0,
                        borderWidth: 0,
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(255, 255, 255, .8)",
                        pointBorderColor: "transparent",
                        borderColor: "rgba(255, 255, 255, .8)",
                        borderWidth: 4,
                        backgroundColor: "transparent",
                        fill: true,
                        data: [1, 1, 3, 2, 0, 1],
                        maxBarThickness: 6

                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5],
                                color: 'rgba(255, 255, 255, .2)'
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: '#f8f9fa',
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#f8f9fa',
                                padding: 10,
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });

        });
    </script>
@endsection
