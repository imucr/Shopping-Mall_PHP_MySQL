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


*3. 
이미 있는 isbn을 추가하려고 하면, 아래처럼 오류 메시지 두 개가 뜬다. 하나만 뜨게 할 수 없을까 -?X: 해결

                echo "<p>책이 이미 존재하거나, 추가 시 데이터베이스 오류 발생.<p>";
                echo "<p align='center'><a href='add_book_form.php'>다시 입력하기</a></p>";

                echo "<p>새 책 추가 시 오류 발생!</p>";
                echo "<p align='center'><a href='add_book_form.php'>다시 입력하기</a></p>";

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
    
    
    
    function add_category($cat_name){
        $db = db_conn();
        $sql = "select * from categories where cat_name='" . $cat_name . "'";
        $result = $db->query($sql);

        if ((!$result) || ($result->num_rows != 0)) {
            return false;
        } 
            $sql = "insert into categories values('', '" . $cat_name . "')";
            $result = $db->query($sql);
            
            if (!$result) { //sql 수행이 안 되면
                return false;
            } else {
                return true;
            }
        }        

function add_book($isbn, $title, $author, $cat_id, $price, $description){
    $db= db_conn();  
    $sql="select * from books where isbn='".$isbn."'";
    $result=$db->query($sql);

//    
    if((!$result) || ($result->num_rows != 0)){ //*3
        return false;
    }    

//    
    $sql = "insert into books values('".$isbn."', '".$author."','".$title."','".$cat_id."','".$price."','".$description."')";            
    $result=$db->query($sql);
            
    if(!$result){
        return false;
    }else{
        return true;
    }    
}        
?>