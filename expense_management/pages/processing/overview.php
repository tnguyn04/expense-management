<?php
$user_id = $_SESSION['user_id'];
$year = 2024;
$income_data = [];

// Lặp qua 12 tháng và thực hiện truy vấn
for ($month = 1; $month <= 12; $month++) {
    $sql = "SELECT SUM(amount) AS total_$month FROM income WHERE user_id = '".$user_id."' AND MONTH(date) = $month AND YEAR(date) = $year";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($query);
    $total.$month = $row['total'];
   
}
// $sql_thu1 = "SELECT sum(amount) AS thuthang1 FROM income where user_id = '".$user_id."' and MONTH(date) = 1 and YEAR(date) = 2024";
// $query_thu1 = mysqli_query($mysqli, $sql_thu1);
// $row_thu1 = mysqli_fetch_assoc($query_thu1);
// $thuthang1 = $row_thu1['thuthang1'];

// $sql_thu2 = "SELECT sum(amount) AS thuthang2 FROM income where user_id = '".$user_id."' and MONTH(date) = 2 and YEAR(date) = 2024";
// $query_thu2 = mysqli_query($mysqli, $sql_thu2);
// $row_thu2 = mysqli_fetch_assoc($query_thu2);
// $thuthang2 = $row_thu2['thuthang2'];

// $sql_thu3 = "SELECT sum(amount) AS thuthang3 FROM income where user_id = '".$user_id."' and MONTH(date) = 3 and YEAR(date) = 2024";
// $query_thu3 = mysqli_query($mysqli, $sql_thu3);
// $row_thu3 = mysqli_fetch_assoc($query_thu3);
// $thuthang3 = $row_thu3['thuthang3'];

// $sql_thu4 = "SELECT sum(amount) AS thuthang4 FROM income where user_id = '".$user_id."' and MONTH(date) = 4 and YEAR(date) = 2024";
// $query_thu4 = mysqli_query($mysqli, $sql_thu4);
// $row_thu4 = mysqli_fetch_assoc($query_thu4);
// $thuthang4 = $row_thu4['thuthang4'];

// $sql_thu5 = "SELECT sum(amount) AS thuthang5 FROM income where user_id = '".$user_id."' and MONTH(date) = 5 and YEAR(date) = 2024";
// $query_thu5 = mysqli_query($mysqli, $sql_thu5);
// $row_thu5 = mysqli_fetch_assoc($query_thu5);
// $thuthang5 = $row_thu5['thuthang5'];

// $sql_thu6 = "SELECT sum(amount) AS thuthang6 FROM income where user_id = '".$user_id."' and MONTH(date) = 6 and YEAR(date) = 2024";
// $query_thu6 = mysqli_query($mysqli, $sql_thu6);
// $row_thu6 = mysqli_fetch_assoc($query_thu6);
// $thuthang6 = $row_thu6['thuthang6'];

// $sql_thu7 = "SELECT sum(amount) AS thuthang7 FROM income where user_id = '".$user_id."' and MONTH(date) = 7 and YEAR(date) = 2024";
// $query_thu7 = mysqli_query($mysqli, $sql_thu7);
// $row_thu7 = mysqli_fetch_assoc($query_thu7);
// $thuthang7 = $row_thu7['thuthang7'];

// $sql_thu8 = "SELECT sum(amount) AS thuthang8 FROM income where user_id = '".$user_id."' and MONTH(date) = 8 and YEAR(date) = 2024";
// $query_thu8 = mysqli_query($mysqli, $sql_thu8);
// $row_thu8 = mysqli_fetch_assoc($query_thu8);
// $thuthang8 = $row_thu8['thuthang8'];

// $sql_thu9 = "SELECT sum(amount) AS thuthang9 FROM income where user_id = '".$user_id."' and MONTH(date) = 9 and YEAR(date) = 2024";
// $query_thu9 = mysqli_query($mysqli, $sql_thu9);
// $row_thu9 = mysqli_fetch_assoc($query_thu9);
// $thuthang9 = $row_thu9['thuthang9'];

// $sql_thu10 = "SELECT sum(amount) AS thuthang10 FROM income where user_id = '".$user_id."' and MONTH(date) = 10 and YEAR(date) = 2024";
// $query_thu10 = mysqli_query($mysqli, $sql_thu10);
// $row_thu10 = mysqli_fetch_assoc($query_thu10);
// $thuthang10 = $row_thu10['thuthang10'];

// $sql_thu11 = "SELECT sum(amount) AS thuthang11 FROM income where user_id = '".$user_id."' and MONTH(date) = 11 and YEAR(date) = 2024";
// $query_thu11 = mysqli_query($mysqli, $sql_thu11);
// $row_thu11 = mysqli_fetch_assoc($query_thu11);
// $thuthang11 = $row_thu11['thuthang11'];

// $sql_thu12 = "SELECT sum(amount) AS thuthang12 FROM income where user_id = '".$user_id."' and MONTH(date) = 12 and YEAR(date) = 2024";
// $query_thu12 = mysqli_query($mysqli, $sql_thu12);
// $row_thu12 = mysqli_fetch_assoc($query_thu12);
// $thuthang12 = $row_thu12['thuthang12'];



?>