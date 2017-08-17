<?php
require_once './header.php';
session_start();

unset($_SESSION['admin_id']);
session_destroy();

echo "<h3>로그아웃</h3>";
echo "<p>로그아웃 되었습니다!!!</p>";

echo "<p><a href='adminLogin.php'>관리자 로그인</a><p>";

require_once './footer.php';
?>

