<?php
session_start();
require_once './dbConfig.php';
require_once './header.php';
require_once './adminFunc.php';
require_once './bookFunc.php';
require_once './displayFunc.php';

echo "<h3>카테고리 수정</h3>";

if(check_admin()){
    if($cat_name= get_category_name($_GET['cat_id'])){ //$_GET['$cat_id] (X)
        $cat_id = $_GET['cat_id'];
        $category = compact('cat_name', 'cat_id'); //*1. 변수를 배열로 변환. <-> extract 함수(인자를 변수로 변환) 
        
        display_category_form($category);
        
    }else{
        ?>
        <script>
            alert('카테고리가 존재하지 않습니다.');
            history.back();
        </script>
        <?php
    }
}else{
        echo "<p align='center'>관리자만 볼 수 있는 페이지입니다. 관리자 인증을 하시기 바랍니다.</p>";
        echo "<p align='center'><a href='adminLogin.php'>관리자 로그인</a></p>";      
}

echo "<hr/><p align='center'>[ <a href='admin.php'>관리자 메뉴</a> ]</p>";

require_once './footer.php';
?>