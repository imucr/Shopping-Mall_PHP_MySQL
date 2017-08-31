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

function get_category_name($cat_id){
    $sql = "select cat_name from categories where cat_id='".$cat_id."'";
    $db= db_conn();
    $result = $db->query($sql);
    if($result){
        $num_cats = $result->num_rows;
        if($num_cats == 0){
            return false;
        }
        
        $row = $result->fetch_object();
        $cat_name = $row->cat_name;
        return $cat_name;
        
    }else{
        return false;
    }
}  

?>