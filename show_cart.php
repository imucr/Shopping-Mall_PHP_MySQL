<!--

*1. -?X
$_SESSION['cart'][$new]++; 
여기서 $_SESSION['cart'] 자체가 변수명? 아님 $_SESSION만?
막연히 이건 연관배열과 관련이 있구나라고밖에 생각 못하겠음
cf) https://stackoverflow.com/questions/15979952/shopping-cart-session-php

    A.추측"$_SESSION['cart'] 자체가 연관배열의 변수명이다. 
    새롭게 상품 추가 시 'named index인 $new'에 '배열값 1'이 할당되고, -구분 주의!
    이후 같은 상품 추가 시엔 할당된 값이 1씩 올라간다"

    A.추측2"cart에는 $가 안 붙었으니, 당연히 $_SESSION['cart'] 자체가 변수명이다..."

    A.추측3"multidimentional array이다" 연관배열과 연관배열 조합도 가능하나 -?



*2.
추측"show_book.php에서 url로 new=".$isbn."'라고 받아왔기에
foreach에서 $isbn 인덱스명을 쓰는 줄 알았는데,
그냥 '인덱스명 -> 배열 요소' 구조에 맞게만 쓰면 다른 인덱스명을 써도 되는 걸지도"


*3
변경하는 것은 수량($qty)인데, 왜 isbn을 건드릴까 -?


*4
$_SESSION['cart']를 받아오는 건가부지...
-> 하단 코드를 보면 $_SESSION['total_price']= sum_price($_SESSION['cart']); 이걸 확인할 수 있다. 즉 내 생각이 맞음.


*5
아래의 예를 봐선 $_SESSION['~~~']이 꼭 array라는 법은 없는 듯하다.
$_SESSION['cart']=array();
$_SESSION['items']=0;
$_SESSION['total_price']=0;

-->

<?php
    require_once './dbconfig.php';
    require_once './cartFun.php';
    
    session_start();
    //session_unset();
    //session_destroy();

    
//*4. 장바구니 총합계 구하는 함수
    function sum_price($cart){
        $price=0;
        if(is_array($cart)){
            foreach($cart as $isbn => $qty){
                $sql="select price from books where isbn='".$isbn."'";
                $db= db_conn();
                $result=$db->query($sql);
                if($result){
                    $item=$result->fetch_object();
                    $item_price=$item->price;
                    $price+=$item_price*$qty;                    
                }
            }
        }
        return $price;
    }

    
//장바구니 총수량을 구하는 함수
    function sum_items($cart){
        $items=0;
        if(is_array($cart)){
            foreach($cart as $isbn => $qty){
                $items+=$qty;
            }
        }
        return $items;
    }
    
//---------------------------------------------------------------------------------------
//추가할 상품이 있는 경우([장바구니] 버튼을 클릭했을 때)
//---------------------------------------------------------------------------------------    

if(isset($_GET['new'])){
    $new=$_GET['new'];
    
    if($new){
        if(!isset($_SESSION['cart'])){
            //등록된 세션 변수가 없으면 세션 변수를 등록
            $_SESSION['cart']=array(); //*5
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
        $_SESSION['items']=sum_items($_SESSION['cart']);
        
        
        //장바구니 총합계 구하기
        $_SESSION['total_price']= sum_price($_SESSION['cart']);
        
    }
}    



//---------------------------------------------------------------------------------------
//현재 장바구니 페이지에서 [새로고침] 버튼을 클릭했을 때, 수량 및 총합계를 재계산
//---------------------------------------------------------------------------------------    

    if(isset($_POST['refresh'])){
        foreach($_SESSION['cart'] as $isbn => $qty){
            if($_POST[$isbn]=='0'){ //*3
                unset($_SESSION['cart'][$isbn]);                
            }else{
                $_SESSION['cart'][$isbn]=$_POST[$isbn];
            }
        }//End of foreach문
        

        //총수량 재계산(=기존 총수량 계산)-----------------
        $_SESSION['items']=sum_items($_SESSION['cart']);
        
        //총합계 재계산(=기존 총합계 계산)-----------------
        $_SESSION['total_price']= sum_price($_SESSION['cart']);
        
        
    }

    require_once './header.php';

    echo "<h3>당신의 장바구니 내역</h3>";




//---------------------------------------------------------------------------------------
//[장바구니 보기] 버튼을 클릭했을 때
//---------------------------------------------------------------------------------------    
    
    if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
        //장바구니에 추가된 상품이 있는 경우에는 화면에 상품을 출력    
       show_cart($_SESSION['cart']);
        
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
    $db= db_conn();
    $result2=$db->query($sql2);
    if($result2){
        $obj=$result2->fetch_object();
        $cat_id=$obj->cat_id;
        $url="show_category.php?cat_id=".$cat_id;        
    }
}    

if(isset($_SESSION['cart'])){
    echo "<div align='center'>"
            . "<a href='".$url."'><img src='img/continue_shopping.png'></a> "
            . "<a href='checkout.php'><img src='img/buy.png'></a> "
            . "</div>";  
}else{
    echo "<div align='center'>"
            ."<a href='".$url."'><img src='img/continue_shopping.png'></a>"
            ."</div>";
}


/*    
-----------------------------------------------------------------------------------------
*/
    
    require_once './footer.php';
?>