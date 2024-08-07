$(document).ready(function(){
  const ctx = $('#revenueAndExpenses');

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
        label: 'Revenue',
        data: generateChartData(10, 100, 1000),
      },
      {
        label: 'Expenses',
        data: generateChartData(10, 100, 1000),
      }
    ]
  }

  const config = {
    type: "line",
    data: data,
    options: {
      responsive: true,
      interaction: {
        mode: 'index',
        intersect: false,
      },
      stacked: false,

      plugins: {
        // title: {
        //   display: true,
        //   text: 'Revenue and Expenses'
        // },
        colors: {
          enable: true
        }
      }
    }
  }


  new Chart(ctx, config);
})
