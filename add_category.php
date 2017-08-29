<!--
*1
세션값이 있다면,
    폼에 입력된 값이 true라면(유효성 체크),
        DB에 동명 카테고리 존재 여부 확인하고,
        카테고리 insert
-->

<?php

session_start();
require_once './dbConfig.php';
require_once './admin_authFunc.php';
require_once './header.php';
echo "<h3>새 카테고리 추가 확인</h3>";

//*1
if(check_admin()){
    
    if(filled_out($_POST)){
        $cat_name=$_POST['cat_name'];

        $db=db_conn();                
        $sql="select * from categories where cat_name='".$cat_name."'";
        $result=$db->query($sql);
        
        if((!$result) || ($result->num_rows != 0)){
            echo "<p>이미 카테고리가 존재하거나, 추가 시 오류가 발생하였습니다.</p>";
            echo "<a href='add_category_form.php'>뒤로 가기</a>";        
        }else{
            $sql="insert into categories values('', '".$cat_name."')";
            $result=$db->query($sql);
            if(!$result){ //sql 수행이 안 되면
                echo "<p>".$cat_name." 추가 시 오류가 발생하였습니다.</p>";
            }else{
                echo "<p>".$cat_name." 카테고리가 정상적으로 추가되었습니다.</p>";
                echo "<a href='admin.php'>메인 메뉴</a>";
                
            }
        }
        
    }else{
        echo "<p>카테고리가 입력되지 않았습니다. 다시 확인 바랍니다.</p>";
        echo "<a href='add_category_form.php'>뒤로 가기</a>";
    }
}else{
    echo "<p>관리자만이 이용할 수 있는 페이지입니다. 관리자 인증을 하시기 바랍니다.</p>";
}

require_once './footer.php';
?>