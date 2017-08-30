<!--

*1
db 접속(dbconfig.php 파일을 별도로 만들어 불러옴)
db의 변수 sql을 실행한다
-?X: '->' 이게 정확히 뭘까?: 생성된 객체를 변수로 설정 후, 변수에서 메서드 호출
    vs. =>: 연관배열에서 쓰임


*2
result가 false면 false를 넘겨주고, true이면 result의 num_rows를 num_cats에 담는다
num_cats가 0이면 false를 넘겨주고, 
아니라면, for문을 돌려 각각의 row'값'을 '가져온다'
-?X: php for문:  for($count=0; $row=$result->fetch_array(); $count++){ -자바 for문 비슷. 그러려니....


*4
cat_array가 array가 아니라면, 카테고리 존재하지 않는다는 메시지 출력
array가 맞다면,
cat_array를 row로서 foreach하여,
    *foreach: 반복한다/지정배열의 요소 개수만큼/~~로서
url은 row의 cat_id에서, cat_name은 row의 cat_name에서 가져오고,
cat_name을 출력한다
cat_name을 클릭하면 show_category.php로 이동한다
    *ul, li: html의 리스트 태그

-->

<?php
    require_once("./dbconfig.php");
    session_start();
    
    $sql='select cat_id, cat_name from categories';
    $db= db_conn();
    $result=$db->query($sql); //*1
    
    
//*2
    if($result){
        $cat_array=array();
        
        for($count=0; $row=$result->fetch_array(); $count++){
        $cat_array[$count]=$row;
        }
    }
    
    
    
    require_once("./header.php");
    
?>



        
        
        
        <h3>쇼핑몰에 오신 것을 환영합니다!!!</h3>
        
        <p>원하는 카테고리를 선택하세요: </p>
        
        
        
        
        
        <?php
        
        
//*4
            if(!is_array($cat_array)){
                echo "<p>카테고리가 존재하지 않습니다</p>";
            }
         
          
            
            
//*5
            echo "<ul>";
            foreach($cat_array as $row){ 
                $url="show_category.php?cat_id=".$row['cat_id'];
                $cat_name = $row['cat_name'];
                echo "<li>";
         ?>
                <a href="<?php echo $url?>"><?php echo $cat_name; ?></a>    
        <?php
                echo "</li>";
            }
             echo "</ul>";



//*7
             echo "<hr />";
                    
             if(isset($_SESSION['admin_id'])){
                 echo "<div align='center'>"
                         ."<a href='admin.php'>관리자 페이지로</a>"
                         ."</div>";
             }
             
     require_once('./footer.php');

        ?>
