<?php
     require_once("./dbconfig.php");
     
     require_once("./header.php");
     
     $isbn = $_GET['isbn'];

     if((!$isbn) || ($isbn=='')){
?> 
<script>
    alert('정상적인 경로를 이용하세요!!');
    history.back();
</script>
<?php
    exit;
   }
   
   $sql="select * from books where isbn ='".$isbn."'";
   $result = $db->query($sql);

   if($result){
       $row=$result->fetch_array();       
   }
   

//책 제목 출력
   echo "<h3>".$row['title']."</h3>";
   
//책의 상세 정보 출력하기
   echo "<table><tr>";
   if(file_exists("img/".$row['isbn'].".png")){
       echo "<td><img src='img/".$row['isbn'].".png' style='border:1px solid black'/></td>";
   }    
   
   echo "<td><ul>";
   echo "<li><strong> 저자: </strong>";
   echo $row['author'];
   echo "</li><li><strong>ISBN: </strong>";
   echo $row['isbn'];
   echo "</li><li><strong>가격: </strong>";
   echo number_format($row['price'])."원";
   echo "</li><li><strong>책 소개: </strong>";
   echo $row['description'];
   echo "</li><ul></td></tr></table>";

   echo "<hr />";
   
   if($row['cat_id']){
       $url="show_category.php?cat_id=".$row['cat_id'];
   }

   
//이전 페이지 이동
   echo "<div align='center'>"
           ."<span><a href='".$url."'><img src='img/continue_shopping.png'></a></span>"
           ."<span><a href='show_cart.php?new=".$isbn."'><img src='img/addCart.png'></a></span>"
           ."</div>";
   
//장바구니 이동
   
   
   require_once("./footer.php");
?>