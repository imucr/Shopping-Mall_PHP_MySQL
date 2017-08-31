<!-- 

*요 파일에서 조건문 이해가 헷갈리면, 걍 카테고리&책 이미지&책 정보 모두 제대로 출력되는 경우를 가정하여 머릿속에서 돌려보면, 어느 정도 감이 잡힌다

*1. categories tb에서 cat_id 있는 행의 'cat_name' 선택
해당 개수가 0이라면 카테고리 존재하지 않는다는 메시지 띄우고,
아니라면 동명의 변수에 지정한다


*2. books tb에서 cat_id 있는 행의 '모든 것(상품)' 선택
해당 개수가 0이라면 상품이 존재하지 않는다는 메시지 띄우고,
아니라면 for문을 이용하여 내용물을 싹다 끄집어내 출력한다.


*3.
추측 "books_array 배열의 값들을 row라는 변수에 할당하고,
row의 isbn키가 가리키는 값이 url의 일부가 된다"


*fetch_object: 
배열이 아닌 객체로 가져옴
vs. fetch_array, fetch_assoc, fetch_row

-->

<?php
    
    require_once("./dbconfig.php");
    require_once ("./bookFunc.php");
    session_start(); //이건 어디에 필요 -?
    require_once("./header.php");
        
    $cat_id = $_GET['cat_id'];

//*1      
    if(get_category_name($cat_id)){
        echo "<h3>".$cat_name."</h3>";
    }else{
        echo "<p align='center'>카테고리가 존재하지 않습니다.</p>";
    }

        
//*2          
        $sql="select * from books where cat_id = '".$cat_id."'";
        $db= db_conn();
        $result = $db->query($sql);
        if($result){
            $num_books = $result->num_rows;
            if($num_books == 0){
                echo "카테고리에 해당하는 상품이 존재하지 않습니다!!!";
            }
            
            $books_array=array();
            
            
            
            for($count=0; $row = $result->fetch_array(); $count++){
                $books_array[$count] = $row;
            }
        
            if(!is_array($books_array)){
                echo "<p>카테고리에 해당하는 책이 존재하지 않습니다.</p>";
            }else{
                echo "<table width='100%' border='0'>";
            
                foreach($books_array as $row){                    //*3
                    $url='show_book.php?isbn='.$row['isbn']; //*3                  
                    echo "<tr><td>";
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
        
        echo "<div align='center'><a href='index.php'><img src='img/continue_shopping.png' border='0'></a></div>";
    
     require_once('./footer.php');

         
?>