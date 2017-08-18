<?php
    require_once './dbconfig.php';
    require_once './header.php';
?>

<h3>주문 정보 입력하기</h3>
<br/><br/>

<table border="0" width="100%" cellspacing="0" padding="5" cellpadding="10">
    <form action="#" method="post">
        <tr>
            <th colspan="2" bgcolor="#ffedcc">주문자 정보</th>
        </tr>
        <tr>
            <td>이름: </td>
            <td><input type="text" name="name" value="" maxlength="40" size="40"/></td>                
        </tr>
        <tr>
            <td>우편번호: </td>
            <td><input type="text" name="zipcode" value="" maxlength="10" size="10"/></td>
        </tr>
        <tr>
            <td>주문자 주소: </td>
            <td><input type="text" name="address" value="" maxlength="100" size="100"/></td>                
        </tr>        

       <tr>
            <th colspan="2" bgcolor="#ffedcc">수령인 정보</th>
        </tr>
        <tr>
            <td>우편번호: </td>
            <td><input type="text" name="zipcode" value="" maxlength="10" size="10"/></td>
        </tr>
        <tr>
            <td>수령인 주소: </td>
            <td><input type="text" name="address" value="" maxlength="100" size="100"/></td>                
        </tr>        
        
    </form>
</table>