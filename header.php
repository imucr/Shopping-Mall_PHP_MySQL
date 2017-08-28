<!--
hr: horizontal rule, 가로 줄
valign: vertical alignment, 셀 안의 내용 위치

*1
background: 입력 후 Ctrl+Space 누르면 색깔 보며 선택 가능. 다른 페이지에서 색 선택 시에도 쓰면 유용!
-->



<html>
    <head>
        <title>Shopping Mall</title>
        
        <style>   
            h3{ color:blue; margin:10px; }
            hr{ width:80%; text-align:center; } /* *1 */
        </style>
        
    </head>



    <body>
        <table width="100%" border="0" cellspacing="0" bgcolor="#cccccc">
            <tr>
                <td>
                    <h2>PHP 쇼핑몰 제작하기</h2>
                </td>
            </tr>
            
            <td align="right" valign="bottom">
                <?php
                    if(isset($_SESSION['admin_id'])){
                        echo "[ <a href='./logout.php'>로그아웃</a> ]";                        
                    }else{
                        echo "[ <a href='./show_cart.php'>장바구니 보기</a> ]";
                    }
                 ?>
            </td>
        </table>
