
    <?php
    if(isset($_GET['page'])){
        $temp=$_GET['page'];
    }else{
        $temp='';
    }
    if($temp=='faq'){
        include("main/FAQ.php");
    }elseif($temp=='policy'){
        include("main/Policy.php");
    }elseif($temp=='register'){
        include("main/register.php");
    }
    else{
        include("main/login.php");
    }
    ?>
