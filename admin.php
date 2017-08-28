<!--
*조건문 구조:


-->

<?php
require_once './dbConfig.php';
require_once './displayFunc.php'; //함수를 담는 파일은 이와 같이 ~Func 붙이는 것이 관례인 듯.
require_once './admin_authFunc.php';
session_start();

if($_POST['id'] && $_POST['pw']){
    $admin_id = $_POST['id'];
    $admin_pw = $_POST['pw'];

    if(adminLogin($admin_id, $admin_pw)){
        $_SESSION['admin_id'] = $admin_id;
        require_once './header.php';
    }else{
        echo "<h3>로그인 실패</h3>";
        echo "<p>관리자 로그인에 실패하였습니다. 다시 로그인하세요.</p>";
        echo "<a href='adminLogin.php'>관리자 로그인</a>";
        require_once './footer.php';
    }
    
    if(isset($_SESSION['admin_id'])){
        echo "<h3>관리자 메인 페이지</h3>";
        display_admin_menu();        
    }
    
}else{
?>
<script>
    alert('아이디 및 비밀번호를 입력하세요!!!');
    history.back();
</script>
<?php
exit; //php 프로그램 자체를 종료 혹은 탈출. 스크립트 자체를 멈춰버림
}