@extends('layouts.app')

@section('title', Auth::user()->name ."s Homepage")

@section('content')

    <!-- Welcome pannel -->
    <!--@include('panels.welcome-panel')-->

    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL EVENTS</div>
                    <div class="number count-to" data-from="0" data-to="{{ $totalIncidents }}" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">help</i>
                </div>
                <div class="content">
                    <div class="text">UNATTENDED</div>
                    <div class="number count-to" data-from="0" data-to="{{ $totalUnAttendeIncidents }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">forum</i>
                </div>
                <div class="content">
                    <div class="text">IN PROGRESS</div>
                    <div class="number count-to" data-from="0" data-to="{{ $totalInProgressIncidents }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                    <div class="text">CLOSED</div>
                    <div class="number count-to" data-from="0" data-to="{{ $totalClosedIncidents }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->
    <!-- CPU Usage -->
    <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h2>TOTAL EVENTS - FINANCIAL YEAR</h2>
                        </div>
                    </div>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="/incidents">View More</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div id="real_time_chart" class="dashboard-flot-chart"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# CPU Usage -->
    <div class="row clearfix">
        <!-- Visitors -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="body bg-pink">
                    <div class="sparkline" 
                        data-type="line" 
                        data-spot-Radius="4" 
                        data-highlight-Spot-Color="rgb(233, 30, 99)" 
                        data-highlight-Line-Color="#fff"
                        data-min-Spot-Color="rgb(255,255,255)" 
                        data-max-Spot-Color="rgb(255,255,255)" 
                        data-spot-Color="rgb(255,255,255)"
                        data-offset="90" 
                        data-width="100%" 
                        data-height="92px" 
                        data-line-Width="2" 
                        data-line-Color="rgba(255,255,255,0.7)"
                        data-fill-Color="rgba(0, 188, 212, 0)">
                        {{ $eventsCreatedLWeek }}, {{ $eventsCreatedYesterday }}, {{ $eventsCreatedToday }}
                    </div>
                    <ul class="dashboard-stat-list">
                        <li>
                            LAST WEEK
                            <span class="pull-right"><b>{{ $eventsCreatedLWeek }}</b> <small>EVENTS</small></span>
                        </li>
                        <li>
                            YESTERDAY
                            <span class="pull-right"><b>{{ $eventsCreatedYesterday }}</b> <small>EVENTS</small></span>
                        </li>
                        <li>
                            TODAY
                            <span class="pull-right"><b>{{ $eventsCreatedToday }}</b> <small>EVENTS</small></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #END# Visitors -->
        <!-- Latest Social Trends -->
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="card">
                <div class="body bg-white">
                    <div class="m-b--35 font-bold">TOTAL EVENTS BY HOSPITALS</div>
                    <br/><br/><br/><br/>
                    <canvas id="barCanvas2"></canvas>
                </div>
            </div>
        </div>
        <!-- #END# Latest Social Trends -->
        <!-- Answered Tickets -->
        <!--<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="body bg-teal">
                    <div class="font-bold m-b--35">ANSWERED TICKETS</div>
                    <ul class="dashboard-stat-list">
                        <li>
                            TODAY
                            <span class="pull-right"><b>12</b> <small>TICKETS</small></span>
                        </li>
                        <li>
                            YESTERDAY
                            <span class="pull-right"><b>15</b> <small>TICKETS</small></span>
                        </li>
                        <li>
                            LAST WEEK
                            <span class="pull-right"><b>90</b> <small>TICKETS</small></span>
                        </li>
                        <li>
                            LAST MONTH
                            <span class="pull-right"><b>342</b> <small>TICKETS</small></span>
                        </li>
                        <li>
                            LAST YEAR
                            <span class="pull-right"><b>4 225</b> <small>TICKETS</small></span>
                        </li>
                        <li>
                            ALL
                            <span class="pull-right"><b>8 752</b> <small>TICKETS</small></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>-->
        <!-- #END# Answered Tickets -->
    </div>

    <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="body bg-white">
                    <div class="m-b--35 font-bold">TOTAL EVENTS BY CATEGORIES</div>
                    <br/><br/><br/><br/>
                    <canvas id="barCanvas"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="body bg-white">
                    <div class="m-b--35 font-bold">TOTAL EVENTS BY GRADING</div>
                    <br/><br/><br/><br/>
                    <canvas id="barCanvas1"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="card">
                <div class="header">
                    <h2>EVENT TYPES</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Event Type</th>
                                    <th>Grand Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($types as $type)
                                    <tr>
                                        <td>{{ $type['id'] }}</td>
                                        <td>{{ $type['name'] }}</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: {{ $type['value'] }}%"></div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Task Info -->
        <!-- Browser Usage -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="header">
                    <h2>MORTALITY</h2>
                </div>
                <div class="body">
                    <div id="donut_chart" class="dashboard-donut-chart"></div>
                </div>
            </div>
        </div>
        <!-- #END# Browser Usage -->
    </div>

    <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>EVENTS BY DURATON TO CLOSE OFF</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Event Type</th>
                                    <th>Hospital</th>
                                    <th>Investigator</th>
                                    <th>Time Taken</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($eventsByDuration) > 0)
                                    @foreach($eventsByDuration as $event)
                                        <tr>
                                            <td>{{ $event['id'] }}</td>
                                            <td>{{ $event['label'] }}</td>
                                            <td>{{ $event['hospital'] }}</td>
                                            <td>{{ $event['investigator'] }}</td>
                                            <td>{{ $event['time_taken'] }}</td>
                                        </tr>
                                    @endforeach
                                @else 
                                    <tr>
                                        <td colspan="5" class="text-center"><h3>Nothing yet.</h3></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- Morris Plugin Js -->
    <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('plugins/morrisjs/morris.js') }}"></script>

    <!-- ChartJs -->
    <script src="{{ asset('plugins/chartjs/Chart.bundle.js') }}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{{ asset('plugins/flot-charts/jquery.flot.js') }}"></script>
    <script src="{{ asset('plugins/flot-charts/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('plugins/flot-charts/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('plugins/flot-charts/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('plugins/flot-charts/jquery.flot.time.js') }}"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
    
    <!-- Custom Js -->
    <script src="{{ asset('js/pages/tables/jquery-datatable.js') }}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{ asset('plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>

    <script src="{{ asset('js/underscore/underscore.min.js') }}"></script>

    <!-- Custom Js -->
    <script>
    
        $(function () {

            //Widgets count
            $('.count-to').countTo();

            //Sales count to
            $('.sales-count-to').countTo({
                formatter: function (value, options) {
                    return '$' + value.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, ' ').replace('.', ',');
                }
            });

            initRealTimeChart();
            initDonutChart();
            initSparkline();
            initBarChart();
            initBarChartTwo();
            initBarChartThree();
        });

        function initBarChart() {
            var _data = JSON.stringify({!! $categoryData !!});
            _data = JSON.parse(_data);

            let data = {
                labels: _.pluck(_data, 'label'),
                datasets: [
                    {
                        backgroundColor: '#96cbf3',
                        borderColor: '#60b0ee',
                        borderWidth: 1,
                        data: _.pluck(_data, 'value')
                    }
                ]
            }
            
            let chartOptions = {
                maintainAspectRatio: true,
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            min: 0
                        }
                    }]
                }
            }

            var ctx = document.getElementById("barCanvas").getContext("2d");
            new Chart(ctx, {
                type: 'horizontalBar',
                data: data,
                options: chartOptions
            })
        }

        function initBarChartTwo() {
            var _data = JSON.stringify({!! $gradingData !!});
            _data = JSON.parse(_data);

            let data = {
                labels: _.pluck(_data, 'label'),
                datasets: [
                    {
                        backgroundColor: '#ffabbb',
                        borderColor: '#ff6b88',
                        borderWidth: 1,
                        data: _.pluck(_data, 'value')
                    }
                ]
            }
            
            let chartOptions = {
                maintainAspectRatio: true,
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            min: 0
                        }
                    }]
                }
            }

            var ctx = document.getElementById("barCanvas1").getContext("2d");
            new Chart(ctx, {
                type: 'bar',
                data: data,
                options: chartOptions
            })
        }

        function initBarChartThree() {
            var _data = JSON.stringify({!! $organisationData !!});
            _data = JSON.parse(_data);

            let data = {
                labels: _.pluck(_data, 'label'),
                datasets: [
                    {
                        backgroundColor: '#ffabbb',
                        borderColor: '#ff6b88',
                        borderWidth: 1,
                        data: _.pluck(_data, 'value')
                    }
                ]
            }
            
            let chartOptions = {
                maintainAspectRatio: true,
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            min: 0
                        }
                    }]
                }
            }

            var ctx = document.getElementById("barCanvas2").getContext("2d");
            new Chart(ctx, {
                type: 'bar',
                data: data,
                options: chartOptions
            })
        }        

        function initRealTimeChart() {
            //Real time ==========================================================================================
            var _data = JSON.stringify({!! $events !!});
            var _labels = JSON.stringify({!! $monthDataLabels !!});
            _labels = JSON.parse(_labels);
            _data = JSON.parse(_data);

            var plot = $.plot('#real_time_chart', [_data], {
                series: {
                    shadowSize: 0,
                    color: 'rgb(0, 188, 212)'
                },
                grid: {
                    borderColor: '#f3f3f3',
                    borderWidth: 1,
                    tickColor: '#f3f3f3'
                },
                lines: {
                    fill: true
                },
                yaxis: {
                    min: 0,
                    // max: 100
                },
                xaxis: {
                    min: 1,
                    max: 12,
                    ticks:_labels
                }
            });

            //====================================================================================================
        }

        function initSparkline() {
            $(".sparkline").each(function () {
                var $this = $(this);
                $this.sparkline('html', $this.data());
            });
        }

        function initDonutChart() {
            var _data = JSON.stringify({!! $deaths !!});
            _data = JSON.parse(_data);

            console.log(_data);
            
            Morris.Donut({
                element: 'donut_chart',
                data: _data,
                colors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 152, 0)', 'rgb(0, 150, 136)', 'rgb(96, 125, 139)', 'rgb(3, 300, 300)', 'rgb(80, 70, 139)'],
                formatter: function (y) {
                    return y
                }
            });
        }

        var data = [], totalPoints = 110;
        function getRandomData() {
            if (data.length > 0) data = data.slice(1);

            while (data.length < totalPoints) {
                var prev = data.length > 0 ? data[data.length - 1] : 50, y = prev + Math.random() * 10 - 5;
                if (y < 0) { y = 0; } else if (y > 100) { y = 100; }

                data.push(y);
            }

            var res = [];
            for (var i = 0; i < data.length; ++i) {
                res.push([i, data[i]]);
            }

            console.log(res)
            return res;
        }
    </script>

    <!-- Demo Js -->
    <script src="{{ asset('js/demo.js') }}"></script>
@endsection