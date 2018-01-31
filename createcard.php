<?php
session_start();
?>

<html>
<head>
  <title>Create Card</title>
</head>
<body>
<?php
require_once 'db_info.php';
$id=$_POST['id'];
$name=trim($_POST['name']);
$dept=trim($_POST['dept']);
$type=$_POST['type'];

if(!$id||!$name||!$dept||!$type){
	echo 'You have not entered details. Please go back and try again.';
	exit;
}

if (!get_magic_quotes_gpc()){
	$name = addslashes($name);
    $dept = addslashes($dept);
	$type = addslashes($type);
  }


$con = mysql_connect(admin_host,adminid,password,admin_db);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("library_management_system", $con);

$sql="INSERT INTO library_card (CardID,BName,Dept_name, Type)
VALUES
('$id','$name','$dept','$type')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
header("refresh:3;url='\library_management_system\card_management.html'");
		echo 'Create a new card successfully<br>refresh after 3 minutes~~~';

mysql_close($con)
  
?>

