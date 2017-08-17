<?php
   require_once './dbconfig.php';
   require_once './bookFunc.php';
   require_once './displayFunc.php';
   require_once './adminFunc.php';
   session_start();
   require_once("./header.php");
   
   $isbn = $_GET['isbn'];
   
   $bookinfo = get_book_info($isbn);
   if(is_array($bookinfo)){
        echo "<h3>".$bookinfo['title']."</h3>";
   }
   
   //책정보 출력하기
   display_book_info($bookinfo);
   
   //관리자 로그인 되었는지 확인 후 책정보를 수정할 수 있도록 관리자 메뉴를 보여준다.
   if(check_admin()){
       echo "<div align='center'>"
                . "[ <a href='edit_book_form.php?isbn=".$isbn."'>책 관리하기</a> ] "
                . " [ <a href='admin.php'>관리자 메인메뉴로 이동</a> ] "
                . " [ <a href='index.php'>메인메뉴로 이동</a> ]" 
       . "</div>";
   }else{
        //이전 쇼핑하기 및 장바구니 담기 버튼
        echo "<div align='center'>"
                . "<span><a href='show_category.php?cat_id=".$bookinfo['cat_id']."'><img src='img/continue_shopping.png'></a> </span>"
                . "<span> <a href='show_cart.php?new=".$isbn."'><img src='img/addCart.png'></a></span>"
                . "</div>";   
   }
   
   require_once("./footer.php");
?>

