<!--

*1. 조건문 구조:

    올바른 id와 pw가 아니라면
            false 반환
    id와 pw값이 있다면
            true 반환
    아니라면
            false 반환

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
?>