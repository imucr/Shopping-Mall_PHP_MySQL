<?php
    function display_shipping($shipping=2500){
?>

    <table border='0' width='100%' cellspacing='0'>
        <tr><td colspan='4' align='right'> 배송비: </td>
               <td align='center'><?php echo number_format($shipping)?>원 </td></tr>
        <tr><td bgcolor='aquamarine' colspan='4' align='right'>전체 총합계: </td>
               <td bgcolor='aquamarine' align='center'><?php echo number_format($shipping+$_SESSION['total_price'])?>원</td></tr>
    </table><br/>     

<?php
    }
?>