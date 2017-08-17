<?php
session_start();
require_once './adminFunc.php';
require_once './displayFunc.php';
require_once './header.php';

if(check_admin()){
    echo "<h3>새 카테고리 추가</h3>";
    display_category_form();    
    echo "<p align='center'><a href='admin.php'>메인 메뉴</a></p>";
}else{
    echo "<p>관리자만 사용할 수 있는 페이지 입니다. 관리자 인증을 거치시기 바랍니다.</p>";
}

require_once './footer.php';
?>

