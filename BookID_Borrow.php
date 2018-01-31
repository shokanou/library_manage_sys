<?php
session_start();
?>

<html>
<body>

<?php

//require_once 'db_info.php';

$CardID=$_POST['CardID'];
$BookID=$_POST['BookID'];
$BorrowDate=date("Y-m-d");
$ReturnDate=date("Y-m-d",strtotime("$BorrowDate+1months"));


@ $con = mysql_pconnect("localhost","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("library_management_system", $con);

$result2 = mysql_query("select Stock from book where book.BookID='".$BookID."'");
$arr = mysql_fetch_assoc($result2);
//echo $arr['Stock'];
if($arr['Stock']==0)
	{header("refresh :3;url='\library_management_system\borrow.html'");
	echo "Have No Stock Anymore!<br>
	refresh after 3 minutes~~~";}
else{
			$con2 = mysql_connect(admin_host,adminid,password,admin_db);
			if (!$con2)
			  {
			  die('Could not connect: ' . mysql_error());
			  }
			mysql_select_db("library_management_system", $con2);
			
			$sql=mysql_query("INSERT INTO borrow_record VALUES ('".$BookID."', '".$CardID."', '".$BorrowDate."' , '".$ReturnDate."','".$_SESSION['ADMINID']."')") or die(mysql_error());
	
			if(!$sql){
					  header("refresh:3;url='\library_management_system\borrow.html'");
				echo 'An error has occurred. Try again!<br>
			refresh after 3 minutes~~~'; }
			
			else{
			mysql_query("UPDATE book SET book.Stock = book.Stock-1
			WHERE book.BookID='".$BookID."'");
			header("refresh:3;url='\library_management_system\borrow.html'");
					echo 'Create a new borrow record successfully<br>refresh after 3 minutes~~~';
			    }
			mysql_close($con2);
}

mysql_close($con);
?>
</body>
</html>