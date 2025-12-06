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
$sql_lietke_ngansach = "
    SELECT 
        budget.*, 
        spendingtype.name AS spendingtype_name,
        (SELECT SUM(spending.amount) 
         FROM spending 
         WHERE spending.spendingtype_id = budget.spendingtype_id 
           AND spending.date BETWEEN budget.start_date AND budget.end_date
        ) AS total_spent
    FROM budget
    LEFT JOIN spendingtype ON budget.spendingtype_id = spendingtype.id 
    WHERE budget.user_id = '".$user_id."'";

// $sql_lietke_ngansach = "SELECT budget.*, spendingtype.name AS spendingtype_name FROM budget
//                             LEFT JOIN spendingtype ON budget.spendingtype_id = spendingtype.id where budget.user_id = '".$user_id."'";

if (isset($_POST['timkiem'])) {
    $tukhoa = $_POST['tukhoa'];
    $sql_lietke_ngansach .= " AND (
        spendingtype.name LIKE '%$tukhoa%' OR 
        budget.amount LIKE '%$tukhoa%' OR 
        DATE_FORMAT(budget.start_date, '%d-%m-%Y') LIKE '%$tukhoa%' OR
        DATE_FORMAT(budget.end_date, '%d-%m-%Y') LIKE '%$tukhoa%'
    )";
}
$sql_lietke_ngansach .= " ORDER BY id DESC LIMIT $begin,$limit";
$query_lietke_ngansach = mysqli_query($mysqli, $sql_lietke_ngansach);
?>
<div class="overview-main">
    <div class="overview-main-region">
        <?php include('hi.php'); ?>
        <div class="budget">
            <div class="budget-region">
                <div class="budget-title">
                    <span class="budget-title__text">Thiết lập ngân sách chi tiêu</span>
                </div>
                <div class="budget-main">
                <div class="thrifty-add">
                        <h3 class="budget-main__text">Thiết lập ngân sách chi tiêu</h3>
                        <button class="thrifty-add__btn">Thêm ngân sách</button>
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
                                <th class="budget-show__type">Loại chi tiêu</th>
                                <th class="budget-show__type">Hạn mức</th>
                                <th class="budget-show__type">Số tiền đã chi</th>
                                <th class="budget-show__type">Ngày bắt đầu</th>
                                <th class="budget-show__type">Ngày kết thúc</th>
                                <th class="budget-show__type">Thao tác</th>
                            </tr>
                            <?php
                            $i = 0;
                            while($row = mysqli_fetch_array($query_lietke_ngansach)){
                                $i++;
                            ?>
                            <tr class="budget-show__tr">
                                <td><?php echo $i ?></td>
                                <td><?php echo $row['spendingtype_name'] ?></td>
                                <td><?php echo number_format($row['amount']) ?> VND</td>
                                <td style="<?php if($row['amount'] < $row['total_spent']) echo 'color: red;' ?>"><?php echo number_format($row['total_spent'] ?? 0) ?> VND</td>
                                <td><?php echo date("d-m-Y", strtotime($row['start_date'])); ?></td>
                                <td><?php echo date("d-m-Y", strtotime($row['end_date'])); ?></td>
                                <td>
                                    <button class="budget-btn budget-btn--edit" data-spendingtype="<?php echo $row['spendingtype_id']; ?>" data-money="<?php echo $row['amount']; ?>" 
                                                                                data-start-date="<?php echo $row['start_date']; ?>" data-end-date="<?php echo $row['end_date']; ?>" data-budget-id="<?php echo $row['id']; ?>">Sửa</button>
                                    <a href="././pages/processing/budget.php?action=delete_budget&id=<?php echo $row['id'] ?>" class="budget-btn budget-btn--delete" class="budget-btn budget-btn--delete">Xóa</a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                        <div class="line"></div>
                        <?php
                        $sql_trang = mysqli_query($mysqli, "SELECT * FROM budget WHERE user_id = '".$user_id."'");
                        $row_count = mysqli_num_rows($sql_trang);
                        $trang = ceil($row_count / $limit);
                        ?>
                        <ul class="page-list">
                            <?php
                            for($i=1;$i<=$trang;$i++){
                            ?>
                            <li class="page-item">
                                <a href="?page=budget&paging=<?php echo $i ?>&limit=<?php echo $limit ?>" class="page-link" <?php if($i == $page) { echo 'style="background-color: #aeaeae"';} ?>><?php echo $i ?></a>
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
        <form action="pages/processing/budget.php" method="post" autocomplete="off">
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
                        <div class="icome-add">
                            <p class="saving-target__text">Loại chi tiêu</p>
                            <select name="id_loaichitieu" id="" class="icome-add__type" required>
                                <option value="" selected disabled>Chọn loại thu nhập</option>
                                <?php
                                // Truy vấn lấy danh sách loại thu nhập
                                $sql = "SELECT * FROM spendingtype where user_id = '".$user_id."' ORDER BY id DESC";
                                $query = mysqli_query($mysqli, $sql);
                                while($row_loaichitieu = mysqli_fetch_array($query)){
                                ?>
                                    
                                
                                <option value="<?php echo $row_loaichitieu['id'] ?>"><?php echo $row_loaichitieu['name'] ?></option>
                                        
                                    
                                
                                <?php
                                }
                                ?>
                            </select>
        
                        </div>
                        
                        <div class="saving-date__choose">
                            <p class="saving-target__text">Ngày bắt đầu</p>
                            <input type="date" class="saving-date__date" name="ngaybatdau" required>
                        </div>
                   </div>
                   <div class="saving-date">

                        
                        <div class="saving-target__type">
                            <p class="saving-target__text">Hạn mức (VND)</p>
                            <input type="number" class="saving-target__input" name="hanmuc" required>
                        </div>
                        <div class="saving-date__choose">
                            <p class="saving-target__text">Ngày kết thúc</p>
                            <input type="date" class="saving-date__date" name="ngayketthuc" required>
                        </div>
                   </div>
                </div>
                <div class="saving-add__footer">
                    <button class="saving-add__btn">Đóng</button>
                    <input type="submit" class="saving-add__btn" value="Lưu" name="themngansach">
                </div>
            </div>

        </div> 
        </form>
                
    </div>
</div>
<script src="././js/budget.js"></script>
<script>
    document.getElementById('records_per_page').addEventListener('change', function() {
        const selectedLimit = this.value; // Lấy giá trị đã chọn
        const currentPage = new URLSearchParams(window.location.search).get('paging') || 1; // Lấy trang hiện tại
        const page = new URLSearchParams(window.location.search).get('page') || 'budget'; // Lấy trang hiện tại

        // Chuyển hướng đến URL mới với `limit` và `paging`
        window.location.href = `?page=${page}&paging=${currentPage}&limit=${selectedLimit}`;
    });
</script>