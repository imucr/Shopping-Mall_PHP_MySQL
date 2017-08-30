<!--

*1. 
원래는 foreach문 썼는데, 작동하지 않아 while로 대체.
명령 뭐 쓸지를 결정할 때 이런 것도 이유가 될 수 있구나
    foreach($row as $cat){ //추측"foreach에선 가져올 배열명을, 임의로 $cat이라 정할 수 있다"

    while vs. foreach -?

-->

<?php
    require_once './dbConfig.php';
    require_once './admin_authFunc.php';
    require_once './displayFunc.php';
    session_start();
    require_once './header.php';
    echo "<h3>새책 추가하기</h3>";

    if(check_admin()){

        display_book_form();

        echo "<div align='center'>"
        ."<a href='admin.php'>메인메뉴 이동</a>"
        ."</div>";
    }else{
        echo "<p>관리자만이 볼 수 있는 페이지입니다. 관리자 인증을 하시기 바랍니다!!</p>";
        echo "<a href='adminLogin.php'>관리자 로그인</a>";
    }

    require_once './footer.php';
?>