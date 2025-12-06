<?php
if(isset($_GET['action'])=='logout'){
    unset($_SESSION['dangnhap']);
    echo "<script>location.reload();</script>";
    exit();
}
?>

<?php
$user_id = $_SESSION['user_id'];
$sql_ten = "SELECT fullname FROM user where id = '".$user_id."'";
$query_ten = mysqli_query($mysqli, $sql_ten);
$row = mysqli_fetch_assoc($query_ten);

?>
<div class="overview-sidebar">
                    <div class="sidebar-region">
                        <?php
                        $selected = isset($_GET['page']) ? $_GET['page'] : 'overview';
                        ?>
                        <div class="sidebar-account">
                            
                            <div class="sidebar-account-region">
                                <img src="https://cdn3.iconfinder.com/data/icons/web-design-and-development-2-6/512/87-1024.png" alt="" class="sidebar-account__avt">
                                <span class="sidebar-account__name"><?php echo $row['fullname']; ?></span>
                                <div class="sidebar-account__btn">
                                    <a href="?page=overview" class="sidebar-account__btn-link">
                                        <i class="sidebar-account__btn-icon fa-solid fa-house"></i>
                                    </a>
                                    <a href="?page=profile" class="sidebar-account__btn-link sidebar-account__btn-link--space">
                                        <i class="sidebar-account__btn-icon fa-solid fa-user <?php echo $selected == 'profile' ? 'sidebar-category-link--active-icon' : ''; ?>"></i>
                                    </a>
                                    <a href="?action=logout" class="sidebar-account__btn-link">
                                        <i class="sidebar-account__btn-icon fa-solid fa-power-off"></i> <?php //if(isset($_SESSION['dangnhap']))
                                            //echo $_SESSION['dangnhap']
                                         ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="sidebar-category">
                            <ul class="sidebar-category-region">
                                <li class="sidebar-category-list">
                                    <a href="?page=overview" class="sidebar-category-link <?php echo $selected == 'overview' ? 'sidebar-category-link--active' : ''; ?>">
                                        <div class="sidebar-category__item">
                                            <i class="sidebar-category__item-icon fa-solid fa-gauge"></i>
                                            <span class="sidebar-category__item-text">Tổng quan</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="sidebar-category-list">
                                    <a href="?page=income" class="sidebar-category-link <?php echo $selected == 'income' ? 'sidebar-category-link--active' : ''; ?> <?php echo $selected == 'income_type' ? 'sidebar-category-link--active' : ''; ?>">
                                        <div class="sidebar-category__item">
                                            <i class="sidebar-category__item-icon fa-solid fa-money-bill-transfer"></i>
                                            <span class="sidebar-category__item-text">Thu nhập</span>
                                            <i class="sidebar-category__item-icon sidebar-category__item--arrow fa-solid fa-angle-down"></i>
                                        </div>
                                    </a>
                                    <div class="sidebar-category-child">
                                        <ul class="sidebar-category-child-list">
                                            <li class="sidebar-category-child-item sidebar-category-child-item--space"><a href="?page=income_type" class="sidebar-category-child-link <?php echo $selected == 'income_type' ? 'sidebar-category-child-item--active' : ''; ?>">Loại thu nhập</a></li>
                                            <li class="sidebar-category-child-item"><a href="?page=income" class="sidebar-category-child-link <?php echo $selected == 'income' ? 'sidebar-category-child-item--active' : ''; ?>">Khoản thu nhập</a></li>
                                            
                                        </ul>
                                    </div>
                                </li>
                                <li class="sidebar-category-list">
                                    <a href="?page=spending" class="sidebar-category-link <?php echo $selected == 'spending' ? 'sidebar-category-link--active' : ''; ?> <?php echo $selected == 'spending_type' ? 'sidebar-category-link--active' : ''; ?>">
                                        <div class="sidebar-category__item">
                                            <i class="sidebar-category__item-icon fa-solid fa-money-bill-transfer"></i>
                                            <span class="sidebar-category__item-text">Chi tiêu</span>
                                            <i class="sidebar-category__item-icon sidebar-category__item--arrow fa-solid fa-angle-down"></i>
                                        </div>
                                    </a>
                                    <div class="sidebar-category-child">
                                        <ul class="sidebar-category-child-list">
                                            <li class="sidebar-category-child-item sidebar-category-child-item--space"><a href="?page=spending_type" class="sidebar-category-child-link <?php echo $selected == 'spending_type' ? 'sidebar-category-child-item--active' : ''; ?>">Loại chi tiêu</a></li>
                                            <li class="sidebar-category-child-item"><a href="?page=spending" class="sidebar-category-child-link <?php echo $selected == 'spending' ? 'sidebar-category-child-item--active' : ''; ?>">Khoảng chi tiêu</a></li>
                                            
                                        </ul>
                                    </div>
                                </li>
                                <li class="sidebar-category-list">
                                    <a href="?page=budget" class="sidebar-category-link <?php echo $selected == 'budget' ? 'sidebar-category-link--active' : ''; ?>">
                                        <div class="sidebar-category__item">
                                            <i class="sidebar-category__item-icon fa-solid fa-coins"></i>
                                            <span class="sidebar-category__item-text">Ngân sách</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="sidebar-category-list">
                                    <a href="?page=saving" class="sidebar-category-link <?php echo $selected == 'saving' ? 'sidebar-category-link--active' : ''; ?>">
                                        <div class="sidebar-category__item">
                                            <i class="sidebar-category__item-icon fa-solid fa-piggy-bank"></i>
                                            <span class="sidebar-category__item-text">Tiết kiệm</span>
                                        </div>
                                    </a>
                                </li>
                                <!-- <li class="sidebar-category-list">
                                    <a href="?page=remind" class="sidebar-category-link">
                                        <div class="sidebar-category__item">
                                            <i class="sidebar-category__item-icon fa-solid fa-money-bills"></i>
                                            <span class="sidebar-category__item-text">Nhắc nhở</span>
                                        </div>
                                    </a>
                                </li> -->
                                <li class="sidebar-category-list">
                                    <a href="?page=statistics" class="sidebar-category-link <?php echo $selected == 'statistics' ? 'sidebar-category-link--active' : ''; ?>">
                                        <div class="sidebar-category__item">
                                            <i class="sidebar-category__item-icon fa-solid fa-chart-simple"></i>
                                            <span class="sidebar-category__item-text">Thống kê</span>
                                            <!-- <i class="sidebar-category__item-icon sidebar-category__item--arrow fa-solid fa-angle-down"></i> -->
                                        </div>
                                    </a>
                                    <!-- <div class="sidebar-category-child">
                                        <ul class="sidebar-category-child-list">
                                            <li class="sidebar-category-child-item sidebar-category-child-item--space"><a href="?page=weekly_statistics" class="sidebar-category-child-link">Theo tuần</a></li>
                                            <li class="sidebar-category-child-item sidebar-category-child-item--space"><a href="?page=monthly_statistics" class="sidebar-category-child-link">Theo tháng</a></li>
                                        </ul>
                                    </div> -->
                                </li>
 
                            </ul>
                        </div>
                    </div>
                </div>