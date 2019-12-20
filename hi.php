
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<div id="canvas-holder" style="width: 600px;">
  <canvas id="chart-area" width="300" height="300" />
</div>

<div id="chartjs-tooltip"></div>    
<style>
#canvas-holder {
  width: 100%;
  margin-top: 50px;
  text-align: center;
}

#chartjs-tooltip {
  opacity: 1;
  position: absolute;
  background: rgba(0, 0, 0, .7);
  color: white;
  border-radius: 3px;
  -webkit-transition: all .1s ease;
  transition: all .1s ease;
  pointer-events: none;
  -webkit-transform: translate(-50%, 0);
  transform: translate(-50%, 0);
}

.chartjs-tooltip-key {
  display: inline-block;
  width: 10px;
  height: 10px;
  margin-right: 10px;
}
</style>

<div id="chartjs-tooltip"></div>
<script>
window.chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(231,233,237)'
};

Chart.defaults.global.tooltips.custom = function(tooltip) {
  // Tooltip Element
  var tooltipEl = document.getElementById('chartjs-tooltip');

  // Hide if no tooltip
  if (tooltip.opacity === 0) {
    tooltipEl.style.opacity = 0;
    return;
  }

  // Set Text
  if (tooltip.body) {
    var total = 0;

    // get the value of the datapoint
    var value = this._data.datasets[tooltip.dataPoints[0].datasetIndex].data[tooltip.dataPoints[0].index].toLocaleString();

    // calculate value of all datapoints
  this._data.datasets[tooltip.dataPoints[0].datasetIndex].data.forEach(function(e) {
      total += e;
    });

    // calculate percentage and set tooltip value
    tooltipEl.innerHTML = '<h1>' + (value / total * 100) + '%</h1>';
  }

  // calculate position of tooltip
  var centerX = (this._chartInstance.chartArea.left + this._chartInstance.chartArea.right) / 2;
  var centerY = ((this._chartInstance.chartArea.top + this._chartInstance.chartArea.bottom) / 2);

  // Display, position, and set styles for font
  tooltipEl.style.opacity = 1;
  tooltipEl.style.left = centerX + 'px';
  tooltipEl.style.top = centerY + 'px';
  tooltipEl.style.fontFamily = tooltip._fontFamily;
  tooltipEl.style.fontSize = tooltip.fontSize;
  tooltipEl.style.fontStyle = tooltip._fontStyle;
  tooltipEl.style.padding = tooltip.yPadding + 'px ' + tooltip.xPadding + 'px';
};

var config = {
  type: 'doughnut',
  data: {
    datasets: [{
      data: [300, 50, 100, 40, 10],
      backgroundColor: [
        window.chartColors.red,
        window.chartColors.orange,
        window.chartColors.yellow,
        window.chartColors.green,
        window.chartColors.blue,
      ],
    }],
    labels: [
      "Red",
      "Orange",
      "Yellow",
      "Green",
      "Blue"
    ]
  },
  options: {
    responsive: true,
    legend: {
      display: true,
      labels: {
        padding: 20
      },
    },
    tooltips: {
      enabled: false,
    }
  }
};

window.onload = function() {
    var ctx = document.getElementById("chart-area").getContext("2d");
    window.myPie = new Chart(ctx, config);
};
</script>
