<?php
session_start();
require_once './dbconfig.php';
require_once './adminFunc.php';
require_once './header.php';
echo "<h3>카테고리 수정 확인</h3>";

if(check_admin()){
    if(filled_out($_POST)){
        $cat_name = $_POST['cat_name'];
        $cat_id = $_POST['cat_id'];
        $db = db_conn();
        $sql = "update categories set cat_name='".$cat_name."' where cat_id = '".$cat_id."'";
        $result = $db->query($sql);
        
        if($result){
            ?>
                <script>
                    alert("카테고리 수정처리 완료!!!!");
                    location.replace('index.php');
                </script>
            <?php
            exit;
        }else{
            echo "<p align='center'>카테고리를 수정처리 실패!!!!</p>";
        }
        
    }else{
        ?>
            <script>
                alert('카테고리 수정 사항이 제대로 입력 되었는지 다시 확인하시기 바랍니다!!!!');
                history.back();
            </script>
        <?php
    }
}else{
    echo "<p align='center'>관리자만이 볼 수 있는 페이지 입니다. 관리자 인증을 하시기 바랍니다!!</p>";
    echo "<p align='center'><a href='adminLogin.php'>관리자 로그인</a></p>";
}
    echo "<hr/><p align='center'>[ <a href='admin.php'>관리자 메뉴</a> ]</p>";
require_once './footer.php';
?>

