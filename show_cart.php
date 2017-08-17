<!--

*1. 궁금점-?X
$_SESSION['cart'][$new]++; 
여기서 $_SESSION['cart'] 자체가 변수명? 아님 $_SESSION만?
막연히 이건 연관배열과 관련이 있구나라고밖에 생각 못하겠음
cf) https://stackoverflow.com/questions/15979952/shopping-cart-session-php

->
"$_SESSION['cart'] 자체가 연관배열의 변수명이다. 
새롭게 상품 추가 시 'named index인 $new'에 '배열값 1'이 할당되고, -구분 주의!
이후 같은 상품 추가 시엔 할당된 값이 1씩 올라간다"

-->

<?php
    require_once './dbconfig.php';
    session_start();
    //session_unset();
    //session_destroy();
    
//---------------------------------------------------------------------------------------
//추가할 상품이 있는 경우([장바구니] 버튼을 클릭했을 때)
//---------------------------------------------------------------------------------------    

if(isset($_GET['new'])){
    $new=$_GET['new'];
    
    if($new){
        if(!isset($_SESSION['cart'])){
            //등록된 세션 변수가 없으면 세션 변수를 등록
            $_SESSION['cart']=array();
            //상품갯수
            $_SESSION['items']=0;
            $_SESSION['total_price']=0;
        }

//*1        
        //장바구니에 똑같은 상품이 있는 경우
        if(isset($_SESSION['cart'][$new])){
            $_SESSION['cart'][$new]++;           
        
        //장바구니에 새롭게 추가된 상품인 경우
        }else{
            $_SESSION['cart'][$new]=1;
        }
        
        //전체 상품 수량 합계 구하기
        if(is_array($_SESSION['cart'])){
            $_SESSION['items']=0;
            foreach($_SESSION['cart'] as $isbn => $qty){
                $_SESSION['items'] += $qty; //"ex) 3+2+5+4... feat.sum=sum+1"
            }
            
        }
        
        //장바구니 총합계 구하기
        if(is_array($_SESSION['cart'])){
            $_SESSION['total_price']=0;
            foreach($_SESSION['cart'] as $isbn=>$qty){
                $sql="select price from books where isbn='".$isbn."'";
                $result=$db->query($sql);
                if($result){
                    $item=$result->fetch_object(); //result는 객체가 아니었나부지 뭐. 그러려니.
                    $item_price = $item->price;
                    $_SESSION['total_price'] += $item_price*$qty;
                }
            }//End of foreach문
            
        }
    }//end of if문
}    



//---------------------------------------------------------------------------------------
//현재 장바구니 페이지에서 [새로고침] 버튼을 클릭했을 때, 수량 및 총합계를 재계산
//---------------------------------------------------------------------------------------    



    require_once './header.php';

    echo "<h3>당신의 장바구니 내역</h3>";




//---------------------------------------------------------------------------------------
//[장바구니 보기] 버튼을 클릭했을 때
//---------------------------------------------------------------------------------------    
    
    if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
        //장바구니에 추가된 상품이 있는 경우에는 화면에 상품을 출력    
        echo "<table border='0' width=100% cellspacing='0'>"
                ."<form action='show_cart.php' method='post'>"
                ."<tr><th colspan='2' bgcolor='#F1C40F'>주문하실 상품명</th>"
                    ."<th bgcolor='#F1C40F'>가격</th>"
                    ."<th bgcolor='#F1C40F'>수량</th>"
                    ."<th bgcolor='#F1C40F'>합계</th>"
                ."</tr>";
        
        foreach($_SESSION['cart'] as $isbn =>$qty){
            if((!$isbn) || ($isbn=='')){
                ?>
                <script>
                    alert("상품 번호가 존재하지 않습니다.");
                    history.back();
                </script>
                <?php
                exit;                
            }
            $sql="select * from books where isbn='".$isbn."'";
            $result=$db->query($sql);
            if($result){
                $row=$result->fetch_array();
            }
            echo "<tr>";
            echo "<td align='left'>";
            
            //이미지를 불러오기 위한 처리
            if(file_exists("img/".$isbn.".png")){
                $size = getimagesize('img/'.$isbn.'.png');
                echo "<img src='img/".$isbn.".png' style='border: 1px solid black' width='".($size[0]/3)."'height='".($size[1]/3)."'/>";
            }else{
                echo "$nbsp;";
            }
            echo "</td>";
            
            //상품명(책 제목, 저자) 불러오기
            echo "<td align='left'>"
                    ."<a href='show_book.php?isbn=".$isbn."'>".$row['title']."</a>"
                    ." 저자: ".$row['author']."</td>"
                    ."<td align='center'>".number_format($row['price'])."원</td>"
                    ."<td align='center'>";
            echo "<input type='text' name='".$isbn."'value='".$qty."' size='3'>";
            echo "</td><td align='center'>".number_format($row['price']*$qty)."원</td></tr>\n";
        }//End of foreach문----------------------
                
        //총 합계
        echo "<tr>"
                ."<td colspan='2' bgcolor='#F1C40F'>&nbsp;</td>"
                ."<td align='center' bgcolor='#F1C40F'>&nbsp;</td>"
                ."<td align='center' bgcolor='#F1C40F'>".$_SESSION['items']."개</td>"
                ."<td align='center' bgcolor='#F1C40F'>총 합계: ".number_format($_SESSION['total_price'])."원</td></tr>";
        
        //수량 수정 후, 수정된 내용을 저장하기 위한 '새로고침' 버튼 추가
        echo "<tr>"
                ."<td colspan='5' align='right'>"
                ."<input type='submit' value='새로고침'/>"
                ."</td>"
                ."</tr>";

        echo "</form></table><hr/>";        
        
    }else{
        echo "<p>장바구니에 담긴 상품이 없습니다!!!</p>";
    }

//---------------------------------------------------------------------------------------
//버튼([쇼핑하기], [구매하기]) 추가하기
//---------------------------------------------------------------------------------------  
 /*장바구니 보기 버튼을 클릭하고 들어왔을 경우, 
쇼핑하기 버튼을 클릭하면 index.php로 이동.
show_book.php 페이지에서 장바구니 버튼을 클릭하고 들어왔을 경우, 
쇼핑하기 버튼을 클릭하면 show_category.php로 이동.*/

$url="index.php";

if(isset($new)){
    $sql2="select cat_id from books where isbn='".$new."'";
    $result2=$db->query($sql2);
    if($result2){
        $obj=$result2->fetch_object();
        $cat_id=$obj->cat_id;
        $url="show_category.php?cat_id=".$cat_id;        
    }
}    

echo "<div align='center'>"
        . "<a href='".$url."'><img src='img/continue_shopping.png'></a> "
        . "<a href='checkout.php'><img src='img/buy.png'></a> "
        . "</div>";

/*    
-----------------------------------------------------------------------------------------
*/
    
    require_once './footer.php';
?>
