<?php
session_start();
require_once './dbConfig.php';
require_once './adminFunc.php';
require_once './header.php';

echo "<h3>새카테고리 추가 확인</h3>";


if(check_admin()){
    //유효성 체크    
    if(filled_out($_POST)){
            $cat_name = $_POST['cat_name'];

            if(add_category($cat_name)){
                    echo "<p>".$cat_name." 카테고리가 정상적으로 추가되었습니다.</p>";
                    echo "<a href='admin.php'>메인메뉴 이동</a>";
            }else{
                    echo "<p>이미 카테고리가 존재하거나 추가시 오류가 발생하였습니다..</p>";
                    echo "<a href='add_category_form.php'>뒤로가기</a>";
            }        
    }else{
            echo "<p>카테고리가 입력되지 않았습니다. 다시 확인 바랍니다!!!</p>";
            echo "<a href='add_category_form.php'>뒤로가기</a>";
    }
}else{
    echo "<p>관리자만이 이용할 수 있는 페이지 입니다. 관리자 인증을 하시기 바랍니다!!!!</p>";
    echo "<a href='adminLogin.php'>관리자 로그인</a>";
}

require_once './footer.php';
?>

