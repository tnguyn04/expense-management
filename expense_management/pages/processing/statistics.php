<?php
// $user_id = $_SESSION['user_id'];

// $sql_luong = "SELECT sum(income.amount) as luong FROM income LEFT JOIN incometype on income.incometype_id = incometype.id where income.user_id = '".$user_id."' and incometype.name = 'lương'";
// $query_luong = mysqli_query($mysqli, $sql_luong);
// $row_luong = mysqli_fetch_assoc($query_luong);
// $thuluong = $row_luong['luong'];

// $sql_dautu = "SELECT sum(income.amount) as dautu FROM income LEFT JOIN incometype on income.incometype_id = incometype.id where income.user_id = '".$user_id."' and incometype.name = 'đầu tư'";
// $query_dautu = mysqli_query($mysqli, $sql_dautu);
// $row_dautu = mysqli_fetch_assoc($query_dautu);
// $thudautu = $row_dautu['dautu'];

// $sql_kinhdoanh = "SELECT sum(income.amount) as kinhdoanh FROM income LEFT JOIN incometype on income.incometype_id = incometype.id where income.user_id = '".$user_id."' and incometype.name = 'kinh doanh'";
// $query_kinhdoanh = mysqli_query($mysqli, $sql_kinhdoanh);
// $row_kinhdoanh = mysqli_fetch_assoc($query_kinhdoanh);
// $thukinhdoanh = $row_kinhdoanh['kinhdoanh'];

// $sql_buonban = "SELECT sum(income.amount) as buonban FROM income LEFT JOIN incometype on income.incometype_id = incometype.id where income.user_id = '".$user_id."' and incometype.name = 'buôn bán'";
// $query_buonban = mysqli_query($mysqli, $sql_buonban);
// $row_buonban = mysqli_fetch_assoc($query_buonban);
// $thubuonban = $row_buonban['buonban'];

// $sql_khac = "SELECT sum(income.amount) as khac FROM income LEFT JOIN incometype on income.incometype_id = incometype.id where income.user_id = '".$user_id."'";
// $query_khac = mysqli_query($mysqli, $sql_khac);
// $row_khac = mysqli_fetch_assoc($query_khac);
// $thukhac = $row_khac['khac'];

// $tong_khac = $thukhac - ($thuluong + $thudautu + $thukinhdoanh + $thubuonban);



$user_id = $_SESSION['user_id'];
$specified_types = ['lương', 'đầu tư', 'kinh doanh', 'buôn bán']; // Các loại cụ thể
$income_data = [];
$total_income = 0;
$unit = 'VND';
foreach ($specified_types as $type) {
    $sql = "SELECT SUM(income.amount) AS total FROM income 
            LEFT JOIN incometype ON income.incometype_id = incometype.id 
            WHERE income.user_id = '$user_id' AND incometype.name = '$type'";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($query);
    $total = $row['total'] ? $row['total'] : 0;
    $income_data[] = $total;
    $total_income += $total;
}
$sql_other = "SELECT SUM(income.amount) AS total FROM income 
              LEFT JOIN incometype ON income.incometype_id = incometype.id 
              WHERE income.user_id = '$user_id'";
$query_other = mysqli_query($mysqli, $sql_other);
$row_other = mysqli_fetch_assoc($query_other);
$total_other = $row_other['total'] ? $row_other['total'] : 0;

$income_data[] = $total_other - $total_income;


?>

<?php

    $specified_types = ['nhà cửa', 'ăn uống', 'di chuyển', 'giải trí']; // Các loại cụ thể
    $spending_data = [];
    $total_spending = 0;
    
    // Truy vấn tổng thu nhập từng loại cụ thể
    foreach ($specified_types as $type) {
        $sql = "SELECT SUM(spending.amount) AS total FROM spending 
                LEFT JOIN spendingtype ON spending.spendingtype_id = spendingtype.id 
                WHERE spending.user_id = '$user_id' AND spendingtype.name = '$type'";
        $query = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_assoc($query);
        $total = $row['total'] ? $row['total'] : 0;
        $spending_data[] = $total;
        $total_spending += $total; // Cộng dồn tổng thu nhập các loại cụ thể
    }
    
    // Tính tổng thu nhập cho mục "Khác"
    $sql_other = "SELECT SUM(spending.amount) AS total FROM spending 
                  LEFT JOIN spendingtype ON spending.spendingtype_id = spendingtype.id 
                  WHERE spending.user_id = '$user_id'";
    $query_other = mysqli_query($mysqli, $sql_other);
    $row_other = mysqli_fetch_assoc($query_other);
    $total_other = $row_other['total'] ? $row_other['total'] : 0;
    
    $spending_data[] = $total_other - $total_spending; // Mục "Khác"
?>