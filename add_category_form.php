<!--
*1. 함수결과를 조건으로 쓸 수 있음에 주목!
-->

<?php

session_start();
require_once './admin_authFunc.php';
require_once './displayFunc.php';
require_once './header.php';


if(check_admin()){ //*1
    echo "<h3>새 카테고리 추가</h3>";
    display_categoryAdd_form();
    echo "<p align='center'><a href='admin.php'>메인 메뉴</a></p>";
}else{
    echo "<p>관리자만 사용할 수 있는 페이지입니다. 관리자 인증을 거치시기 바랍니다.</p>";
}

require_once './footer.php';
?>