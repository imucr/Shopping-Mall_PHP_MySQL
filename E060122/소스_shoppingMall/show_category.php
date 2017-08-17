<?php
   require_once("./dbconfig.php");
   require_once("./adminFunc.php");
   require_once("./bookFunc.php");
   require_once("./displayFunc.php");
   session_start();
   require_once("./header.php");
   
   $cat_id = $_GET['cat_id'];
   
   if($cat_name=get_category_name($cat_id)){
       echo "<h3>".$cat_name."</h3>";
   }else{
        echo "<p align='center'>카테고리가 존재하지 않네요!!!</p>";
   }   
       
   if(isset($cat_id)){
        $books = get_books($cat_id);
        display_books($books);
    }
    
    if(check_admin()){
        echo "<p align='center'>[ <a href='index.php'> 홈으로 </a> ] [ <a href='admin.php'> 관리자 메뉴 </a> ] [ <a href='edit_category_form.php?cat_id=".$cat_id."'> 카테고리 수정하기 </a> ]</p>";
    }else{
       echo "<div align='center'><a href='./index.php'><img src='img/continue_shopping.png' border='0'></a></div> ";
    }
       require_once('./footer.php');
?>

