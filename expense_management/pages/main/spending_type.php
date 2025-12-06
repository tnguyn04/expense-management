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
$sql_lietke_loaichitieu = "SELECT * FROM spendingtype where spendingtype.user_id = '".$user_id."'";

if (isset($_POST['timkiem'])) {
    $tukhoa = $_POST['tukhoa'];
    $sql_lietke_loaichitieu .= " and name LIKE '%".$tukhoa."%'";
}
$sql_lietke_loaichitieu .= " ORDER BY id DESC LIMIT $begin,$limit";
$query_lietke_loaichitieu = mysqli_query($mysqli, $sql_lietke_loaichitieu);
?>

<div class="overview-main">
    <div class="overview-main-region">
        <?php include('hi.php'); ?>
        <div class="budget thrifty">
            <div class="budget-region">
                <div class="budget-title">
                    <span class="budget-title__text">Chi tiêu</span>
                </div>
                <div class="budget-main">
                    <div class="thrifty-add">
                        <h3 class="budget-main__text">Danh sách loại chi tiêu</h3>
                        <button class="thrifty-add__btn">Thêm loại chi tiêu</button>
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
                                <input type="text" placeholder="Nhập loại chi tiêu" class="budget-show__search-input" value="<?php echo isset($_POST['tukhoa']) ? htmlspecialchars($_POST['tukhoa']) : ''; ?>" name="tukhoa">
                                <input type="hidden" name="page" value="<?php echo isset($_GET['page']) ? $_GET['page'] : 'overview'; ?>">
                                <input type="submit" value="Tìm kiếm" class="budget-show__search-btn" name="timkiem">
                                <a href="" class="reload-link"><i class="reload-icon fa-solid fa-rotate-right"></i></a>
                            </div>
                            </form>
                        </div>
                    
                        <table class="budget-show-table" style="width:100%">
                            <tr>
                                <th class="budget-show__type">STT</th>
                                <th class="budget-show__type">Loại chi tiêu</th>
                                <th class="budget-show__type">Thao tác</th>
                            </tr>
                            <?php
                            $i = 0;
                            while($row = mysqli_fetch_array($query_lietke_loaichitieu)){
                                $i++;
                            ?>
                            <tr class="budget-show__tr">
                                <td><?php echo $i ?></td>
                                <td><?php echo $row['name'] ?></td>       
                                <td>
                                    <button class="budget-btn budget-btn--edit" data-name="<?php echo $row['name']; ?>" data-id="<?php echo $row['id']; ?>">Sửa</button>
                                    <a href="././pages/processing/spending.php?action=delete_spendingtype&id=<?php echo $row['id'] ?>" class="budget-btn budget-btn--delete">Xóa</a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                        <div class="line"></div>
                        <?php
                        $sql_trang = mysqli_query($mysqli, "SELECT * FROM spendingtype WHERE user_id = '".$user_id."'");
                        $row_count = mysqli_num_rows($sql_trang);
                        $trang = ceil($row_count / $limit);
                        ?>
                        <ul class="page-list">
                            <?php
                            for($i=1;$i<=$trang;$i++){
                            ?>
                            <li class="page-item">
                                <a href="?page=spending_type&paging=<?php echo $i ?>&limit=<?php echo $limit ?>" class="page-link" <?php if($i == $page) { echo 'style="background-color: #aeaeae"';} ?>><?php echo $i ?></a>
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
        <form action="pages/processing/spending.php" method="post" autocomplete="off">
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

                        <div class="saving-target__type">
                            <p class="saving-target__text">Tên loại chi tiêu</p>
                            <input type="hidden" name="id" class="income-type__id" required>
                            <input type="text" name="loaichitieu" class="saving-target__input icome-type__input">
                        </div>
                        
            
                   
                </div>
                <div class="saving-add__footer">
                    <button class="saving-add__btn">Đóng</button>
                    <input type="submit" name="themloaichitieu" class="saving-add__btn" value="Lưu">
                </div>
            </div>

        </div> 
        </form>
                
    </div>
</div>
<script src="././js/spending.js"></script>

<script>
    document.getElementById('records_per_page').addEventListener('change', function() {
        const selectedLimit = this.value; // Lấy giá trị đã chọn
        const currentPage = new URLSearchParams(window.location.search).get('paging') || 1; // Lấy trang hiện tại
        const page = new URLSearchParams(window.location.search).get('page') || 'spending_type'; // Lấy trang hiện tại

        // Chuyển hướng đến URL mới với `limit` và `paging`
        window.location.href = `?page=${page}&paging=${currentPage}&limit=${selectedLimit}`;
    });
</script>
