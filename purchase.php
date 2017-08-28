<!--
*1
주문 정보를 입력하는 중간중간 에러가 발생(return false)하지 않을 때에나, 출력

*2
checkout.php -> purchase.php -> card_info.php(결제 정보 입력 폼)로 name을 넘겨주려면, get방식으로 넘긴다(url 이용)

*생각 메모:
긴 코드를 함수화하여 별도 페이지로 빼면(module화), 조건문 분기를 단순화할 수 있다.

-->

<?php
    require_once './dbConfig.php';
    require_once './cartFun.php';
    require_once './orderFunc.php';
    require_once './displayFunc.php';
    require_once './header.php';
    
    session_start();
    
    echo "<h3>주문 내역 확인</h3>";
    
    //주문 정보 받아오기
    $name = $_POST['name'];
    $zipcode = $_POST['zipcode'];
    $address = $_POST['address'];
    
    
    if($_SESSION['cart'] && $name && $zipcode && $address){
        
        if(input_order_info($_POST) !=false){ //*1
            
            show_cart($_SESSION['cart'], FALSE); //장바구니 내용 출력

            display_shipping(); //배송료를 포함한 총합계 구하기

            //display_card_form($name); //결제 정보 입력폼 출력
            

    
        }else{
            echo "<p>주문 정보 입력 시 오류가 발생하였습니다!! 새로 입력해 주세요!!!</p>";
            echo "<a href='checkout.php'>뒤로 가기</a>";
        }   
        
    }else{
        echo "<p>주문 정보가 입력되지 않았습니다. 다시 주문사항을 확인하시기 바랍니다!!!</p>";
        echo "<a href='checkout.php'>뒤로 가기</a>";
    }
    
?>

<div align='center'>
    <a href='card_info.php?name=<?php echo $name;?>'><img src='img/buy.png'></a><!--*2-->
    <a href='checkout.php'><img src='img/continue_shopping.png'></a>
</div>    
    

<?php
    require_once './footer.php';
?>