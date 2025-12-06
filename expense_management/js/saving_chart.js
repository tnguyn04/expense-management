const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['02/04/24', '02/05/24', '02/06/24', '02/07/24', '02/08/24', '02/09/24', '02/10/24', '02/11/24'],
      datasets: [{
        label: 'Triệu đồng',
        data: [12, 19, 50, 20, 23, 38, 40, 22],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });