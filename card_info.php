<?php
require_once './dbConfig.php';
require_once './header.php';
require_once './cartFun.php';
require_once './displayFunc.php';

session_start();

echo "<h3>결제 정보 입력</h3>";

show_cart($_SESSION['cart'], false);
display_shipping();
display_card_form($_GET['name']); //purchase.php에서, get방식으로 받아서 넣음

require_once './footer.php';
?>