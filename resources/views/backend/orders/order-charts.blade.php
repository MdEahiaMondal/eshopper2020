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
            <h2>Order Charts</h2>
        </div>
        <div class="col-lg-2">
            <div class="ibox-tools">
            </div>
        </div>
    </div>

    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <?php

    $dataPoints = array(
        array("label"=> "$cuur_month", "y"=> "$current_month_order"),
        array("label"=> "$last_mo", "y"=> "$last_month_order"),
        array("label"=> "$last_to_last_mo", "y"=> $last_to_last_month_order),
    );

    ?>
@endsection

@push('script')
    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "Order item in last 3 month"
                },
                axisY: {
                    title: "Number of Orders",
                    includeZero: false
                },
                data: [{
                    type: "column",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>
@endpush
