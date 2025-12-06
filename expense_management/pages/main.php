
    <?php
    if(isset($_GET['page'])){
        $temp=$_GET['page'];
    }else{
        $temp='';
    }
    if($temp=='overview'){
        include("main/overview.php");
    }elseif($temp=='income'){
        include("main/income.php");
    }elseif($temp=='income_type'){
        include("main/income_type.php");
    }elseif($temp=='spending'){
        include("main/spending.php");
    }elseif($temp=='spending_type'){
        include("main/spending_type.php");
    }elseif($temp=='budget'){
        include("main/budget.php");
    }elseif($temp=='saving'){
        include("main/saving.php");
    }elseif($temp=='statistics'){
        include("main/statistics.php");
    }elseif($temp=='profile'){
        include("main/profile.php");
    }
    // elseif($temp=='weekly_statistics'){
    //     include("main/weekly_statistics.php");
    // }elseif($temp=='monthly_statistics'){
    //     include("main/monthly_statistics.php");
    // }
    else{
        include("main/overview.php");
    }
    ?>


