@extends('layouts.chart')
@section('content')
<div style="width:50%;" class="pull-left">
  <canvas id="canvas"></canvas>
</div>

<div style="width:50%;" class="pull-left">
  <canvas id="canvas1"></canvas>
</div>

<br><hr><br>

<div style="width:50%;" class="pull-left">
  <canvas id="canvas2"></canvas>
</div>
<div style="width:50%;" class="pull-left">
  <canvas id="canvas3"></canvas>
</div>

<script>
var res = {!! $_result !!};
var _query = {!! $_query !!};
var labels = {!! $labels !!};

createChart(res[1]['insert'] , res[2]['insert'], _query['insert']);    
createChart(res[1]['select'] , res[2]['select'], _query['select'],'canvas1');    
createChart(res[1]['update'] , res[2]['update'], _query['update'],'canvas2');    
createChart(res[1]['delete'] , res[2]['delete'], _query['delete'],'canvas3');    

function createChart( heroku , uds , query ,id = 'canvas' ){

    var chartColors = {
      red: 'rgb(255, 99, 132)',
      orange: 'rgb(255, 159, 64)',
      yellow: 'rgb(255, 205, 86)',
      green: 'rgb(75, 192, 192)',
      blue: 'rgb(54, 162, 235)',
      purple: 'rgb(153, 102, 255)',
      grey: 'rgb(231,233,237)'
    };

    var randomScalingFactor = function() {
      return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
    }
    var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var config = {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: "Heroku",
          backgroundColor: chartColors.red,
          borderColor: chartColors.red,
          data: heroku,
          fill: false,
        }, {
          label: "UDS",
          fill: false,
          backgroundColor: chartColors.blue,
          borderColor: chartColors.blue,
          data: uds,
        }]
      },
      options: {
        responsive: true,
        title: {
          display: true,
          text: query,
        },
        tooltips: {
          mode: 'label',

          itemSort: function(a, b) {
            return b.datasetIndex - a.datasetIndex
          },

        },
        hover: {
          mode: 'nearest',
          intersect: true
        },
        scales: {
          xAxes: [{
            display: true,
            ticks: {
              userCallback: function(label, index, labels) {
                if (typeof label === "string") {
                  return label.substring(0, 1)
                }
                return label

              },
            },
            scaleLabel: {
              display: true,
              labelString: 'Month'
            }
          }],
          yAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Value'
            }
          }]
        }
      }
    };

    var ctx = document.getElementById(id).getContext("2d");
    window.myLine = new Chart(ctx, config);
}
</script>
@endsection