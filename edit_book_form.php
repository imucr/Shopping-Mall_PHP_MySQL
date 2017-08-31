<?php

    require_once './dbConfig.php';
    require_once './displayFunc.php';
    require_once './adminFunc.php';
    require_once './bookFunc.php';
    session_start();
    require './header.php'; //require_once와 다른 건가 -?
    
    echo "<h3>책 정보 수정</h3>";

    if(check_admin()){
        if($bookinfo = get_book_info($_GET['isbn'])){
            display_book_form($bookinfo);        
            echo "<p align='center'><a href='admin.php'>관리자 페이지로</a></p>";                
        }else{
            echo "책 정보를 검색할 수 없습니다.";
        }
        
    }else{
        echo "<p>관리자만이 이용할 수 있는 페이지입니다. 관리자 인증을 하시기 바랍니다.</p>";
        echo "<a href='adminLogin.php'>관리자 로그인</a>";        
    }
    
    require './footer.php';

?>