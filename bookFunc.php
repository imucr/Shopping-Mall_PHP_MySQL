<?php
function get_book_info($isbn){

     if((!$isbn) || ($isbn=='')){
         return false;
     }
                 
     $db= db_conn();   
     $sql="select * from books where isbn ='".$isbn."'";
     $result = $db->query($sql);

     if(!$result){
        return false;
     }else{
        $row = $result->fetch_array();
        return $row;
     }
     
}
     
?>