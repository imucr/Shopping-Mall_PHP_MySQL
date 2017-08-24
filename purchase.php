<!--

*1. extract(array): 
배열 속의 키 값들을 변수화시켜 주는 함수
    ex) $arr[j]=100, $arr[i]=10이 있을 때 (키 값: j, i)
    extract($arr) 시
    $j = 100, $i = 10 식으로 키 값을 변수화시켜준다


*2. 트랜잭션이란, 
a, b, c 명령이 있다면 이 세 개 모두 성공적 수행되었을 떄 처리(db 반영) 되도록 하는 것.
    ex) a계좌에서 b계좌로 이체: 출금, 입금 모두 수행되어야 거래 처리
autocommit이 true이면 a, b만 정상이어도 처리가 되기에(=rollback이 안 됨), false로 바꿔줘야 함


*3. custome_id 필드에는 값을 안 넣겠다는 것.

*4
customers tb에 customer_id 없으면, 주문자 정보 입력
테이블에 주문자 정보가 있는 경우에는, custom_id값을 얻어온다.
테이블에 주문자 정보가 없는 경우에는, 주문자 정보를 입력하고, 입력된 주문자 정보의 custom_id를 얻어온다

-->

<?php
    require_once './dbConfig.php';
    require_once './cartFun.php';
    require_once './header.php';
    
    session_start();
    
    echo "<h3>결제하기</h3>";
    
    //주문 정보 받아오기
    $name = $_POST['name'];
    $zipcode = $_POST['zipcode'];
    $address = $_POST['address'];
    
    if($_SESSION['cart'] && $name && $zipcode && $address){
        
        //*1
        extract($_POST);
        
        //수령인 정보가 있는지 체크 후, DB orders 테이블에 저장
        if(empty($ship_name) && empty($ship_zipcode) && empty($ship_address)){
            $ship_name=$name;
            $ship_zipcode=$zipcode;
            $ship_address=$address;
        }
        
        
        $db= db_conn();
//======================================================        
//트랜잭션 시작 처리: 주문사항을 DB에 입력하기 위한 트랜잭션 *2
//======================================================           
        $db->autocommit(FALSE);
        
        
//*4
        $sql="select custom_id from customers where name='".$name."' and address='".$address."' and zipcode='".$zipcode."'";
        
        $result = $db->query($sql);

        if($result->num_rows > 0){  
            $customer=$result->fetch_object();
            $customer_id=$customer->custom_id;        
        }else{
            $sql="insert into customers values('','".$name."', '".$address."', '".$zipcode."')"; //*3
            $result=$db->query($sql);
            
            if(!$result){
?>
                <script>
                    alert("오류가 발생했습니다!!!!");
                    history.back();
                </script>
            <?php
                exit;
            }
                    
                $custom_id=$db->insert_id;
            }
            
            $date=date("Y-m-d"); //주문 날짜

                        
//orders tb에 배송정보 입력
       $sql = "insert into orders values('','".$custom_id."','".$_SESSION['total_price']."', '".$date."','주문','".$ship_name."', '".$ship_address."','".$ship_zipcode."')";
        
       $result=$db->query($sql);
       if(!$result){
           ?>
                <script>
                    alert('데이터베이스 오류 발생!!!');
                    history.back();
                </script>
                <?php
                exit;
       }

       
//order_id 값을 얻어오기
       $sql = "select order_id from orders where custom_id='".$custom_id."' and amount=".$_SESSION['total_price']." and date = '".$date."' and order_status='주문' and ship_name='".$ship_name."' and ship_address ='".$ship_address."' and ship_zipcode = '".$ship_zipcode."'";
       $result=$db->query($sql);
       
       if($result->num_rows>0){
           $obj = $result->fetch_object();
           $order_id = $obj->order_id;
       }else{
           ?>
           <script>
               alert('주문한 상품 내역이 존재하지 않습니다!!!');
               history.back();
           </script>
           <?php
           exit;
       }
       
       
/*주문한 상품들을 order_items tb에 저장한다:
        (order_item tb에서, 사전에 해당 isbn과 order_id 있는 행이 있다면 지워준다. 중복 방지)
        books tb에서 isbn으로 주문된 책 정보를 가져오고, */       
       
       foreach($_SESSION['cart'] as $isbn => $qty){
           if(isset($isbn)){
               $db= db_conn();
               $sql="delete from order_items where order_id='".$order_id."' and isbn='".$isbn."'";
               $result = $db->query($sql);
               
               $sql="select * from books where isbn='".$isbn."'";
               $result=$db->query($sql);
               
               if(!$result){
                   ?>
                   <script>
                       alert("데이터베이스 오류입니다.");
                       history.back();
                   </script>
                       <?php
                       exit;
               }
               
               $row=$result->fetch_array();
           }
           
           $sql = "insert into order_items values('".$order_id."', '".$isbn."', ".$row['price'].",$qty)";
           $result = $db->query($sql);
           
           if(!$result){
               ?>
               <script>
                   alert("데이터베이스 입력 오류!!!");
                   history.back();
               </script>
               <?php
               exit;
           }
       }
       
       
//======================================================          
//트랜잭션 끝: 주문사항 DB에 입력 처리 완료
//======================================================   
        $db->commit();
        $db->autocommit(TRUE);        
        
        show_cart($_SESSION['cart'], FALSE);
        
        echo "<div align='center'>
                 <a href='show_cart.php'><img src='img/continue_shopping.png'/></a>
                 </div>";        
                
    }else{
        echo "<p>주문 정보가 입력되지 않았습니다. 다시 주문사항을 확인하시기 바랍니다!!!</p>";
        echo "<a href='checkout.php'>뒤로 가기</a>";
    }
    
?>

    
    

<?php
    require_once './footer.php';
?>