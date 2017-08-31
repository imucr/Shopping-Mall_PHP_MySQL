<!--

*1
[구매하기], [쇼핑하기] 버튼을 form 태그 안으로 옮겼다.

    [구매하기] 버튼은, form으로 값을 보내야 하기 때문이며
        *이미지 버튼으로 form에 값 보내는 방법 씀
         form에 값을 보내려면 input type="submit" 외의 방법도 있음을 알게 됨.

    [쇼핑하기]는, [구매하기] 버튼과 나란히 출력하기 위해.


*2
purchase.php로 가는 걸로 해 놓으면, 오류 난다. 
이렇듯 기술적인 문제로 표현하고 싶은 걸 못 표현하는 경우가 왕왕 발생할 듯.
이유 -?


*3
    1) 사용처
        add_book_form.php
        edit_book_form.php

    2) 구조
        (1) bookinfo가 배열인 경우 true
            -> edit 가능
            -> [수정하기], [삭제하기] 버튼 보임 -td 하나 더 추가
        (2) bookinfo가 배열이 아닌 경우 false -> 삼항연산자에서 null 값 처리
            -> 빈 박스 보임(add 가능)
            -> [추가하기] 버튼 보임                 -td colspan='2'

        (3) 두 버튼 사이가 </form>으로 끊어져서, table 안에 table을 또 넣음으로, 두 버튼이 나란히 보이게 함

        (4) form이 두 번 쓰인 것을 주목

    *이미지 추가 기능 더하기 -보류

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
    }
?>    
    
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
                                            <a href='show_cart.php'><img src='img/continue_shopping.png'/></a> <!--*2-->                                           
                                        </div>
                                    </td>
                                </tr>

                            </form>
                        </table>
            </div> 
       
<?php
    }

    
function display_login_form(){
?>

        <form action='admin.php' method='post'>

            <div align='center'>
                <div align='center' style='border:1px solid #777; width:300px; padding:10px'>

                    <table border='0' cellpadding='3' cellspading='0'>

                        <tr>
                            <td align='right'>아이디: </td>
                            <td><input type='text' name='id'/></td>
                        </tr>

                        <tr>
                            <td align='right'>비밀번호: </td>
                            <td><input type='password' name='pw'/></td>
                        </tr>

                        <tr>
                            <td colspan='2' align='center'>
                                <input type='submit' value='로그인'/>
                            </td>
                        </tr>

                    </table>

                </div>
            </div>

        </form>
            
<?php            
    }
    
    
function display_admin_menu(){
?>
        <ul>
            <li><a href='index.php'>쇼핑몰 메인페이지</a></li>
            <li><a href='add_category_form.php'>새 카테고리 추가하기</a></li>
            <li><a href='add_book_form.php'>새 책 추가하기</a></li>
            <li><a href='change_pw_form.php'>비밀번호 변경하기</a></li>            
        </ul>            
<?php            
    }
    
    
    
function display_categoryAdd_form(){
?>        
        <form method='post' action='add_category.php'>
            <table border='0'>

                <tr>
                    <td>카테고리명</td>
                    <td><input type='text' name='cat_name' size='50' maxlength='50' value=''></td>
                </tr>

                <tr>
                    <td colspan='2' align='center'>
                        <input type='submit' value='추가' />
                    </td>
                </tr>

            </table>
        </form>
<?php            
    }

function display_book_form($bookinfo=''){ //*3
    $edit = is_array($bookinfo);
?>
    <form action="<?php echo $edit ? 'edit_book.php':'add_book.php';?>" method="post">
            <table border="0" align="center">
                <tr>
                    <td align="right">ISBN: </td>
                    <td><input type="text" name="isbn" value="<?php echo $edit ? $bookinfo['isbn']:'';?>"/></td>
                </tr>
                <tr>
                    <td align="right">책 제목: </td>
                    <td><input type="text" name="title" value="<?php echo $edit ? $bookinfo['title']:'';?>"/></td>
                </tr>
                <tr>
                    <td align="right">저자: </td>
                    <td><input type="text" name="author" value="<?php echo $edit ? $bookinfo['author']:'';?>"/></td>
                </tr>
                <tr>
                    <td>카테고리: </td>
                    <td>
                        <select name="cat_id">
                            <?php
                                $db= db_conn();
                                $sql="select * from categories";
                                $result=$db->query($sql);
                                
                                if($result){ //*1
                                    while($row=$result->fetch_array()){
                                        echo "<option value='".$row['cat_id']."'";
                                        
                                        if(($edit) && ($row['cat_id']==$bookinfo['cat_id'])){
                                            echo "selected";
                                        }                                                
                                            echo">".$row['cat_name']."</option>";                                    

                                        }
                                    }
                            ?>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td align="right">가격: </td>
                    <td><input type="text" name="price" value="<?php echo $edit ? $bookinfo['price']:'';?>"/></td>
                </tr>

                <tr>
                    <td align="right">책 소개: </td>
                    <td><textarea rows="3" cols="50" name="description"><?php echo $edit ? $bookinfo['description']:'';?></textarea></td>
                </tr>

                <tr>
                    <td colspan="2" align="center">
                        
                        <table border="0">
                            <tr>
                                <td>
                                    <input type="submit" value="<?php echo $edit ? '수정':'추가';?>하기" /></form>
                                </td>
                                <?php
                                if($edit){
                                    echo "<td>"
                                                . "<form method ='post' action = 'delete_book.php' style='margin-bottom:0'>"
                                                    ."<input type='submit' value='삭제하기' />"
                                                ."</form>"
                                            ."</td>";
                                }
                                ?>
                            </tr>
                        </table>
                        
                    </td>
                </tr>
            </table>

        </hr>
        
<?php            
    }


function display_book_info($bookinfo){
    if(is_array($bookinfo)){
        echo "<table><tr>";
        if(file_exists("img/".$bookinfo['isbn'].".png")){
            echo "<td><img src='img/".$bookinfo['isbn'].".png' style='border:1px solid black'/></td>";
        }    

        echo "<td><ul>";
        echo "<li><strong> 저자: </strong>";
        echo $bookinfo['author'];
        echo "</li><li><strong>ISBN: </strong>";
        echo $bookinfo['isbn'];
        echo "</li><li><strong>가격: </strong>";
        echo number_format($bookinfo['price'])."원";
        echo "</li><li><strong>책 소개: </strong>";
        echo $bookinfo['description'];
        echo "</li><ul></td></tr></table>";
        
    }else{
        echo "<p>책 정보를 표시할 수 없습니다.</p>";
    }

   if($bookinfo['cat_id']){ //이 조건문은, show_book.php의 else 조건문 안에 넣어야 하는 것 아닐까? $url이 그쪽으로 안 넘어감.
       $url="show_category.php?cat_id=".$bookinfo['cat_id'];
   }    
    
    echo "<hr />";
}
?>