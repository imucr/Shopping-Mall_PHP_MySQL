<?php
    require_once './dbConfig.php';
    require_once './adminFunc.php';
    session_start();    
    require_once './header.php';
    
    if(check_admin()){
        if(filled_out($_POST)){
            $isbn = $_POST['isbn'];
            $title = $_POST['title'];
            $author = $_POST['author'];
            $cat_id = $_POST['cat_id'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            
            //DB에 추가하기
            if(add_book($isbn, $title, $author, $cat_id, $price, $description)){
                echo "<p>새책이 정상적으로 추가 되었습니다!!!</p>";
                echo "<a href=admin.php>메인 메뉴로 이동</a>";
            }else{
                echo "<p>책이 이미 존재하거나 추가시 데이터베이스 오류 발생!!</p>";
                echo "<p align='center'><a href='add_book_form.php'>다시 입력하기</a></p>";
            }
        }else{
            echo "<p>추가할 책의 정보가 제대로 입력 되었는지 다시 확인 바랍니다!!!</p>";
            echo "<p align='center'><a href='add_book_form.php'>다시 입력하기</a></p>";
        }
    }else{
        echo "<p>관리자만이 볼 수 있는 페이지 입니다. 관리자 인증을 하시기 바랍니다!!!</p>";
        echo "<a href='adminLogin.php'>관리자 로그인</a>";
    }
    require_once './footer.php';
?>

