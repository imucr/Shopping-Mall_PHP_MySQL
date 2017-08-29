<!--

*1. 조건문 구조:

    올바른 id와 pw가 아니라면
            false 반환
    id와 pw값이 있다면
            true 반환
    아니라면
            false 반환

*2.
form에 입력된 값이라면 아무거나 받는다.
입력되는 값이 배열일 수도 있기에, foreach로 돌린다
-->

<?php
    function adminLogin($admin_id, $admin_pw){ //인증 처리 *1
   
       $db=db_conn();
       $sql = "select * from admin where username='".$admin_id."' and password =sha1('".$admin_pw."')";
       $result = $db->query($sql);
       
       if(!$result){
           return 0;
       }
       
       if($result->num_rows>0){
           return 1;
       }else{
           return 0;
       }
       
    }

    
    function check_admin(){
        if(isset($_SESSION['admin_id'])){
            return true;
        }else{
            return false;
        }
    }
    
//*2    
    function filled_out($form_elements){
        foreach($form_elements as $key => $value){ 
            if(!isset($key) || ($value =='')){
                return false;
            }
        }
        
        return true; //false와 true 둘 중 하나만 실행되도록, 이건 else에 집어넣어야 하는 것 아닐까 -?
    }
    
?>