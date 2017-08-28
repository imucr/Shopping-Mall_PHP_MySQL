<?php
    require_once './header.php';
    require_once './displayFunc.php';
    session_start();
    
    
    echo "<div align='center'><h3>관리자 로그인</h3></div>";
    
    display_login_form();
    
    require_once './footer.php';
    
?>


