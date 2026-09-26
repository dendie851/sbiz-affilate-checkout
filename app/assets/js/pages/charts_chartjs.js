$(function() {
  // Wrap charts
  $('.chartjs-demo').each(function() {
    $(this).wrap($('<div style="height:' + this.getAttribute('height') + 'px"></div>'));
  });


  var graphChart = new Chart(document.getElementById('chart-graph').getContext("2d"), {
    type: 'line',
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [{
        label:           'My First dataset',
        data:            [43, 91, 89, 16, 21, 79, 28],
        borderWidth:     1,
        backgroundColor: 'rgba(113, 106, 202, 0.3)',
        borderColor:     '#716aca',
        borderDash:      [5, 5],
        fill: false
      }, {
        label:           'My Second dataset',
        data:            [24, 63, 29, 75, 28, 54, 38],
        borderWidth:     1,
        backgroundColor: 'rgba(40, 208, 148, 0.3)',
        borderColor:     '#28d094',
      }],
    },

    // Demo
    options: {
      responsive: false,
      maintainAspectRatio: false
    }
  });

  var barsChart = new Chart(document.getElementById('chart-bars').getContext("2d"), {
    type: 'bar',
    data: {
      labels: ['Italy', 'UK', 'USA', 'Germany', 'France', 'Japan'],
      datasets: [{
        label: '2010 customers #',
        data: [53, 99, 14, 10, 43, 27],
        borderWidth: 1,
        backgroundColor: 'rgba(255, 73, 97, 0.3)',
        borderColor: '#ff4961'
      }, {
        label: '2014 customers #',
        data: [55, 74, 20, 90, 67, 97],
        borderWidth: 1,
        backgroundColor: 'rgba(255, 145, 73, 0.3)',
        borderColor: '#ff9149'
      }]
    },

    // Demo
    options: {
      responsive: false,
      maintainAspectRatio: false
    }
  });

  var radarChart = new Chart(document.getElementById('chart-radar').getContext("2d"), {
    type: 'radar',
    data: {
      labels: ['Eating', 'Drinking', 'Sleeping', 'Designing', 'Coding', 'Cycling', 'Running'],
      datasets: [{
        label: 'My First dataset',
        backgroundColor: 'rgba(40, 208, 148, 0.3)',
        borderColor: '#28d094',
        pointBackgroundColor: '#28d094',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: '#28d094',
        data: [39, 99, 77, 38, 52, 24, 89],
        borderWidth: 1
      }, {
        label: 'My Second dataset',
        backgroundColor: 'rgba(255, 73, 97, 0.3)',
        borderColor: '#ff4961',
        pointBackgroundColor: '#ff4961',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: '#ff4961',
        data: [6, 33, 14, 70, 58, 90, 26],
        borderWidth: 1
      }]
    },

    // Demo
    options: {
      responsive: false,
      maintainAspectRatio: false
    }
  });

  var polarAreaChart = new Chart(document.getElementById('chart-polar-area').getContext("2d"), {
    type: 'polarArea',
    data: {
      datasets: [{
        data: [ 12, 10, 14, 6, 15 ],
        backgroundColor: [ '#ff4961', '#28d094', '#ff9149', '#E7E9ED', '#716aca' ],
        label: 'My dataset'
      }],
      labels: [ 'Red', 'Green', 'Yellow', 'Grey', 'Blue' ]
    },

    // Demo
    options: {
      responsive: false,
      maintainAspectRatio: false
    }
  });

  var pieChart = new Chart(document.getElementById('chart-pie').getContext("2d"), {
    type: 'pie',
    data: {
      labels: [ 'Red', 'Blue', 'Yellow' ],
      datasets: [{
        data: [ 180, 272, 100 ],
        backgroundColor: [ '#ff4961', '#716aca', '#ff9149' ],
        hoverBackgroundColor: [ '#ff4961', '#716aca', '#ff9149' ]
      }]
    },

    // Demo
    options: {
      responsive: false,
      maintainAspectRatio: false
    }
  });
  var doughnutChart = new Chart(document.getElementById('chart-doughnut').getContext("2d"), {
    type: 'doughnut',
    data: {
      labels: [ 'Red', 'Blue', 'Yellow' ],
      datasets: [{
        data: [ 137, 296, 213 ],
        backgroundColor: [ '#ff4961', '#716aca', '#ff9149' ],
        hoverBackgroundColor: [ '#ff4961', '#716aca', '#ff9149' ]
      }]
    },

    // Demo
    options: {
      responsive: false,
      maintainAspectRatio: false
    }
  });

  // Resizing charts

  function resizeCharts() {
    graphChart.resize();
    barsChart.resize();
    radarChart.resize();
    polarAreaChart.resize();
    pieChart.resize();
    doughnutChart.resize();
  }

  // Initial resize
  resizeCharts();

  // For performance reasons resize charts on delayed resize event
  window.layoutHelpers.on('resize.charts-demo', resizeCharts);
});
