<!--
*1

    1)
    books tb에 해당 카테고리의 책이 존재하지 않아야,
    categories tb에서 해당 카테고리를 삭제한다.

    2) 조건문 구조:
        관리자 로그인되었다면
                cat_id set되었다면
                        SQL이 수행되지 않는다면
                        아니라면
                                DB에 값이 존재한다면
                                아니라면
                                        SQL이 수행된다면

                아니라면
        아니라면
-->

<?php
session_start();
require_once '/dbConfig.php';
require_once './adminFunc.php';
require_once './header.php';

echo "<h3>카테고리 삭제</h3>";

if(check_admin()){
    if(isset($_POST['cat_id'])){
        $cat_id=$_POST['cat_id'];
        //DB 삭제 처리
        $db= db_conn();
        $sql = "select * from books where cat_id='".$cat_id."'";
        $result=$db->query($sql);
        
        if(!$result){
            echo "<p align='center'>삭제 처리 오류.</p>";
        }else{
            if($result->num_rows>0){
                ?>
                <script>
                    alert('카테고리에 상품이 존재합니다. 삭제 처리 불가능.');
                    history.back();
                </script>
                <?php
            }else{
                $sql = "delete from categories where cat_id='".$cat_id."'";
                $result=$db->query($sql);
                if($result){
                    echo "<p align='center'>카테고리가 정상적으로 삭제 처리 되었습니다.</p>";
                    echo "<p align='center'><a href='index.php'>삭제 확인하기</a></p>";                    
                }
            }
        }
        
    }else{
        ?>
        <script>
            alert('삭제 내용을 다시 확인하시기 바랍니다.');
            history.back();
        </script>
        <?php
    }
        
}else{
        echo "<p align='center'>관리자만 볼 수 있는 페이지입니다. 관리자 인증을 하시기 바랍니다.</p>";
        echo "<p align='center'><a href='adminLogin.php'>관리자 로그인</a></p>";          
}

echo "</hr><p align='center'>[ <a href='admin.php'>관리자 메뉴</a> ]</p>";     

require_once './footer.php';
?>