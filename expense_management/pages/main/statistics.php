<?php include('pages/processing/statistics.php'); ?>
<div class="overview-main">
    <div class="overview-main-region">
        <?php include('hi.php'); ?>
        <div class="budget thrifty">
            <div class="budget-region">
                <div class="budget-title">
                    <span class="budget-title__text">Thống kê</span>
                </div>
                <div class="budget-main">
                    <div class="thrifty-add">
                        <h3 class="budget-main__text">Thống kê các khoản thu chi</h3>
                    </div>
                    <h2 style="font-size: 1.8rem;">Biểu đồ Thu Nhập và Chi Tiêu</h2>
                    <div class="chart-container">
                        <canvas id="incomeChart"></canvas>
                        <canvas id="expenseChart"></canvas>
                    </div>
                    <style>
                        .chart-container canvas {
                            max-width: 500px;
                            max-height: 500px;
                            margin: 20px auto;
                        }
                        .chart-container{
                            display: flex;
                            justify-content: space-around;
                            padding-bottom: 20px;
                            padding-top: 20px;
                        }
                    </style>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>                              
                    <script>
                        const labels_income = ['Lương', 'Đầu tư', 'Kinh doanh', 'Buôn bán', 'Khác']
                        const incomeChartCtx = document.getElementById('incomeChart').getContext('2d');
                        new Chart(incomeChartCtx, {
                            type: 'pie',
                            data: {
                                labels: labels_income,
                                datasets: [{
                                    label: 'Thu Nhập',
                                    data: [<?php echo implode(", ", $income_data); ?>],

                                    backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#F1C40F', '#9B59B6', '#E74C3C'],
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                                const value = context.raw;
                                                const percentage = ((value / total) * 100).toFixed(2);
                                                return `${context.label}: ${percentage}% (${value})`;
                                            }
                                        }
                                    },
                                    datalabels: {
                                        formatter: (value, context) => {
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const percentage = ((value / total) * 100).toFixed(2);
                                            return `${percentage}%`;
                                        },
                                        color: '#fff',
                                        font: {
                                            weight: 'bold',
                                            size: 12
                                        }
                                    }
                                }
                            },
                            plugins: [ChartDataLabels], // Đặt plugin ngoài options
                        });

                        // Cấu hình biểu đồ chi tiêu
                        const labels_spending = ['Nhà cửa', 'Ăn uống', 'Di chuyển', 'Giải trí', 'Khác']
                        const expenseChartCtx = document.getElementById('expenseChart').getContext('2d');
                        new Chart(expenseChartCtx, {
                            type: 'pie',
                            data: {
                                labels: labels_spending,
                                datasets: [{
                                    label: 'Chi Tiêu',
                                    data: [<?php echo implode(", ", $spending_data); ?>],
                                    backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#F1C40F', '#9B59B6'],
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                                const value = context.raw;
                                                const percentage = ((value / total) * 100).toFixed(2);
                                                return `${context.label}: ${percentage}% (${value})`;
                                            }
                                        }
                                    },
                                    datalabels: {
                                        formatter: (value, context) => {
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const percentage = ((value / total) * 100).toFixed(2);
                                            return `${percentage}%`;
                                        },
                                        color: '#fff',
                                        font: {
                                            weight: 'bold',
                                            size: 12
                                        }
                                    }
                                }
                            },
                            plugins: [ChartDataLabels], // Đặt plugin ngoài options
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

