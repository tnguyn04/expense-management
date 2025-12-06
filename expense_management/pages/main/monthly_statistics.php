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
                        <h3 class="budget-main__text">Thống kê các khoản chi tiêu theo tháng</h3>
                    </div>
                    <?php
                        $monthlyExpenses = [
                            "Tháng 1" => 1000,
                            "Tháng 2" => 1200,
                            "Tháng 3" => 1100,
                            "Tháng 4" => 1300,
                            "Tháng 5" => 1500,
                        ];                        
                        // Truyền dữ liệu sang JavaScript
                        $monthlyLabels = json_encode(array_keys($monthlyExpenses));
                        $monthlyData = json_encode(array_values($monthlyExpenses));
                      ?>
                    <div class="chart-container">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                    <style>
                        .chart-container {
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            gap: 30px;
                            margin-top: 20px;
                        }
                        canvas {
                            max-width: 1200px;
                            max-height: 600px;
                            width: 100%;
                            height: auto;
                        }
                    </style>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
                    <script>
                        // Dữ liệu từ PHP
                        const monthlyLabels = <?= $monthlyLabels ?>;
                        const monthlyData = <?= $monthlyData ?>;
                        // Biểu đồ chi tiêu theo tháng
                        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
                        new Chart(monthlyCtx, {
                            type: 'line',
                            data: {
                                labels: monthlyLabels,
                                datasets: [{
                                    label: 'Chi tiêu (VND)',
                                    data: monthlyData,
                                    borderColor: '#f44336',
                                    backgroundColor: 'rgba(244, 67, 54, 0.2)',
                                    borderWidth: 2,
                                    tension: 0.4 // Đường cong mượt
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top'
                                    }
                                },
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Tháng'
                                        }
                                    },
                                    y: {
                                        title: {
                                            display: true,
                                            text: 'Chi tiêu (VND)'
                                        },
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>