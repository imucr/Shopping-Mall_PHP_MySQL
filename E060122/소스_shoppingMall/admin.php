<?php
require_once './dbconfig.php';
require_once './displayFunc.php';
require_once './adminFunc.php';
session_start();

if(isset($_POST['id']) && isset($_POST['pw'])){
    $admin_id = $_POST['id'];
    $admin_pw = $_POST['pw'];
    
    if(adminLogin($admin_id, $admin_pw)){
            $_SESSION['admin_id'] = $admin_id;
    }else{
            require_once './header.php';
            echo "<h3>로그인 실패</h3>";
            echo "<p>관리자 로그인에 실패 하였습니다. 다시 로그인하세요!!!</p>";
            echo "<a href='adminLogin.php'>관리자 로그인</a>";
            require_once './footer.php';
            exit;
    }   
}

require_once './header.php';
if(check_admin()){
          echo "<h3>관리자 메인 페이지</h3>";
          display_admin_menu();
}else{
    echo '<p>관리자만이 볼 수 있는 페이지 입니다. 관리자 인증을 거치시기 바랍니다!!!</p>';
    echo "<a href='adminLogin.php'>관리자 로그인</a>";
}






?>

