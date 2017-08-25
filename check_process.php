<!--
*흐름:
결제 정보를 받아와서,
결제 정보가 입력되었는지 확인 후, 결제 처리
-->
 
<?php
require_once './dbConfig.php';
require_once './header.php';
require_once './cartFun.php';
require_once './display.php';

session_start();

echo "<h3>결제 내역 확인</h3>";

$card_type = $_POST['card_type'];
$card_number = $_POST['card_number'];
$card_month = $_POST['card_month'];
$card_year = $_POST['card_year'];
$card_name = $_POST['card_name'];


/*결제 정보 입력 여부 확인 후,
   주문 상품 내역 보이고,
   배송비와 전체 총합계 보이고,
   결제 처리*/
if($_SESSION['cart'] && $card_type && $card_number && $card_month && $card_year && $card_name){
    
    show_cart($_SESSION['cart'], false);

    display_shipping();
    
    echo "감사합니다. 결제 처리가 되었습니다!!!";
    
}else{
    echo "<p>결제정보가 제대로 입력되었는지 다시 확인 바랍니다!!!</p>";
    echo "<a href='card_info.php?name='".$card_name."'>뒤로 가기</a>";
}

require_once './footer.php';
?>

