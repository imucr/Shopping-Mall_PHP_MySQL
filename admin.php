<!--
*조건문 구조:

id와 pw가 입력됐다면
	
	맞게 입력됐다면
		admin_id를 세션 할당
		~~한다
	아니라면
		로그인 실패 메시지


	세션에 admin_id 할당됐다면
		관리자 메인 페이지 띄움
	아니라면
		정상적인 관리자 인증 요청 메시지

아니라면
	입력 요청 메시지
-->

<?php
require_once './dbConfig.php';
require_once './header.php';
require_once './displayFunc.php'; //함수를 담는 파일은 이와 같이 ~Func 붙이는 것이 관례인 듯.
session_start();

//session_unset();
//session_destroy();

if($_POST['id'] && $_POST['pw']){
    $admin_id = $_POST['id'];
    $admin_pw = $_POST['pw'];
    
    //인증 처리
    $db= db_conn();
    
    $sql="select * from admin where username='".$admin_id."' and password=sha1('".$admin_pw."')";
    $result=$db->query($sql);
    
    if($result->num_rows>0){
        $_SESSION['admin_id'] = $admin_id;        
    }else{
        echo "<h3>로그인 실패</h3>";
        echo "<p>관리자 로그인에 실패하였습니다. 다시 로그인하세요.</p>";
        echo "<a href='adminLogin.php'>관리자 로그인</a>";
        require_once './footer.php';
    }
    
    
    if(isset($_SESSION['admin_id'])){ //Issue: 로그인에 실패하여도, 이 부분이 보여버림
        echo "<h3>관리자 메인 페이지</h3>";
        display_admin_menu();        
    }/*else{
        ?>
        <script>
            alert('정상적인 관리자 인증을 해야 합니다.');
            history.back();
        </script>
        <?php
            exit;
            }*/
    
}else{
?>
<script>
    alert('아이디 및 비밀번호를 입력하세요!!!');
    history.back();
</script>
<?php
exit; //php 프로그램 자체를 종료 혹은 탈출. 스크립트 자체를 멈춰버림
}