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
                        <h3 class="budget-main__text">Thống kê các khoản chi tiêu theo tuần</h3>
                    </div>
                    <?php
                        // Chi tiêu theo tuần (giá trị giả định)
                        $weeklyExpenses = [
                            "Tuần 1" => 200,
                            "Tuần 2" => 300,
                            "Tuần 3" => 250,
                            "Tuần 4" => 400,
                        ];
                        // Truyền dữ liệu sang JavaScript
                        $weeklyLabels = json_encode(array_keys($weeklyExpenses));
                        $weeklyData = json_encode(array_values($weeklyExpenses));
                      ?>
                    <div class="chart-container">
                        <canvas id="weeklyChart"></canvas>
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
                            max-width: 600px;
                            max-height: 400px;
                            width: 100%;
                            height: auto;
                        }
                    </style>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
                    <script>
                        // Dữ liệu từ PHP
                        const weeklyLabels = <?= $weeklyLabels ?>;
                        const weeklyData = <?= $weeklyData ?>;
                           // Biểu đồ chi tiêu theo tuần
                        const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
                        new Chart(weeklyCtx, {
                            type: 'line',
                            data: {
                                labels: weeklyLabels,
                                datasets: [{
                                    label: 'Chi tiêu (VND)',
                                    data: weeklyData,
                                    borderColor: '#4caf50',
                                    backgroundColor: 'rgba(76, 175, 80, 0.2)',
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
                                            text: 'Tuần'
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