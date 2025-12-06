const labels = ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12']

const data = {
    labels: labels,
    datasets: [
        {
            label: 'Thu',
            backgroundColor: 'green',
            borderColor: 'green',
            data: [],
            tension: 0.4,
        },
        {
            label: 'Chi',
            backgroundColor: 'yellow',
            borderColor: 'yellow',
            data: [],
            tension: 0.4,
        },
    ],
}

const config = {
    type: 'line',
    data: data,
};
const canvas = document.getElementById('canvas')
const chart = new Chart(canvas, config)


