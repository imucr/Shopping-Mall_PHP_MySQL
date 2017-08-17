<?php
function get_book_info($isbn){
    
   if((!$isbn) || ($isbn=='')){ 
       return false;
   }

    $db = db_conn();
    $sql = "select * from books where isbn = '".$isbn."'";
    $result = $db->query($sql);

    if(!$result){
       return false; 
    }else{
       $row = $result->fetch_array();
       return $row;
    }
}  
//----------------------------------------------------------------------
function get_category_name($cat_id){
   $sql = "select cat_name from categories where cat_id ='".$cat_id."'";
   $db = db_conn();
   $result = $db->query($sql);
   
   if($result){
       $num_cats = $result->num_rows;
       
       if($num_cats == 0){
           return false;
       }
       
       $row = $result->fetch_object(); // fetch_array, fetch_assoc, fetch_row, fetch_object:배열이 아닌 객체로 가져옴
       $cat_name = $row->cat_name;
       return $cat_name;
    }else{
        return false;
    }
}//----------------------------------------------------------------------

function get_books($cat_id){
       $sql="select * from books where cat_id = '".$cat_id."'";  
       $db = db_conn();
       $result = $db->query($sql);
       
       if($result){
           $num_books = $result->num_rows;
           if($num_books == 0){
               return false;
           }
           
           $books=array(); 
    
            for($count = 0; $row = $result->fetch_array(); $count++){
               $books[$count] = $row;
            } 
            return $books;
            
        }else{
            return false;
        }
}
?>

