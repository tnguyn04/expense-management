<?php
if (isset($_GET['limit']) && is_numeric($_GET['limit'])) {
    $limit = $_GET['limit'];
} else {
    $limit = 5; // Mặc định là 5 bản ghi
}

if (isset($_GET['paging'])) {
    $page = $_GET['paging'];
} else {
    $page = 1;
}

$begin = ($page - 1) * $limit;
?>
<?php
$user_id = $_SESSION['user_id'];
$sql_lietke_tietkiem = "SELECT * FROM saving where saving.user_id = '".$user_id."'";

if (isset($_POST['timkiem'])) {
    $tukhoa = $_POST['tukhoa'];
    $sql_lietke_tietkiem .= " AND (
        saving.name LIKE '%$tukhoa%' OR 
        saving.amount LIKE '%$tukhoa%' OR 
        DATE_FORMAT(saving.start_date, '%d-%m-%Y') LIKE '%$tukhoa%' OR
        DATE_FORMAT(saving.completione_date, '%d-%m-%Y') LIKE '%$tukhoa%'
    )";
}
$sql_lietke_tietkiem .= " ORDER BY id DESC LIMIT $begin,$limit";
$query_lietke_tietkiem = mysqli_query($mysqli, $sql_lietke_tietkiem);
?>
<?php
// $sql_tiendo = "SELECT 
//     saving.name AS saving_name, 
//     (
//         SELECT SUM(amount) 
//         FROM income 
//         WHERE income.user_id = '".$user_id."' 
//           AND income.date BETWEEN saving.start_date AND saving.completione_date
//     ) AS total_income,
//     (
//         SELECT SUM(amount) 
//         FROM spending 
//         WHERE spending.user_id = '".$user_id."' 
//           AND spending.date BETWEEN saving.start_date AND saving.completione_date
//     ) AS total_spending
// FROM 
//     saving
// WHERE 
//     saving.user_id = '".$user_id."';
// ";
// // $sql_tiendo = "SELECT spendingtype.name AS spendingtype_name, SUM(spending.amount) AS total_spent FROM budget JOIN spending ON budget.spendingtype_id = spending.spendingtype_id 
// //                 AND spending.date BETWEEN budget.start_date AND budget.end_date JOIN spendingtype ON spendingtype.id = budget.spendingtype_id GROUP BY spendingtype.name";
// $query_tiendo = mysqli_query($mysqli, $sql_tiendo);
// $row_tiendo = mysqli_fetch_array($query_tiendo);
?>
<div class="overview-main">
    <div class="overview-main-region">
        <?php include('hi.php'); ?>
        <div class="budget thrifty">
            <div class="budget-region">
                <div class="budget-title">
                    <span class="budget-title__text">Tiết kiệm</span>
                </div>
                <div class="budget-main">
                    <div class="thrifty-add">
                        <h3 class="budget-main__text">Thiết lập mục tiêu tiết kiệm</h3>
                        <button class="thrifty-add__btn">Thêm mục tiêu</button>
                    </div>
                    <div class="line"></div>
                    <div class="budget-show">
                        <div class="budget-show-header">
                            <div class="budget-show__page">
                                <select name="records_per_page" id="records_per_page" class="budget-show__page-num">
                                    <option value="5" <?php if (isset($_GET['limit']) && $_GET['limit'] == 5) echo 'selected'; ?>>5</option>
                                    <option value="10" <?php if (isset($_GET['limit']) && $_GET['limit'] == 10) echo 'selected'; ?>>10</option>
                                    <option value="15" <?php if (isset($_GET['limit']) && $_GET['limit'] == 15) echo 'selected'; ?>>15</option>
                                </select>
                                <span class="budget-show__page-text">entries per page</span>
                            </div>
                            <form action="" method="post" autocomplete="off">
                            <div class="budget-show__search">
                                <input type="text" placeholder="Tìm kiếm theo tên, loại, ngày, ..." class="budget-show__search-input" value="<?php echo isset($_POST['tukhoa']) ? htmlspecialchars($_POST['tukhoa']) : ''; ?>" name="tukhoa">
                                <input type="hidden" name="page" value="<?php echo isset($_GET['page']) ? $_GET['page'] : 'overview'; ?>">
                                <input type="submit" value="Tìm kiếm" class="budget-show__search-btn" name="timkiem">
                                <a href="" class="reload-link"><i class="reload-icon fa-solid fa-rotate-right"></i></a>
                            </div>
                            </form>
                        </div>
                        <!-- <div class="budget-show-detail">
                            <div class="budget-show__type">
                                <span class="budget-show-type-text budget-show-type-text--stt">STT</span>
                                <span class="budget-show-type-text budget-show-type-text--type">Loại chi tiêu</span>
                                <span class="budget-show-type-text budget-show-type-text--money">Số tiền</span>
                                <span class="budget-show-type-text budget-show-type-text--spend">Số tiền đã chi</span>
                                <span class="budget-show-type-text budget-show-type-text--time">Thời gian</span>
                                <span class="budget-show-type-text budget-show-type-text--manipulate">Thao tác</span>
                            </div>
                        </div> -->
                        
                        <table class="budget-show-table" style="width:100%">
                            <tr>
                                <th class="budget-show__type">STT</th>
                                <th class="budget-show__type">Mục tiêu</th>
                                <th class="budget-show__type">Số tiền</th>
                                <th class="budget-show__type">Ngày bắt đầu</th>
                                <th class="budget-show__type">Ngày kết thúc</th>
                                <th class="budget-show__type">Tiến độ</th>
                                <th class="budget-show__type">Thao tác</th>
                            </tr>
                            <?php
                            $i = 0;
                            while($row = mysqli_fetch_array($query_lietke_tietkiem)){
                                $i++;
                                $sql_tiendo = "SELECT 
                                (
                                    SELECT SUM(amount) 
                                    FROM income 
                                    WHERE income.user_id = '".$user_id."' 
                                    AND income.date BETWEEN '".$row['start_date']."' AND '".$row['completione_date']."'
                                ) AS total_income,
                                (
                                    SELECT SUM(amount) 
                                    FROM spending 
                                    WHERE spending.user_id = '".$user_id."' 
                                    AND spending.date BETWEEN '".$row['start_date']."' AND '".$row['completione_date']."'
                                ) AS total_spending";

                            $query_tiendo = mysqli_query($mysqli, $sql_tiendo);
                            $row_tiendo = mysqli_fetch_array($query_tiendo);
                            $saved_amount = $row_tiendo['total_income'] - $row_tiendo['total_spending'];

                            // Tính tiến độ (phần trăm)
                            if ($saved_amount < 0) {
                                $progress = 0; // Nếu số tiền đã tiết kiệm được là âm thì tiến độ là 0%
                            }elseif ($saved_amount > $row['amount']){
                                $progress = 100;
                            } else {
                                // Tiến độ theo phần trăm
                                $progress = ($saved_amount / $row['amount']) * 100;
                                $progress = round($progress, 2); // Làm tròn đến 2 chữ số thập phân
                            }
                            ?>
                            <tr class="budget-show__tr">
                                <td><?php echo $i ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo number_format($row['amount']) ?> VND</td>
                                <td><?php echo date("d-m-Y", strtotime($row['start_date'])); ?></td>
                                <td><?php echo date("d-m-Y", strtotime($row['completione_date'])); ?></td>
                                <td style="<?php if($progress >= 100) echo 'color: green;' ?>"><?php echo $progress ?>%</td>
                                <td>
                                    <button class="budget-btn budget-btn--edit" data-name="<?php echo $row['name']; ?>" data-money="<?php echo $row['amount']; ?>" 
                                    data-start-date="<?php echo $row['start_date']; ?>" data-completione-date="<?php echo $row['completione_date']; ?>" data-saving-id="<?php echo $row['id']; ?>">Sửa</button>
                                    <a href="././pages/processing/saving.php?action=delete_saving&id=<?php echo $row['id'] ?>" class="budget-btn budget-btn--delete">Xóa</a>
                                </td>
                            </tr>
                            <!-- <tr>
                                <td colspan="7" style="text-align: center;"><i class="saving-chart__show fa-solid fa-angle-down"></i></td>
                            </tr>
                            <tr class="saving-chart hide">
                                <td colspan="7">
                                    <div class="">

                                        <div class="saving-header">
                                            <span class="saving-header__text">Biểu đồ thống kê số tiền tiết kiệm từng tháng</span>
                                        </div>
                                            <span class="saving-unit-vnd">Đơn vị (Triệu  VND)</span>
                                        <div>
                                            <canvas id="myChart" height="100px"></canvas>
                                        </div>


                                        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
                                        <script src="././js/saving_chart.js"></script>

                                    </div>
                                </td>
                            </tr> -->
                            <?php
                            }
                            ?>
                        </table>
                        <div class="line"></div>
                        <?php
                        $sql_trang = mysqli_query($mysqli, "SELECT * FROM saving WHERE user_id = '".$user_id."'");
                        $row_count = mysqli_num_rows($sql_trang);
                        $trang = ceil($row_count / $limit);
                        ?>
                        <ul class="page-list">
                            <?php
                            for($i=1;$i<=$trang;$i++){
                            ?>
                            <li class="page-item">
                                <a href="?page=saving&paging=<?php echo $i ?>&limit=<?php echo $limit ?>" class="page-link" <?php if($i == $page) { echo 'style="background-color: #aeaeae"';} ?>><?php echo $i ?></a>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal layout -->
<div class="modal-edit hide">
    <div class="modal-edit__overlay"></div>
            
    <div class="modal-edit__body">
        <!-- Name edit -->
        <form action="pages/processing/saving.php" method="post" autocomplete="off">
        <div class="auth-form">
            <div class="auth-form__container">
                <div class="auth-form__header">
                    <h3 class="auth-form__heading">Thêm mới</h3>
                    <div class="auth-form__close">
                        <i class="auth-form__close-icon fa-solid fa-xmark"></i>
                    </div>
                </div>
                <div class="line line-saving"></div>
                <div class="auth-form__add">
                   <div class="saving-target">
                        <div class="saving-target__type">
                            <p class="saving-target__text">Mục tiêu</p>
                            <input type="text" class="saving-target__input" name="muctieu" required>
                        </div>
                        <div class="saving-target__type">
                            <p class="saving-target__text">Số tiền (VND)</p>
                            <input type="number" class="saving-target__input" name="sotien" required>
                        </div>
                   </div>
                   <div class="saving-date">
                        <div class="saving-date__choose">
                            <p class="saving-target__text">Ngày bắt đầu</p>
                            <input type="date" class="saving-date__date" name="ngaybatdau" required>
                        </div>
                        <div class="saving-date__choose">
                            <p class="saving-target__text">Ngày hoàn thành</p>
                            <input type="date" class="saving-date__date" name="ngayhoanthanh">
                        </div>
                   </div>
                </div>
                <div class="saving-add__footer">
                    <button class="saving-add__btn">Đóng</button>
                    <input type="submit" class="saving-add__btn" value="Lưu" name="themtietkiem">
                </div>
            </div>

        </div> 
        </form>
                
    </div>
</div>

<script>
    var iconShow = document.querySelector('.saving-chart__show')
    var savingChart = document.querySelector('.saving-chart')

    // Hàm để bật/tắt hiển thị biểu đồ và thay đổi biểu tượng
function toggleChart() {
    savingChart.classList.toggle('hide'); // Thêm hoặc xóa lớp 'hide' để ẩn/hiện biểu đồ
    // Thay đổi biểu tượng giữa fa-angle-down và fa-angle-up
    if (savingChart.classList.contains('hide')) {
        iconShow.classList.remove('fa-angle-up'); // Xóa lớp fa-angle-up
        iconShow.classList.add('fa-angle-down'); // Thêm lớp fa-angle-down
    } else {
        iconShow.classList.remove('fa-angle-down'); // Xóa lớp fa-angle-down
        iconShow.classList.add('fa-angle-up'); // Thêm lớp fa-angle-up
    }
}

    iconShow.addEventListener('click', toggleChart)
</script> 

<script src="././js/saving.js"></script>
<script>
    document.getElementById('records_per_page').addEventListener('change', function() {
        const selectedLimit = this.value; // Lấy giá trị đã chọn
        const currentPage = new URLSearchParams(window.location.search).get('paging') || 1; // Lấy trang hiện tại
        const page = new URLSearchParams(window.location.search).get('page') || 'spending'; // Lấy trang hiện tại

        // Chuyển hướng đến URL mới với `limit` và `paging`
        window.location.href = `?page=${page}&paging=${currentPage}&limit=${selectedLimit}`;
    });
</script>