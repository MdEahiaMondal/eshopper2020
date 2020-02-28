@extends('backend.layouts.master')

@section('content')

    @php
     $date = \Carbon\Carbon::now();
     $current_month = $date->format('F'); // July
     $last_month = $date->subMonth()->format('F'); // June

     $cuur_month = date('M');
     $last_mo = date('M', strtotime('-1 month'));
     $last_to_last_mo = date('M', strtotime('-2 month'));
    @endphp

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Users Charts</h2>
        </div>
        <div class="col-lg-2">
            <div class="ibox-tools">
            </div>
        </div>
    </div>

    <div id="chartContainer" style="height: 370px; width: 100%; margin-top: 50px"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>



    @php
        $dataPoints = array();
            foreach ($users as $user){
                $dataPoints[] =   array("label"=>"$user->country", "y"=>$user->count);
            }
    @endphp

@endsection

@push('script')
    <script>
        window.onload = function() {


            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Country wise users"
                },
                subtitles: [{
                    text: "{{ \Carbon\Carbon::now()->monthName }} - {{\Carbon\Carbon::now()->year}}"
                }],
                data: [{
                    type: "pie",
                    yValueFormatString: "",
                    indexLabel: "{label} ({y})",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>
@endpush
