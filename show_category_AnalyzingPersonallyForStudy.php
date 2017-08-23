<?php

//------카테명 출력-----------------------------------------------------------------   

    require_once("./dbconfig.php");
    $cat_id = $_GET['cat_id'];
    $sql = "select cat_name from categories where cat_id='".$cat_id."'";
    $db= db_conn();
    $result = $db->query($sql);
    
    
//*1. '카테명 추출 sql 적용물'이 true냐 아니냐
    if($result){
        $num_cats = $result->num_rows;
        
        
        
 //*2. db 추출물에 행이 있냐       
        if($num_cats == 0){
            echo "카테고리가 존재하지 않네요";
        }
        
        $row = $result->fetch_object();
        $cat_name = $row->cat_name;
        require_once("./header.php");
        echo "<h3>".$cat_name."</h3>";
        
        
//------카테 해당 책 불러오기--------------------------------------------------------          
        $sql="select * from books where cat_id = '".$cat_id."'";
        $db= db_conn();
        $result = $db->query($sql);
        
        
//*3. result가 true라면, 책 data에서 행 개수를 뺀다       
        if($result){
            $num_books = $result->num_rows;
            
            
//*4. 행 개수=0이면, 상품 없다는 메시지 띄운다         
            if($num_books == 0){
                echo "카테고리에 해당하는 상품이 존재하지 않습니다!!!";
            }
            
            $books_array=array();
            
            
            
            for($count=0; $row = $result->fetch_array(); $count++){
                $books_array[$count] = $row;
            }

            
//*5. books_array가 배열이냐 아니냐       
            if(!is_array($books_array)){
                echo "<p>카테고리에 해당하는 책이 존재하지 않습니다.</p>";
            }else{
                echo "<table width='100%' border='0'>";
            
                foreach($books_array as $row){                    //*3
                    $url='show_book.php?isbn='.$row['isbn']; //*3                  
                    echo "<tr><td>";


//*6. 책 표지 파일이 있냐 없냐
                    if(file_exists("img/".$row['isbn'].".png")){
                        $book_img="<img src='img/".$row['isbn'].".png' style='border: 1px solid black' width=100px height=120px/>";
                      ?>
                        <a href="<?php echo $url; ?>"><?php echo $book_img; ?></a>
                <?php
                }else{
                    echo "&nbsp;";
                }
                echo "</td><td>";
                $title=$row['title'].", 저자: ".$row['author'];
                ?>
                    
                <a href="<?php echo $url; ?>"><?php echo $title; ?></a>    
                <?php
                echo "</td></tr>";
              } //foreach문의 끝
              echo "</table>";        
        }
        echo "<hr />";

        } 
    }   

    
//------버튼 출력-----------------------------------------------------------------        
    echo "<div align='center'><a href='index.php'><img src='img/continue_shopping.png' border='0'></a></div>";
    
     require_once('./footer.php');

         
?>