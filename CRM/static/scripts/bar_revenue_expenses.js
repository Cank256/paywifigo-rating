$(document).ready(function(){
  const ctx = $('#barNetRevnueAndEx');

  Chart.defaults.color = '#fff';
  Chart.defaults.borderColor = '#fff';

  function generateChartData(numDatapoints = 12, minY = 0, maxY = 100) {
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
      'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    return Array.from({ length: numDatapoints }, (_, index) => ({
      x: months[index % 12],
      y: Math.floor(Math.random() * (maxY - minY + 1)) + minY
    }));
  }


  const data = {
    datasets: [
      {
        label: 'Profit',
        data: generateChartData(1, 100, 1000),
      },
      {
        label: 'Expenses',
        showLine: true,
        data: generateChartData(1, -1000, 1000),
      },
      {
        label: 'Net Loss',
        data: generateChartData(1, -1000, 1000),
      },
      {
        label: 'Net Profit',
        data: generateChartData(1, -1000, 1000),
      }
    ]
  }

  const config = {
    type: "bar",
    data: data,
    options: {
      layout: {
        padding: {
          left: 10
        }
      },
      responsive: true,
      interaction: {
        mode: 'index',
        intersect: false,
      },
      stacked: false,

      plugins: {
        title: {
          display: true,
          text: 'Revenue and Expenses'
        },
        colors: {
          enable: true
        }
      }
    }
  }


  new Chart(ctx, config);
})
