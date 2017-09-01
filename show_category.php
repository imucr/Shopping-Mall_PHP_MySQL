<!-- 

*요 파일에서 조건문 이해가 헷갈리면, 
걍 카테고리&책 이미지&책 정보 모두 제대로 출력되는 경우를 가정하여 
머릿속에서 돌려보면, 어느 정도 감이 잡힌다

*1. categories tb에서 cat_id 있는 행의 'cat_name' 선택
해당 개수가 0이라면 카테고리 존재하지 않는다는 메시지 띄우고,
아니라면 동명의 변수에 지정한다

*2. books tb에서 cat_id 있는 행의 '모든 것(상품)' 선택
해당 개수가 0이라면 상품이 존재하지 않는다는 메시지 띄우고,
아니라면 for문을 이용하여 내용물을 싹다 끄집어내 출력한다.

*fetch_object: 
배열이 아닌 객체로 가져옴
vs. fetch_array, fetch_assoc, fetch_row

-->

<?php
    
    require_once("./dbConfig.php");
    require_once("./adminFunc.php");
    require_once ("./bookFunc.php");
    require_once ('./displayFunc.php');
    session_start(); //이건 어디에 필요 -?X: when 관리자 로그인 여부 체크
    require_once("./header.php");
        
    $cat_id = $_GET['cat_id'];

//*1      
    if($cat_name=get_category_name($cat_id)){ //그냥 if(get_category_name($cat_id) 하면, undefined variable 오류 뜸!
        echo "<h3>".$cat_name."</h3>";
    }else{
        echo "<p align='center'>카테고리가 존재하지 않습니다.</p>";
    }

        
//*2      
    if(isset($cat_id)){
            
        $books = get_books($cat_id); //값 리턴받음
        display_books($books);         //값 리턴받지 않음

        } 

    if(check_admin()){
        echo "<p align='center'>[ <a href='index.php'> 홈으로 </a> ] [ <a href='admin.php'> 관리자 메뉴 </a> ] [ <a href='edit_category_form.php?cat_id=".$cat_id."'> 카테고리 수정하기 </a> ]</p>";
    }else{
        echo "<div align='center'><a href='index.php'><img src='img/continue_shopping.png' border='0'></a></div>";
    }
    
     require_once('./footer.php');

         
?>