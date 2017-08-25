<!--

*1
[구매하기], [쇼핑하기] 버튼을 form 태그 안으로 옮겼다.

    [구매하기] 버튼은, form으로 값을 보내야 하기 때문이며
        *이미지 버튼으로 form에 값 보내는 방법 씀
         form에 값을 보내려면 input type="submit" 외의 방법도 있음을 알게 됨.

    [쇼핑하기]는, [구매하기] 버튼과 나란히 출력하기 위해.

-->

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
    function display_card_form($name){
?>         
            <div style="margin:20px;">
                        <table border='0' width='60%' cellspacing='0' align="center">
                            <form action="check_process.php" method="post">

                                <tr>
                                    <th colspan="2" bgcolor="#F1C40F">신용카드 결제 정보</th>
                                </tr>

                                <tr>
                                    <td align="right">신용카드사: </td>
                                    <td><select name="card_type">
                                                <option value="bcCard">비씨카드</option>
                                                <option value="samsungCard">삼성카드</option>
                                                <option value="lotteCard">롯데카드</option>
                                                <option value="kookminCard">카드</option>                                      
                                           </select>                            
                                    </td>
                                </tr>

                                <tr>
                                    <td align="right">카드번호: </td>
                                    <td><input type="text" name="card_number" value="" maxlength="4" size="4"></td>                        
                                </tr>

                                <tr>
                                    <td align="right">카드 만료일: </td>
                                    <td>월: <select name="card_month">
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option> 
                                                    <option value="04">04</option>      
                                                    <option value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option> 
                                                    <option value="08">08</option>                                                    
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option> 
                                                    <option value="12">12</option>                                                    
                                                 </select>
                                        연도: <select name="card_year">
                                                    <?php
                                                        for($y=date("Y"); $y<date("Y")+10; $y++){
                                                            echo "<option value='".$y."'>".$y."</option>";
                                                        }
                                                    ?>
                                                </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td align="right">카드 소유자 이름: </td>
                                    <td><input type="text" name="card_name" value="<?php echo $name;?>" maxlength="40" size="40"></td>
                                </tr>
                                
                                <tr><!--*1-->
                                    <td colspan="2">
                                        <div align="center" stype="padding:10px">
                                            <input type='image' src='img/buy.png' />
                                            <a href='show_cart.php'><img src='img/continue_shopping.png'/></a>                                           
                                        </div>
                                    </td>
                                </tr>

                            </form>
                        </table>
            </div> 
                        
<?php
    }


    }
