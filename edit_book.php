<!--
*1. 조건문 구조:

    관리자 로그인 했다면
            폼에 제대로 된 값이 입력되었다면
                    sql 수행이 잘 된다면
                    아니라면
            아니라면
    아니라면
-->

<?php
    require_once './adminFunc.php';
    require_once './dbConfig.php';
    session_start();
    require_once './header.php';
    
    echo "<h3>책 정보 수정 확인</h3>";

//*1    
    if(check_admin()){
        if(filled_out($_POST)){
             $old_isbn = $_POST['old_isbn'];
             $isbn = $_POST['isbn'];
             $title = $_POST['title'];
             $author = $_POST['author'];
             $cat_id=$_POST['cat_id'];
             $price = $_POST['price'];
             $description = $_POST['description'];
             
             $db = db_conn();
             $sql = "update books set isbn='".$isbn."', "
                                               . "title='".$title."', "
                                               . "author='".$author."',"
                                               . "cat_id='".$cat_id."',"
                                               . "price='".$price."',"
                                               . "description='".$description."' "
                                               . "where isbn = '".$old_isbn."'";

             $result=$db->query($sql);

             if($result){
                 echo "<p align='center'>책 정보가 정상적으로 수정되었습니다.</p>";
                 echo "<p align='center'><a href='show_book.php?isbn=".$isbn."'>확인하기</a></p>"; //single quatation 주목!
             }else{
                 echo "<p align='center'>DB 수정 오류 발생.</p>";                 
             }
             
        }else{
            ?>
            <script>
                alert('수정하고자 하는 책 정보가 제대로 입력되었는지 다시 확인 바랍니다.')
                history.back(); //그냥 <a href='edit_book_form.php'> 할 때와 달리, 값이 보존된 채 이전 화면으로 돌아간다
            </script>
            <?php
            exit;
        }
        echo "<p align='center'><a href='admin.php'>관리자 메뉴</a></p>";            
        
    }else{
        echo "<p align='center'>관리자만 볼 수 있는 페이지입니다. 관리자 인증을 하시기 바랍니다.</p>";
        echo "<p align='center'><a href='admin.php'>관리자 메뉴</a></p>";      
    }
    
    require_once './footer.php';
?>
