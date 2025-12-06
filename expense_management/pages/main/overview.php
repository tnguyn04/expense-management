<?php
$user_id = $_SESSION['user_id'];

$sql_thunhap = "SELECT sum(amount) AS tongthunhap FROM income where user_id = '".$user_id."'";
$sql_chitieu = "SELECT sum(amount) AS tongchitieu FROM spending where user_id = '".$user_id."'";

$query_thunhap = mysqli_query($mysqli, $sql_thunhap);
$query_chitieu = mysqli_query($mysqli, $sql_chitieu);
$row_thunhap = mysqli_fetch_assoc($query_thunhap);
$row_chitieu = mysqli_fetch_assoc($query_chitieu);

$tong_thunhap = $row_thunhap['tongthunhap'];
$tong_chitieu = $row_chitieu['tongchitieu'];

?>
<?php //include('pages/processing/overview.php'); ?>


<div class="overview-main">
                    <div class="overview-main-region">
                        <?php include('hi.php'); ?>
                        <div class="overview-statis">
                            <div class="overview-statis-region">
                                <div class="overview-statis__money">
                                    <div class="overview-statis__money-region">
                                        <div class="overview-statis-title">
                                            <span class="overview-statis-text">TỔNG TIỀN THU</span>
                                            <p class="overview-statis-much"><?php echo number_format($tong_thunhap); ?> VND</p>
                                        </div>
                                        <i class="overview-statis-icon fa-solid fa-money-bill-transfer"></i>
                                    </div>
                                </div>
                                <div class="overview-statis__money">
                                    <div class="overview-statis__money-region">
                                        <div class="overview-statis-title">
                                            <span class="overview-statis-text">TỔNG TIỀN CHI</span>
                                            <p class="overview-statis-much"><?php echo number_format($tong_chitieu); ?> VND</p>
                                        </div>
                                        <i class="overview-statis-icon fa-solid fa-money-bill-transfer"></i>
                                    </div>
                                </div>
                                <div class="overview-statis__money">
                                    <div class="overview-statis__money-region">
                                        <div class="overview-statis-title">
                                            <span class="overview-statis-text">SỐ DƯ</span>
                                            <p class="overview-statis-much"><?php echo number_format($tong_thunhap - $tong_chitieu); ?> VND</p>
                                        </div>
                                        <i class="overview-statis-icon fa-solid fa-hand-holding-dollar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="overview-chart">
                            <div class="overview-chart-region">
                                <div class="overview-header">
                                    <span class="overview-header__text">Biểu đồ tổng thu chi từng tháng trong năm</span>
                                    <select name="select_year" id="select_year" class="overview-header__year">
                                    <?php
                                    // Truy vấn lấy danh sách loại thu nhập
                                    $sql = "
                                    SELECT YEAR(date) AS nam 
                                    FROM income 
                                    WHERE user_id = '".$user_id."'
                                    GROUP BY YEAR(date)

                                    UNION

                                    SELECT YEAR(date) AS nam 
                                    FROM spending 
                                    WHERE user_id = '".$user_id."'
                                    GROUP BY YEAR(date)

                                    ORDER BY nam DESC
                                ";

                                    $query = mysqli_query($mysqli, $sql);
                                    while($row = mysqli_fetch_array($query)){
                                    ?>
                                        <option value="<?php echo $row['nam']; ?>" <?php if (isset($_GET['year']) && $_GET['year'] == $row['nam']) echo 'selected'; ?>><?php echo $row['nam'] ?></option>
                                    <?php
                                    }
                                    ?>    
                                    </select>
                                </div>
                                <span class="unit-vnd">Đơn vị (Triệu  VND)</span>
                                <canvas id="canvas"></canvas>
                            </div>
                            <?php
                            $user_id = $_SESSION['user_id'];
                            $year = isset($_GET['year']) ? $_GET['year'] : date("Y");

                            // Tạo mảng rỗng
                            $data_tongthu = [];
                            $data_tongchi = [];

                            // Lặp 12 tháng
                            for ($month = 1; $month <= 12; $month++) {

                                // Tổng thu
                                $sql = "SELECT SUM(amount) AS tongthu 
                                        FROM income 
                                        WHERE user_id = '$user_id' 
                                        AND MONTH(date) = $month 
                                        AND YEAR(date) = $year";

                                $row = mysqli_fetch_assoc(mysqli_query($mysqli, $sql));
                                $data_tongthu[] = $row['tongthu'] ?? 0;

                                // Tổng chi
                                $sql = "SELECT SUM(amount) AS tongchi 
                                        FROM spending 
                                        WHERE user_id = '$user_id' 
                                        AND MONTH(date) = $month 
                                        AND YEAR(date) = $year";

                                $row = mysqli_fetch_assoc(mysqli_query($mysqli, $sql));
                                $data_tongchi[] = $row['tongchi'] ?? 0;
                            }

                            // Convert sang JSON cho JS
                            $data_tongthu_json = json_encode($data_tongthu);
                            $data_tongchi_json = json_encode($data_tongchi);
                            ?>

                            <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
                            <script>
                                const labels = ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6',
                                                'Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'];

                                const data = {
                                    labels: labels,
                                    datasets: [
                                        {
                                            label: 'Thu nhập',
                                            backgroundColor: 'green',
                                            borderColor: 'green',
                                            data: <?php echo $data_tongthu_json; ?>,
                                            tension: 0.4,
                                        },
                                        {
                                            label: 'Chi tiêu',
                                            backgroundColor: 'yellow',
                                            borderColor: 'yellow',
                                            data: <?php echo $data_tongchi_json; ?>,
                                            tension: 0.4,
                                        }
                                    ]
                                };

                                const config = {
                                    type: 'line',
                                    data: data,
                                };

                                new Chart(document.getElementById('canvas'), config);
                                </script>

                            
                            
                        </div>
                    </div>
                </div>
<script>
    document.getElementById('select_year').addEventListener('change', function() {
    const selectedYear = this.value; // Lấy năm đã chọn
    const currentUrl = new URL(window.location.href);

    // Thêm hoặc cập nhật tham số 'year' trong URL
    currentUrl.searchParams.set('year', selectedYear);

    // Tải lại trang với tham số 'year' mới
    window.location.href = currentUrl.toString();
});

</script>

