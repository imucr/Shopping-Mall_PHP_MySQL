<?php
    require_once './adminFunc.php';
    require_once './dbconfig.php';
    session_start();
    require_once './header.php';
    echo "<h3>책 삭제 확인</h3>";
    if(check_admin()){
        $cat_id=$_POST['cat_id'];
        if(isset($_POST['isbn'])){
            $isbn = $_POST['isbn'];
            //DB에서 삭제처리
            $db=db_conn();
            $sql="delete from books where isbn ='".$isbn."'";
            $result = $db->query($sql);
            
            if($result){
                echo "<p align='center'>".$isbn." 책이 정상적으로 삭체 처리되었습니다!!";
                echo "<p align='center'><a href='show_category.php?cat_id=".$cat_id."'>확인하기</a></p>";
            }else{
                echo "<p align='center'>".$isbn." 책을 삭제할 수 없습니다. 다시 확인 바랍니다!!";
            }
            echo "<p align='center'><a href='admin.php'>관리자 메뉴</a></p>";
        }else{
            ?>
                <script>
                    alert('삭제하고자 하는 책의 ISBN값이 입력되지 않았습니다!! 다시 확인 바랍니다!!!');
                    history.back();
                </script> 
            <?php
        }
    }else{
        echo "<p align='center'>관리자만이 볼 수 있는 페이지 입니다. 관리자 인증 하시기 바랍니다!!!</p>";
        echo "<p align='center'><a href='admin.php'>관리자 메뉴</a></p>";
    }
    
    require_once './footer.php';
?>

