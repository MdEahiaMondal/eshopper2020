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

    <?php
    $dataPoints = array(
        array("y" =>  $current_month_users, "label" => $current_month),
        array("y" =>  $last_month_users, "label" => $last_month),
        array("y" =>  $last_to_last_Month_users, "label" => $last_to_last_mo),
    );

    ?>
@endsection

@push('script')
    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: "Users Reporting"
                },
                axisY: {
                    title: "Number of Users"
                },
                data: [{
                    type: "line",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>
@endpush
