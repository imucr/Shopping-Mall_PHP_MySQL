<!--

*1
관리자 로그인 되면
    관리자 메뉴를 보여준다
아니라면
    쇼핑하기, 장바구니 버튼 보여준다

*2
single quatation은, $isbn이 아니라 url을 감싼다. 틀리면 isbn이 edit_book_form.php로 넘어가지도 않으니 주의!!

-->

<?php
    require_once("./dbconfig.php");
    require_once './bookFunc.php';
    require_once './displayFunc.php';
    require_once("./adminFunc.php");
    session_start();
    require_once("./header.php");
     
    $isbn = $_GET['isbn'];

//책 정보 get하여, display한다  
    $bookinfo = get_book_info($isbn);

    display_book_info($bookinfo);
    
   
//*1
if(check_admin()){
    echo "<div align='center'>"
            ."[ <a href='edit_book_form.php?isbn=".$isbn."'>책 관리하기</a> ] " //*2
            ."[ <a href='admin.php'>관리자 메인메뉴로 이동</a> ] "
            ."[ <a href='index.php'>메인메뉴로 이동</a> ]"
            ."</div>";            
}else{
    echo "<div align='center'>"
            ."<span><a href='show_category.php?cat_id=".$bookinfo['cat_id']."'><img src='img/continue_shopping.png'></a></span>"
            ."<span><a href='show_cart.php?new=".$isbn."'><img src='img/addCart.png'></a></span>"
            ."</div>";    
}   
   require_once("./footer.php");
?>