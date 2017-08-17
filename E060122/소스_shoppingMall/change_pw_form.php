<?php
session_start();
require_once './adminFunc.php';
require_once './header.php';
echo "<h3>비밀번호 변경하기</h3>";

if(check_admin()){
    ?>
    <form action="change_pw.php" method="post">
        <table width="300px" cellpadding="5" cellspacing="0" bgcolor="#a0d3e8" align="center">
            <tr>
                <td>비밀번호 : </td>
                <td><input type="password" name="old_pw" size="16" maxlength="16"/></td>
            </tr>
            <tr>
                <td>새 비밀번호 : </td>
                <td><input type="password" name="new_pw" size="16" maxlength="16"/></td>
            </tr>
            <tr>
                <td>비밀번호 확인 : </td>
                <td><input type="password" name="renew_pw" size="16" maxlength="16" /></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="비밀번호 변경하기"/>
                </td>
            </tr>
        </table>
    </form>
    <?php
}else{
    echo "<p align='center'>관리자만 볼 수 있는 페이지 입니다. 관리자 인증을 하시기 바랍니다!!!</p>";
    echo "<p align='center'><a href='adminLogin.php'>관리자 로그인</a></p>";
}
    echo "<hr/><p align='center'><a href='admin.php'>관리자 메뉴</a></p>";
require_once './footer.php';
?>

