<?php
    require_once './dbConfig.php';
    require_once './displayFunc.php';
    require_once './adminFunc.php';
    session_start();
    require_once './header.php';
    echo "<h3>새책 추가하기</h3>";
    
    if(check_admin()){
        //새책 추가 폼
        display_book_form();
        echo "<div align='center'>"
        . "<a href='admin.php'>메인메뉴 이동</a>"
        . "</div>";
    }else{
        echo "<p>관리자만이 볼 수 있는 페이지 입니다. 관리자 인증을 하시길 바랍니다!!</p>";
        echo "<a href='adminLogin.php'>관리자 로그인</a>";
    }
    
    require_once './footer.php';
?>

