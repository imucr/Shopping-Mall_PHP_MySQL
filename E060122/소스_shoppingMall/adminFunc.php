<?php
    function adminLogin($admin_id, $admin_pw){
        //인증처리
       $db=db_conn();
       $sql = "select * from admin where username='".$admin_id."' and password =sha1('".$admin_pw."')";
       $result = $db->query($sql);
       
       if(!$result){
           return 0;
       }
       
       if($result->num_rows >0){
           return 1;
       }else{
           return 0;
       }
    }
    //-----------------------------------------------------------------------------
    function check_admin(){
        if(isset($_SESSION['admin_id'])){
            return true;
        }else{
            return false;
        }
    }
    //-----------------------------------------------------------------------------
    // 폼요소에 대한 유효성 검사 
    function filled_out($form_elements){
        foreach($form_elements as $key => $value){
            if(!isset($key) || ($value =='')){
                return false;
            }
        }
        return true;
    }
    //-----------------------------------------------------------------------------
    function add_category($cat_name){
         //DB에 카테고리를 insert 한다.
        $db = db_conn();
    //DB에 카테고리가 존재하는지 확인하기 위한 쿼리
        $sql = "select * from categories where  cat_name = '".$cat_name."'";
        $result = $db->query($sql);
        
        if((!$result) || ($result->num_rows !=0)){
            return false;
        }
        
        $sql = "insert into categories values('','".$cat_name."')";
        $result = $db->query($sql);
        
        if(!$result){
             return false;
        }else{
             return true;
        }
    }
    //-----------------------------------------------------------------------------
    function add_book($isbn, $title, $author, $cat_id, $price, $description){
        $db = db_conn();
            // DB에 추가할 책이 있는 지 확인한다.
            $sql = "select * from books where isbn='".$isbn."'";
            $result = $db->query($sql);
            
            if((!$result) || ($result->num_rows !=0)){
                return false;
            }
            // 새책 추가하기
            $sql = "insert into books values('".$isbn."', '".$author."','".$title."','".$cat_id."','".$price."','".$description."')";            
            $result = $db->query($sql);
            
            if(!$result){
                return false;
            }else{
                return true;
            }
    }
    
    
?>

