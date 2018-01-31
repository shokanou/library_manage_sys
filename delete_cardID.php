<?php
session_start();
?>

<html>
<head>
<title>Card Management System</title>
</head>
<body>
<?php
require_once 'db_info.php';
$id=$_POST['id'];
if(!$id){
	echo 'You have not entered ID. Please go back and try again.';
	exit;}

@ $db=new mysqli(admin_host,adminid,password,admin_db);
  if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
  }
  
$query = "select * from library_card" ;
$result=$db->query($query);

$num_results=$result->num_rows;

for ($i=0;$i<$num_results;$i++){
	$row=$result->fetch_assoc();
	@ $db2=new mysqli(admin_host,adminid,password,admin_db);
	  if (mysqli_connect_errno()) {
		 echo "Error: Could not connect to database.  Please try again later.";
		 exit;
	  }
	$query2 = "select ReturnDate from borrow_record where borrow_record.CardID='".$row['CardID']."'" ;
	$result2=$db2->query($query2);
	$num_results2=$result2->num_rows;
	//mysql_select_db("library_management_system", $con);
	if($num_results2>0){
	for($j=0;$j<$num_results2;$j++){
	$row2=$result2->fetch_assoc();
	$date1=date("Y-m-d");
	$date2 =$row2['ReturnDate']; 
	$date11  = explode("-",$date1);
	$date22  = explode("-",$date2);
	$date1int1 = mktime(0,0,0,$date11[1],$date11[2],$date11[0]);
	$datelint2 = mktime(0,0,0,$date22[1],$date22[2],$date22[0]);
	$dated=round(($date1int1-$datelint2)/3600/24);
	
	if($id===$row['CardID']&&$dated>=0){
		$con = mysql_connect(admin_host,adminid,password,admin_db);
				if (!$con)
		  {
		  die('Could not connect: ' . mysql_error());
		  }
	
		mysql_select_db("library_management_system", $con);
		
		 
		mysql_query("DELETE FROM library_card WHERE library_card.CardID='".$id."'")or die(mysql_error());

		mysql_close($con);
		
		header("refresh:3;url='\library_management_system\card_management.html'");
		echo 'Delete card successfully! <br>refresh after 3 minutes~~~';
		break;	
	}
	else if ($id===$row['CardID']&&$dated<0){
		header("refresh:3;url='\library_management_system\card_management.html'");
		echo 'The user has book that does not return!<br>refresh after 3 minutes~~~';
		break;
	}
	}
	}
	else{
		if($id===$row['CardID'])
		$con = mysql_connect(admin_host,adminid,password,admin_db);
				if (!$con)
		  {
		  die('Could not connect: ' . mysql_error());
		  }
	
		mysql_select_db("library_management_system", $con);
		
		 
		mysql_query("DELETE FROM library_card WHERE library_card.CardID='".$id."'")or die(mysql_error());

		mysql_close($con);
		
		header("refresh:3;url='\library_management_system\card_management.html'");
		echo 'Delete card successfully! <br>refresh after 3 minutes~~~';
		break;	
	}

}

if ($i>=$num_results&&$j>=$num_results2){
	header("refresh:3;url='\library_management_system\card_management.html'");
		echo 'Card does not exit!Type another one...<br>refresh after 3 minutes~~~';
}
?>
</body>
</html>