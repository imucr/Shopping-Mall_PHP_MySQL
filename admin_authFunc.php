<?php
    function adminLogin($admin_id, $admin_pw){
       
        //인증처리
   
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

?>