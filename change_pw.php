<?php

session_start();
require_once './dbConfig.php';
require_once './adminFunc.php';
require_once './header.php';

echo "<h3>비밀번호 변경</h3>";

if(check_admin()){
    if(filled_out($_POST)){
        $username=$_SESSION['admin_id'];
        $new_pw=$_POST['new_pw'];
        $renew_pw=$_POST['renew_pw'];
        //$old_pw = $_POST['old_pw'];
        
        if($new_pw !=$renew_pw){
            echo "<p align='center'>새로운 비밀번호를 재확인하시기 바랍니다.</p>";
            echo "<p align='center'><a href='change_pw_form.php'>다시 입력하기</a></p>";   
        }else if(){
            
        }else{
            
        }
    }else{
        ?>
        <script>
            alert('새로운 비밀번호를 제대로 입력했는지 다시 확인 요망.');
            history.back();
        </script>
        <?php
        exit;
    }
}else{
        echo "<p align='center'>관리자만 볼 수 있는 페이지입니다. 관리자 인증을 하시기 바랍니다.</p>";
        echo "<p align='center'><a href='adminLogin.php'>관리자 로그인</a></p>";    
}

require_once './footer.php';
?>