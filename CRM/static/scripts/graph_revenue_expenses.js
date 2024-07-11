$(document).ready(function(){
  const ctx = $('#revenueAndExpenses');

  const generateData = (dataPoints, val1, val2) => {
    const data = Array(dataPoints).fill(0).map(() => {
      return Math.floor(Math.random() * val2) + val1;
    }).sort((a, b) => a.sortField - b.sortField);

    return data
  }

  const dateLabel = ["January", "February", "March", "April", "May", "June", "July"]

  const data = {
    labels: dateLabel,
    datasets: [
      {
        label: 'Revenue',
        data: generateData(dateLabel.length, 100, 1000),
        borderColor: 'rgb(255, 99, 132)',
        backgroundColor: 'rgba(255, 99, 132, 0.5)',
        yAxisID: 'y',
      },
      {
        label: 'Expenses',
        data: generateData(dateLabel.length, 100, 1000),
        borderColor: 'rgb(54, 162, 235)',
        backgroundColor: 'rgba(54, 162, 235, 0.5)',
        yAxisID: 'y1',
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
        title: {
          display: true,
          text: 'Revenue and Expenses'
        }
      },
      scales: {
        y: {
          type: 'linear',
          display: true,
          position: 'left'
        },
        y1: {
          type: "linear",
          display: true,
          position: 'right',

          grid: {
            drawOnChartArea: false,
          }
        }
      }
    }
  }


  new Chart(ctx, config);
})
