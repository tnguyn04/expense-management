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
// $sql_lietke_khoanthunhap = "SELECT income.*, incometype.name AS incometype_name FROM income 
// LEFT JOIN incometype ON income.incometype_id = incometype.id ORDER by id DESC";
// $query_lietke_khoanthunhap = mysqli_query($mysqli,$sql_lietke_khoanthunhap);
$sql_lietke_khoanthunhap = "SELECT income.*, incometype.name AS incometype_name FROM income
                            LEFT JOIN incometype ON income.incometype_id = incometype.id where income.user_id = '".$user_id."'";

if (isset($_POST['timkiem'])) {
    $tukhoa = $_POST['tukhoa'];
    $sql_lietke_khoanthunhap .= " AND (
        income.name LIKE '%$tukhoa%' OR 
        incometype.name LIKE '%$tukhoa%' OR
        income.amount LIKE '%$tukhoa%' OR 
        income.note LIKE '%$tukhoa%' OR 
        DATE_FORMAT(income.date, '%d-%m-%Y') LIKE '%$tukhoa%' OR
        income.time LIKE '%$tukhoa%'
    )";
}
$sql_lietke_khoanthunhap .= " ORDER BY id DESC  LIMIT $begin,$limit";
$query_lietke_khoanthunhap = mysqli_query($mysqli, $sql_lietke_khoanthunhap);
?>

<div class="overview-main">
    <div class="overview-main-region">
        <?php include('hi.php'); ?>
        <div class="budget thrifty">
            <div class="budget-region">
                <div class="budget-title">
                    <span class="budget-title__text">Thu nhập</span>
                </div>
                <div class="budget-main">
                    <div class="thrifty-add">
                        <h3 class="budget-main__text">Danh sách khoản thu nhập</h3>
                        <button class="thrifty-add__btn">Thêm khoản thu nhập</button>
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
        
                        <table class="budget-show-table" style="width:100%">
                            <tr>
                                <th class="budget-show__type">STT</th>
                                <th class="budget-show__type">Khoản thu nhập</th>
                                <th class="budget-show__type">Loại thu nhập</th>
                                <th class="budget-show__type">Số tiền</th>
                                <th class="budget-show__type">Ghi chú</th>
                                <th class="budget-show__type">Ngày</th>
                                <th class="budget-show__type">Thời gian</th>
                                <th class="budget-show__type">Thao tác</th>
                            </tr>

                            <?php
                            $i = 0;
                            while($row = mysqli_fetch_array($query_lietke_khoanthunhap)){
                                $i++;
                            ?>
                            <tr class="budget-show__tr">
                                <td><?php echo $i ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['incometype_name'] ?></td>
                                <td><?php echo number_format($row['amount']) ?> VND</td> <!-- Số tiền -->
                                <td><?php echo $row['note'] ?></td> <!-- Ghi chú -->
                                <td><?php echo date("d-m-Y", strtotime($row['date'])); ?></td> <!-- Ngày -->
                                <td><?php echo $row['time'] ?></td> <!-- Thời gian -->
                                <td>
                                    <button class="budget-btn budget-btn--edit" data-income="<?php echo $row['name']; ?>" data-incometype="<?php echo $row['incometype_id']; ?>" data-money="<?php echo $row['amount']; ?>" 
                                                                                data-note="<?php echo $row['note']; ?>" data-date="<?php echo $row['date']; ?>" 
                                                                                data-time="<?php echo $row['time']; ?>" data-income-id="<?php echo $row['id']; ?>">Sửa</button>
                                    <a href="././pages/processing/income.php?action=delete_income&id=<?php echo $row['id'] ?>" class="budget-btn budget-btn--delete">Xóa</a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                        <div class="line"></div>
                        <?php
                        $sql_trang = mysqli_query($mysqli, "SELECT * FROM income WHERE user_id = '".$user_id."'");
                        $row_count = mysqli_num_rows($sql_trang);
                        $trang = ceil($row_count / $limit);
                        ?>
                        <ul class="page-list">
                            <?php
                            for($i=1;$i<=$trang;$i++){
                            ?>
                            <li class="page-item">
                                <a href="?page=income&paging=<?php echo $i ?>&limit=<?php echo $limit ?>" class="page-link" <?php if($i == $page) { echo 'style="background-color: #aeaeae"';} ?>><?php echo $i ?></a>
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
        <form action="pages/processing/income.php" method="post" autocomplete="off">
        <div class="auth-form">
            <div class="auth-form__container">
                <div class="auth-form__header">
                    <h3 class="auth-form__heading">Thêm mới</h3>
                    <div class="auth-form__close">
                        <i class="auth-form__close-icon fa-solid fa-xmark"></i>
                    </div>
                </div>
                <div class="line line-saving"></div>
                <form action="pages/processing/income.php" method="post">
                <div class="auth-form__add">
                   <div class="saving-target">
                        <div class="saving-target__type">
                            <p class="saving-target__text">Khoản thu nhập</p>
                            <input type="text" class="saving-target__input" name="khoanthunhap" required>
                        </div>
                        <div class="saving-target__type">
                            <p class="saving-target__text">Số tiền (VND)</p>
                            <input type="number" class="saving-target__input" name="sotien" required>
                        </div>
                        <div class="saving-date__choose">
                            <p class="saving-target__text">Ngày</p>
                            <input type="date" class="saving-date__date" name="ngay" required>
                        </div>
                   </div>
                   <div class="saving-date">

                        <div class="icome-add">
                            <p class="saving-target__text">Loại thu nhập</p>
                            
                            <select name="id_loaithunhap" id="" class="icome-add__type" required>
                                <option value="" selected disabled>Chọn loại thu nhập</option>
                            <?php
                            // Truy vấn lấy danh sách loại thu nhập
                            $sql = "SELECT * FROM incometype where incometype.user_id = '".$user_id."' ORDER BY id DESC";
                            $query = mysqli_query($mysqli, $sql);
                            while($row_loaithunhap = mysqli_fetch_array($query)){
                            ?>
                                
                            
                                <option value="<?php echo $row_loaithunhap['id'] ?>"><?php echo $row_loaithunhap['name'] ?></option>
                                    
                                
                              
                            <?php
                            }
                            ?>    
                            </select>
                            
                        </div>
                        <div class="saving-target__type">
                            <p class="saving-target__text">Ghi chú</p>
                            <input type="text" class="saving-target__input" name="ghichu">
                        </div>
                        <div class="saving-date__choose">
                            <p class="saving-target__text">Thời gian</p>
                            <input type="time" class="saving-date__date" name="gio">
                        </div>
                   </div>
                </div>
                <div class="saving-add__footer">
                    <button class="saving-add__btn saving-add__btn--close" name="dong">Đóng</button>
                    <input type="submit" class="saving-add__btn" value="Lưu" name="themkhoanthunhap">
                </div>
            </div>

        </div> 
        </form>
                
    </div>
</div>

<script src="././js/icome.js"></script>
<script>
    document.getElementById('records_per_page').addEventListener('change', function() {
        const selectedLimit = this.value; // Lấy giá trị đã chọn
        const currentPage = new URLSearchParams(window.location.search).get('paging') || 1; // Lấy trang hiện tại
        const page = new URLSearchParams(window.location.search).get('page') || 'income'; // Lấy trang hiện tại

        // Chuyển hướng đến URL mới với `limit` và `paging`
        window.location.href = `?page=${page}&paging=${currentPage}&limit=${selectedLimit}`;
    });
</script>
