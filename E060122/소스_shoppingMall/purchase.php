<?php
    require_once './dbConfig.php';
    require_once './orderFunc.php'; 
    require_once './cartFun.php';
    require_once './displayFunc.php';
    require_once './header.php';    
    
    session_start();
    
    echo "<h3>주문 내역 확인</h3>";
    
    // 주문 정보 받아오기
    $name = $_POST['name'];
    $zipcode = $_POST['zipcode'];
    $address = $_POST['address'];
   
    //주문자 정보가 입력 되었는지 확인하고 주문 정보를 데이터베이스 입력처리한다.
    if($_SESSION['cart'] && $name &&  $zipcode && $address ){
        
       if(input_order_info($_POST) !=false){
       
        show_cart($_SESSION['cart'], FALSE); // 장바구니 내용 출력
        
        display_shipping(); //배송료를 포함한 총합계 출력

        //display_card_form($name);  //결제 사항 정보 출력

       }else{
           echo "<p>주문 정보 입력시 오류가 발생 하였습니다!!!. 새로 입력 해주세요!!!</p>";
           echo "<a href = 'checkout.php'>뒤로가기</a>";
       }
}else{ 
        echo "<p>주문 정보가 입력 되지 않았습니다. 다시 주문사항을 확인하시길 바랍니다!!!!</p>";
        echo "<a href = 'checkout.php'>뒤로가기</a>";
}   
?>
<div align = 'center'>
    <a href='card_info.php?name=<?php echo $name;?>'><img src='img/buy.png'></a> 
    <a href='checkout.php'><img src='img/continue_shopping.png'></a>  
</div>



<?php
    require_once './footer.php';
?>



