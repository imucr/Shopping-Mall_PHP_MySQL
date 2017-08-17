<?php
    require_once './adminFunc.php';
    require_once './dbconfig.php';
    session_start();

    require_once './header.php';
    echo "<h3>책 정보 수정 확인</h3>";
    
    if(check_admin()){
        if(filled_out($_POST)){
             $old_isbn = $_POST['old_isbn'];
             $isbn = $_POST['isbn'];
             $title = $_POST['title'];
             $author = $_POST['author'];
             $cat_id=$_POST['cat_id'];
             $price = $_POST['price'];
             $description = $_POST['description'];
             
             //DB update
             $db=db_conn();
             $sql = "update books set isbn='".$isbn."', "
                     . "title='".$title."', "
                     . "author='".$author."',"
                     . "cat_id='".$cat_id."',"
                     . "price='".$price."',"
                     . "description='".$description."' "
                     . "where isbn = '".$old_isbn."'";
             $result = $db->query($sql);
             
             if($result){
                 echo "<p align='center'>책정보가 정상적으로 수정되었습니다!!!</p>";
                 echo "<p align='center'><a href='show_book.php?isbn=".$isbn."'>확인하기</a></p>";
             }else{
                 echo "<p align='center'>DB 수정 오류 발생!!!</p>";
             }
             
        }else{
            ?>
            <script>
                alert('수정하고자 하는 책 정보가 제대로 입력 되었는지 다시 확인 바랍니다!!!');
                history.back();
            </script>
            <?php
            exit;
        }
        echo "<p align='center'><a href='admin.php'>관리자 메뉴</a></p>";
        
    }else{
        echo "관리자만 볼 수 있는 페이지 입니다. 관리자 인증을 하시길 바랍니다!!!";
        echo "<p align='center'><a href='admin.php'>관리자 메뉴</a></p>";
    }
    require_once './footer.php';
?>

