<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" >

</head>
<body id="admin">

<header>
       <x-navbar />
       
    </header>

    <div class="container-fluid" style="min-height:550px">

<div class="row">
<div class="col-sm-4" >
<div style="font-size: 15px;font-weight: bold;padding-top:20px">Current Categories</div>
<div class="container" style=" margin-top: 70px;">
@foreach($crops as $crop)
<div class="row">
<div class="col-6 text-center"  style="background-color: aquamarine;padding: 12px;border-radius: 8px;margin-bottom: 20px;">
{{$crop['name']}}
</div></div>
@endforeach
</div>
</div>

<div class="col-sm-8" > 
  <div ><span style="font-size: 50px;">This Month</span> <button class="btn btn-primary" style="float: right;margin-top: 13px;">Generate Report</button>  </div>
<div id="piechart" style="height:400px;width:600px"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
 
        function drawChart() {
 
        var data = google.visualization.arrayToDataTable([
            ['category Name', 'Harvest(kg)'],
 
            <?php
                foreach($data as $d) {
                    echo "['".$d->crop_name."', ".$d->amount."],";
                }
                ?>
        ]);
 
          var options = {
            title: 'Cumulative Harvest',
            is3D: true,
          };
 
          var chart = new google.visualization.PieChart(document.getElementById('piechart'));
 
          chart.draw(data, options);
        }
      </script>
</div>

</div>




   </div>
<x-footer />
</body>

<html>


