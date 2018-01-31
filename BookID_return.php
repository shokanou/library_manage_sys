<?php
session_start();
?>

<html>
<body>

<?php
//require_once 'db_info.php';
$CardID=$_POST['CardID'];
$BookID=$_POST['BookID'];
$currentdate=date( "Y-m-d");

@ $db = mysql_pconnect("localhost","root");
  if (mysqli_connect_errno()) {
     echo 'Error: Could not connect to database.  Please try again later.';
     exit;
  }
  
  $query="select *  from borrow_record where CardID='".$CardID."'";
 $result=$db->query($query);
 
  $num_results=$result->num_rows;
  
  
  
  for($i=0;$i <$num_results; $i++){
	  $row = $result->fetch_assoc();
	  $date1=date("Y-m-d");
	 $date2 =($row['ReturnDate']); 
	 $date11  = explode("-",$date1);
	 $date22  = explode("-",$date2);
	 $date1int1 = mktime(0,0,0,$date11[1],$date11[2],$date11[0]);
	 $datelint2 = mktime(0,0,0,$date22[1],$date22[2],$date22[0]);
	 $dated=round(($date1int1-$datelint2)/3600/24);
	  if($BookID==$row['BookID'] AND $dated<=0){
						 $con = mysql_connect(admin_host,adminid,password,admin_db);
						if (!$con)
						  {
						  die('Could not connect: ' . mysql_error());
						  }
						else{
						mysql_select_db("library_management_system", $con);

						mysql_query("UPDATE book SET book.Stock = book.Stock+1   
						WHERE '".$BookID."'=book.BookID");
						
						mysql_query("UPDATE borrow_record SET borrow_record.ReturnDate= '".$currentdate."'
						where  '".$CardID."'=borrow_record.CardID  AND  '".$BookID."'=borrow_record.BookID");
						
						 header("refresh:3; url=return.html");
						echo "Return successfully! <br>refresh after 3 minutes";
						mysql_close($con);
						}
	  }
	 else if($BookID==$row['BookID']){
		  header("refresh:3; url=return.html");
		  echo "The user already returned this book. Please try again!";
	 }
	 else
	{
		  header("refresh:3; url=return.html");
		  echo "The user doesn't borrow this book. Please try again!";
	  }
  }

    $result->free();
  $db->close();

?>
</body>
</html>