<!--
*1. 조건문 구조:

    id와 pw가 set됐다면
        맞게 입력됐다면
            admin_id를 세션 할당
        아니라면
            로그인 실패 메시지

    세션에 admin_id 할당됐다면
        관리자 메인 페이지 띄움
    아니라면
        경고 메시지 띄움

-->

<?php
require_once './dbConfig.php';
require_once './displayFunc.php'; //함수를 담는 파일은 이와 같이 ~Func 붙이는 것이 관례인 듯.
require_once './admin_authFunc.php';
session_start();


//*1
if(isset($_POST['id']) && isset($_POST['pw'])){
    $admin_id = $_POST['id'];
    $admin_pw = $_POST['pw'];

    if(adminLogin($admin_id, $admin_pw)){
        $_SESSION['admin_id'] = $admin_id;
    }else{
        require_once './header.php';
        echo "<h3>로그인 실패</h3>";
        echo "<p>관리자 로그인에 실패하였습니다. 다시 로그인하세요.</p>";
        echo "<a href='adminLogin.php'>관리자 로그인</a>";
        require_once './footer.php';
        exit; //php 프로그램 자체를 종료 혹은 탈출. 스크립트 자체를 멈춰버림
    }
}
    require_once './header.php';
    
    if(check_admin()){ 
        echo "<h3>관리자 메인 페이지</h3>";
        display_admin_menu();        
    }else{
        echo '<p>관리자만이 볼 수 있는 페이지입니다.</p>';
    }

?>
