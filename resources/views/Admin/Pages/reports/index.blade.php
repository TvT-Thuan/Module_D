@extends('Admin.Layouts.main')
@section('main')
    @include('Admin.Layouts.sidebar')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        @include('Admin.Layouts.nav')

        <div class="mb-3 pt-3 pb-2">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                <h2 class="h4">Place Capacity</h2>
            </div>
        </div>
        {{-- @dd($campaign->totalRegistrationSessions()) --}}
        <canvas id="myChart"></canvas>
    </main>
@endsection
@push('js')
    <script src="{{ asset('assets/js/chart/Chart.min.js') }}"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($campaign->titleSessions()) !!},
                datasets: [{
                    label: 'Citizen',
                    backgroundColor: {!! json_encode($campaign->colorChartReportSessions()) !!},
                    data: {!! json_encode($campaign->totalRegistrationSessions()) !!}
                }, {
                    label: 'Campacity',
                    backgroundColor: '#cbdfac',
                    data: {!! json_encode($campaign->capacitySessions()) !!}
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Capacity'
                        },
                        gridLines: {
                            display: false
                        },
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Sessions'
                        },
                    }]
                },
                legend: {
                    position: 'right'
                }
            }
        });
    </script>
@endpush
