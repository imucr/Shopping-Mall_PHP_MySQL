<!--

*1. extract(array): 
배열 속의 키 값들을 변수화시켜 주는 함수
    ex) $arr[j]=100, $arr[i]=10이 있을 때 (키 값: j, i)
    extract($arr) 시
    $j = 100, $i = 10 식으로 키 값을 변수화시켜준다

-->

<?php
    require_once './dbConfig.php';
    require_once './cartFun.php';
    require_once './header.php';
    
    session_start();
    
    echo "<h3>결제하기</h3>";
    
    //주문 정보 받아오기
    $name = $_POST['name'];
    $zipcode = $_POST['zipcode'];
    $address = $_POST['zddress'];
    
    if($_SESSION['cart'] && $name && $zipcode && $address){
        
        //*1
        extract($_POST);
        
        //DB orders 테이블에 저장
        if(empty($ship_name) && empty($ship_zipcode) && empty($ship_address)){
            $ship_name=$name;
            $ship_zipcode=$zipcode;
            $ship_address=$address;
        }
    }
    
?>

    
<div align="center">
    <a href="show_cart.php"><img src="img/continue_shopping.png"/></a>
</div>    

<?php
    require_once './footer.php';
?>