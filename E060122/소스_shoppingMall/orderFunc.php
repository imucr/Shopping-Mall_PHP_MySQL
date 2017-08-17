<?php
    //카드 입력정보를 받아서 처리해주는 함수
    function check_process($card_info){
        return true;
    }

    function input_order_info($order_info){
        // extract(array) : 배열속의 키값들을 변수화 시켜주는 함수
        extract($order_info);
        
        //수령인 정보가 있는지 체크 후 DB orders 테이블에 저장
       if(empty($ship_name) && empty($ship_zipcode) && empty($ship_address)){
           $ship_name = $name;
           $ship_zipcode = $zipcode;
           $ship_address = $address;
       }
       
       $db = db_conn();
       
       //==========================================       
       // 트랜잭션 시작 처리 : 주문사항을 데이터베이스에 입력하기 위한 트랜잭션
       //==========================================              
       $db->autocommit(FALSE);
       
       //customers 테이블에 custom_id 없으면 주문자 정보를 입력
       $sql = "select custom_id from customers where name ='".$name."' and address='".$address."' and zipcode='".$zipcode."'";
       
       $result = $db->query($sql);       
       
       if($result->num_rows > 0){ //테이블에 주문자 정보가 있는 경우에는 custom_id값을 얻어온다.
           $customer = $result->fetch_object();
           $custom_id = $customer->custom_id;
       }else{ //테이블에 주문자 정보가 없는 경우에는 주문자 정보를 입력한다.
           $sql ="insert into customers values('','".$name."','".$address."','".$zipcode."')";
           $result = $db->query($sql);
                      
           if(!$result){
               return false;
           }
           // 입력된 주문자 정보의 custom_id를 얻어온다.
           $custom_id = $db->insert_id;
       }
       $date = date("Y-m-d"); //주문 날짜
       
         // orders 테이블에 배송정보를 입력
       $sql = "insert into orders values('','".$custom_id."','".$_SESSION['total_price']."', '".$date."','주문','".$ship_name."', '".$ship_address."','".$ship_zipcode."')";
       
       $result= $db->query($sql);

       if(!$result){
           return false;
       }
       //order_id 값을 얻어오기
       $sql = "select order_id from orders where custom_id='".$custom_id."' and amount=".$_SESSION['total_price']." and date = '".$date."' and order_status='주문' and ship_name='".$ship_name."' and ship_address ='".$ship_address."' and ship_zipcode = '".$ship_zipcode."'";
       
       $result = $db->query($sql);
       
       if($result->num_rows>0){
           $obj = $result->fetch_object();
           $order_id = $obj->order_id;
       }else{
           return false;
       }
       
       //주문한 상품들을 order_items 테이블에 저장한다. 
       foreach($_SESSION['cart'] as $isbn => $qty){
           //books 테이블에서 주문된 책의 정보를 가져온다.
           if(isset($isbn)){
               
               $sql="delete from order_itmes where order_id='".$order_id."' and isbn = '".$isbn."'";               
               $result = $db->query($sql);
               
               $sql = "select * from books where isbn = '".$isbn."'";
               $result = $db->query($sql);
               if(!$result){
                   ?>
            <script>
                alert("데이터베이스 오류1");
                history.back();
            </script>
                   <?php
                   exit;
               }
               $row = $result->fetch_array();
           }
           
           $sql = "insert into order_items values('".$order_id."', '".$isbn."', ".$row['price'].",$qty)";
           
           $result = $db->query($sql);
           if(!$result){
               return false;
           }
       }
        
       $db->commit();
       $db->autocommit(TRUE);
 //==========================================       
 // 트랙잭션 끝: 주문사항 데이터베이스에 입력 처리 완료
 //==========================================             
       return true;
    }// ---------------------------------
?>

