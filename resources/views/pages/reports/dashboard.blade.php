@extends('layouts.appReports')

@section('content')
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        My Voice Reports
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Hospital Name</th>
                                    <th>Complaints per Hospital</th>
                                    <th>Transport Complaints</th>
                                    <th>Compliments per Hospital</th>
                                    <th>Transport Compliments</th>
                                    <th>Surveys Per Hospitals</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hospitals as $hospital)
                                    <tr>
                                        <td>{{ $hospital->nick }}</td>
                                        <td>{{ $hospital->overallComplaints() }}</td>
                                        <td>{{ $hospital->transportComplaints() }}</td>
                                        <td>{{ $hospital->overallCompliments() }}</td>
                                        <td>{{ $hospital->transportCompliments() }}</td>
                                        <td>{{ $hospital->surveys->count() }}</td>
                                    </tr>
                                @endforeach
                                <tr style="font-weight: bold">
                                    <td>Grand Total</td>
                                    <td>{{ $totalOverallComplaints }}</td>
                                    <td>{{ $totalTransportComplaints }}</td>
                                    <td>{{ $totalOverallCompliments }}</td>
                                    <td>{{ $totalTransportCompliments }}</td>
                                    <td>{{ $totalSurveys }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Basic Examples -->

    <div class="row clearfix">
        <!-- Bar Chart -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Compliments vs Complaints vs Surveys</h2>
                </div>
                <div class="body" style="height: 400px">
                    <canvas id="overall_comparisons" height="150"></canvas>
                </div>
            </div>
        </div>
        <!-- #END# Bar Chart -->
    </div>

    <div class="row clearfix">
        <!-- Line Chart -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Compliments Per Hospital</h2>
                </div>
                <div class="body" style="height: 400px">
                    <canvas id="pie_chart_compliments" height="150"></canvas>
                </div>
            </div>
        </div>
        <!-- #END# Line Chart -->
        <!-- Line Chart -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Complaints Per Hospital</h2>
                </div>
                <div class="body" style="height: 400px">
                    <canvas id="pie_chart_complaints" height="150"></canvas>
                </div>
            </div>
        </div>
        <!-- #END# Line Chart -->
        <!-- Line Chart -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Surveys Per Hospital</h2>
                </div>
                <div class="body" style="height: 400px">
                    <canvas id="pie_chart_surveys" height="150"></canvas>
                </div>
            </div>
        </div>
        <!-- #END# Line Chart -->
    </div>

    <!-- Hospital Wards Examples -->
    <div class="row clearfix">
        <div class="col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Detailed Complaints Analysis
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Wards/Unit</th>
                                    @foreach($hospitals as $hospital)
                                        <th>{{ $hospital->nick }}</th>
                                    @endforeach
                                    <th>Grand Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wardChartData as $ward)
                                <tr>
                                    <td>{{ $ward->title }}</td>
                                    @foreach($ward->hospitalData as $hospitalData)
                                        <td>{{ $hospitalData->complaints }}</td>
                                    @endforeach
                                    <td>{{ $ward->total }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Basic Examples -->

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Detailed Complaints Analysis by Wards</h2>
                </div>
                <div class="body" style="height: 350px;">
                    <canvas id="bar_chart_wards_comparisons" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="block-header">
        <h2>Detailed Complaints Analysis by Wards Per Hospital</h2>
    </div>
    <div class="row clearfix">
        <!--  -->
        @foreach($hospitals as $hospital)
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2> {{ $hospital->nick }} Complaint Analysis</h2>
                    </div>
                    <div class="body" style="height: 400px">
                        <canvas id="pie_chart_complaints_{{ $hospital->id }}" height="150"></canvas>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Hospital Wards Examples -->
    <div class="row clearfix">
        <div class="col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Number of surveys completed per hospital per ward
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Unit\Ward</th>
                                    @foreach($hospitals as $hospital)
                                        <th>{{ $hospital->nick }}</th>
                                    @endforeach
                                    <th>Grand Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wardChartData as $ward)
                                <tr>
                                    <td>{{ $ward->title }}</td>
                                    @foreach($ward->hospitalData as $hospitalData)
                                        <td>{{ $hospitalData->surveys }}</td>
                                    @endforeach
                                    <td>{{ $ward->total }}</td>
                                </tr>
                                @endforeach                                                                                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Basic Examples -->

    <div class="block-header">
        <h2>*** Would you recommend the selected hospital to someone else?</h2>
    </div>
    <!-- % Recomendation -->
    <div class="row clearfix">
        <div class="col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        % Recommendation
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Hospital</th>
                                    <th>No</th>
                                    <th>Yes</th>
                                    <th>% Recomendation(Yes)</th>
                                    <th>Grand Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hospitals as $hospital)
                                <tr>
                                    <td>{{ $hospital->nick }}</td>
                                    <td>{{ $hospital->_recomendations->no }}</td>
                                    <td>{{ $hospital->_recomendations->yes }}</td>
                                    <td>{{ $hospital->_recomendations->percentageYes }} %</td>
                                    <td>{{ $hospital->_recomendations->total }}</td>
                                </tr>
                                @endforeach                                                                                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Basic Examples -->  

    <div class="block-header">
        <h2>*** The competence and professionalism of the nursing staff?</h2>
    </div>
    <!-- % Recomendation -->
    <div class="row clearfix">
        <div class="col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Nursing
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Hospital</th>
                                    @foreach($ratings as $rating)
                                        <th>{{ $rating->name }}</th>
                                    @endforeach
                                    <th>Grand Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hospitals as $hospital)
                                <tr>
                                    <td>{{ $hospital->nick }}</td>
                                    @foreach($hospital->_professionalism as $_professionalism)
                                        <td>{{ $_professionalism->value }}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# -->

    <!-- % Recomendation -->
    <div class="row clearfix">
        <div class="col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Nursing > 90%
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Hospital</th>
                                    <th>Excellent/Good</th>
                                    <th>Total Surveys</th>
                                    <th>Nursing > 90%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hospitals as $hospital)
                                    @php
                                        $goodExc = $hospital->_professionalism->whereIn('name', ['Excellent', 'Good'])->sum('value');
                                        $gTotal = $hospital->_professionalism->whereIn('name', ['Grand Total'])->sum('value');
                                        $percentage = $goodExc > 0 ? ceil(($goodExc/$gTotal)*100) : 0;
                                    @endphp

                                    @if($percentage > 90)
                                        <tr>
                                            <td>{{ $hospital->nick }}</td>
                                            <td>{{ $goodExc }}</td>
                                            <td>{{ $gTotal }}</td>
                                            <td>{{ $percentage }} %</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# -->        

    <!-- Cleanliness -->
    <div class="row clearfix">
        <div class="col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Cleanliness > 90%
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Hospital</th>
                                    <th>Excellent/Good</th>
                                    <th>Total Surveys</th>
                                    <th>Nursing > 90%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hospitals as $hospital)
                                    @php
                                        $goodExc = $hospital->_cleanliness->whereIn('name', ['Excellent', 'Good'])->sum('value');
                                        $gTotal = $hospital->_cleanliness->whereIn('name', ['Grand Total'])->sum('value');
                                        $percentage = $goodExc > 0 ? ceil(($goodExc/$gTotal)*100) : 0;
                                    @endphp

                                    @if($percentage > 90)
                                        <tr>
                                            <td>{{ $hospital->nick }}</td>
                                            <td>{{ $goodExc }}</td>
                                            <td>{{ $gTotal }}</td>
                                            <td>{{ $percentage }} %</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cleanliness -->


    <!-- % Catering -->
    <div class="block-header">
        <h2>*** How would you rate the quality of the food served?</h2>
    </div>
    <div class="row clearfix">
        <div class="col-xs-12">
            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Hospital</th>
                                    @foreach($ratings as $rating)
                                        <th>{{ $rating->name }}</th>
                                    @endforeach
                                    <th>Grand Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hospitals as $hospital)
                                <tr>
                                    <td>{{ $hospital->nick }}</td>
                                    @foreach($hospital->_quality as $_quality)
                                        <td>{{ $_quality->value }}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Catering > 90%
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Hospital</th>
                                    <th>Excellent/Good</th>
                                    <th>Total Surveys</th>
                                    <th>Nursing > 90%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hospitals as $hospital)
                                    @php
                                        $goodExc = $hospital->_quality->whereIn('name', ['Excellent', 'Good'])->sum('value');
                                        $gTotal = $hospital->_quality->whereIn('name', ['Grand Total'])->sum('value');
                                        $percentage = $goodExc > 0 ? ceil(($goodExc/$gTotal)*100) : 0;
                                    @endphp

                                    @if($percentage > 90)
                                        <tr>
                                            <td>{{ $hospital->nick }}</td>
                                            <td>{{ $goodExc }}</td>
                                            <td>{{ $gTotal }}</td>
                                            <td>{{ $percentage }} %</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# -->
    <!-- End Cleanliness -->
@endsection

@section('scripts')
    <script src="{{ asset('js/underscore/underscore.min.js') }}"></script>

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
    
    <!-- Chart Plugins Js -->
    <script src="{{ asset('plugins/chartjs/Chart.bundle.js') }}"></script>

    <script src="{{ asset('js/pieceLabel.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('js/pages/tables/jquery-datatable.js') }}"></script>

    <!-- Demo Js -->
    <script src="{{ asset('js/demo.js') }}"></script>
    <script>
        $(function () {
            
            // Overall Comparisons
            new Chart(document.getElementById("overall_comparisons").getContext("2d"), getComparisonsChartData());

            // Pie Chart data for [Compliments, Complaints, Surveys]
            new Chart(document.getElementById("pie_chart_compliments").getContext("2d"), getComplimentsPieData());
            new Chart(document.getElementById("pie_chart_complaints").getContext("2d"), getComplaintsPieData());
            new Chart(document.getElementById("pie_chart_surveys").getContext("2d"), getSurveysPieData());

            @foreach($hospitals as $hospital)
            new Chart(document.getElementById("pie_chart_complaints_{{ $hospital->id }}").getContext("2d"), getPieData({!! $hospital !!}));
            @endforeach

            // Chart data for hospitals per wards
            new Chart(document.getElementById("bar_chart_wards_comparisons").getContext("2d"), getBarData());
            // new Chart(document.getElementById("radar_chart").getContext("2d"), getChartJs('radar'));
        });

        function gimmeColor(size) {
            var colors = [];

            for(var i = 0; i < size; i++) {
                var leRandomVal = Math.random() * 360 * ( i + 1 );
                var _color = '#' + ('00000' + (leRandomVal * (1<<24)|0 ).toString(16) ).slice(-6);
                //var _color = "hsl(" + leRandomVal.toFixed(2) + ",100%,50%)"; //Uncomment this line for HSL color generator
                colors.push(_color);
            }

            if (size === 1)
                return colors[0];

            return colors;
        }

        function getBarData() {
            var hospitals = {!! $hospitals !!};
            var wards     = {!! $wardChartData !!};
            var datasets  = [];

            for(var xx in wards) {
                
                var ward  = wards[xx];
                var color = gimmeColor(1);

                datasets.push({
                    label: ward.title,
                    data: _.pluck(ward.hospitalData, 'complaints'),
                    borderColor: color,
                    backgroundColor: color,
                    pointBorderColor: color,
                    pointBackgroundColor: color,
                    pointBorderWidth: 1
                });
            }


            var config = {
                type: 'bar',
                data: {
                    labels: _.pluck(hospitals, 'nick'),
                    datasets: datasets
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: true
                    }
                }
            }

            return config;
        }

        function getComparisonsChartData() {
            var hospitals = {!! $hospitals !!};
            var colors = gimmeColor(hospitals.length);
            
            var config = {
                type: 'bar',
                data: {
                    labels: _.pluck(hospitals, 'nick'),
                    datasets: [{
                        label: "Compliments Per Hospital",
                        data: _.pluck(hospitals, '_compliments'),
                        borderColor: '#e61a58',
                        backgroundColor: '#e61a58',
                        pointBorderColor: '#e61a58',
                        pointBackgroundColor: '#e61a58',
                        pointBorderWidth: 1
                    },
                    {
                        label: "Complaints Per Hospital",
                        data: _.pluck(hospitals, '_complaints'),
                        borderColor: '#00b4ce',
                        backgroundColor: '#00b4ce',
                        pointBorderColor: '#00b4ce',
                        pointBackgroundColor: '#00b4ce',
                        pointBorderWidth: 1
                    },
                    {
                        label: "Surveys Per Hospital",
                        data: _.pluck(hospitals, '_surveys'),
                        borderColor: '#ff8d00',
                        backgroundColor: '#ff8d00',
                        pointBorderColor: '#ff8d00',
                        pointBackgroundColor: '#ff8d00',
                        pointBorderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: true
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
            }
 
            return config;
        }

        function getComplimentsPieData() {
            var hospitals = {!! $hospitals !!};
            var colors = gimmeColor(hospitals.length);
            var config = {
                type: 'pie',
                data: {
                    datasets: [{
                        label: "Compliments Per Hospital",
                        data: _.pluck(hospitals, '_compliments'),
                        backgroundColor: colors,
                    }],
                    labels: _.pluck(hospitals, 'nick')
                },
                options: {
                    responsive: true,
                    legend: {
                        display: true,
                        position: 'right'
                    },
                    pieceLabel: {
                        render: function (args) {
                            return args.value;
                        },
                        fontColor: 'white',
                        fontSize: 18
                    },
                }
            }

            return config;
        }

        function getComplaintsPieData() {
            var hospitals = {!! $hospitals !!};
            var colors = gimmeColor(hospitals.length);
            var config = {
                type: 'pie',
                data: {
                    datasets: [{
                        label: "Complaints Per Hospital",
                        data: _.pluck(hospitals, '_complaints'),
                        backgroundColor: colors,
                    }],
                    labels: _.pluck(hospitals, 'nick')
                },
                options: {
                    responsive: true,
                    legend: {
                        display: true,
                        position: 'right'
                    },
                    pieceLabel: {
                        render: function (args) {
                            return args.value;
                        },
                        fontColor: 'white',
                        fontSize: 18
                    },
                }
            }

            return config;
        }

        function getPieData(hospital) {
            var wards  = hospital.wards;
            var colors = gimmeColor(wards.length);
            var config = {
                type: 'pie',
                data: {
                    datasets: [{
                        label: "Complaints Per Hospitals Wards",
                        data: _.pluck(wards, '_complaints'),
                        backgroundColor: colors,
                    }],
                    labels: _.pluck(wards, '_title')
                },
                options: {
                    responsive: true,
                    legend: {
                        display: true,
                        position: 'right'
                    },
                    pieceLabel: {
                        render: function (args) {
                            return args.value;
                        },
                        fontColor: 'white',
                        fontSize: 18
                    },
                }
            }

            return config;
        }

        function getSurveysPieData() {
            var hospitals = {!! $hospitals !!};
            var colors = gimmeColor(hospitals.length);
            var config = {
                type: 'pie',
                data: {
                    datasets: [{
                        label: "Surveys Per Hospital",
                        data: _.pluck(hospitals, '_surveys'),
                        backgroundColor: colors,
                    }],
                    labels: _.pluck(hospitals, 'nick')
                },
                options: {
                    responsive: true,
                    legend: {
                        display: true,
                        position: 'right'
                    },
                    pieceLabel: {
                        render: function (args) {
                            return args.value;
                        },
                        fontColor: 'white',
                        fontSize: 18
                    },
                }
            }

            return config;
        }

        function getChartJs(type) {
            var config = null;
            var hospitals = {!! $hospitals !!};
            var colors = gimmeColor(hospitals.length);

            if (type === 'line') {
                config = {
                    type: 'line',
                    data: {
                        labels: _.pluck(hospitals, 'nick'),
                        datasets: [{
                            label: "Accident And Emergency",
                            data: [Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100)],
                            borderColor: "rgb(233, 30, 99)",
                            pointBorderWidth: 1
                        },
                        {
                            label: "Adult Intensive Cate Unit",
                            data: [Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100)],
                            borderColor: "rgb(255, 193, 7)",
                            pointBorderWidth: 1
                        },
                        {
                            label: "Casualty",
                            data: [Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100)],
                            borderColor: "rgb(0, 188, 212)",
                            pointBorderWidth: 1
                        },
                        {
                            label: "Female Ward",
                            data: [Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100)],
                            borderColor: 'rgba(0, 188, 212, 0.75)',
                            pointBorderWidth: 1
                        },
                        {
                            label: "Male Ward",
                            data: [Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100)],
                            borderColor: "rgb(139, 195, 74)",
                            pointBorderWidth: 1
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        },
                        elements: {
                            line: {
                                fill: false
                            },
                            point:{
                                radius: 5
                            }                        
                        }
                    }
                }
            }
            else if (type === 'bar') {
                config = {
                    type: 'bar',
                    data: {
                        labels: _.pluck(hospitals, 'nick'),
                        datasets: [{
                            label: "Compliments Per Hospital",
                            data: _.pluck(hospitals, 'data'),
                            borderColor: '#e61a58',
                            backgroundColor: '#e61a58',
                            pointBorderColor: '#e61a58',
                            pointBackgroundColor: '#e61a58',
                            pointBorderWidth: 1
                        },
                        {
                            label: "Complaints Per Hospital",
                            data: _.pluck(hospitals, '_complaints'),
                            borderColor: '#00b4ce',
                            backgroundColor: '#00b4ce',
                            pointBorderColor: '#00b4ce',
                            pointBackgroundColor: '#00b4ce',
                            pointBorderWidth: 1
                        },
                        {
                            label: "Surveys Per Hospital",
                            data: _.pluck(hospitals, '_surveys'),
                            borderColor: '#ff8d00',
                            backgroundColor: '#ff8d00',
                            pointBorderColor: '#ff8d00',
                            pointBackgroundColor: '#ff8d00',
                            pointBorderWidth: 1
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            display: true
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
                }
            }
            else if (type === 'radar') {
                config = {
                    type: 'radar',
                    data: {
                        labels: _.pluck(hospitals, 'nick'),
                        datasets: [{
                            label: "Compliments Per Hospital",
                            data: [65, 59, 80, 81, 56, 55],
                            borderColor: 'rgba(0, 188, 212, 0.8)',
                            backgroundColor: 'rgba(0, 188, 212, 0.5)',
                            pointBorderColor: 'rgba(0, 188, 212, 0)',
                            pointBackgroundColor: 'rgba(0, 188, 212, 0.8)',
                            pointBorderWidth: 1
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: false
                    }
                }
            }
            else if (type === 'pie') {
                config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            label: "Surveys Per Hospital",
                            data: [65, 59, 80, 81, 56, 55],
                            backgroundColor: colors,
                        }],
                        labels: _.pluck(hospitals, 'nick')
                    },
                    options: {
                        responsive: true,
                        legend: {
                            display: true,
                            position: 'right'
                        },
                        pieceLabel: {
                            render: function (args) {
                                return args.value;
                            },
                            fontColor: 'white',
                            fontSize: 18
                        },
                    }
                }
            }
            return config;
        }
    </script>
@endsection