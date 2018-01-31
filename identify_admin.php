<?php session_start(); 
$_SESSION['ADMINID']=$_POST['id'];
echo $_SESSION['ADMINID'];
?>
<html>
<body>

<?php
require_once 'db_info.php';
$ID=$_POST['id'];
$password=$_POST['password'];

@ $db=new mysqli(admin_host,adminid,password,admin_db);
if (mysqli_connect_errno()){
	echo 'Error: Could not connect to database. Please try again later.';
	exit;
}

$query="select AdminID, Password from administrator";
$result=$db->query($query);
$num_results=$result->num_rows;

for($i=0;$i<$num_results;$i++){
	$row=$result->fetch_assoc();
	if($ID==$row['AdminID'] && $password==$row['Password']){
		
		echo 'log in  successfully...<br>refresh after 3 minutes~~~';
		header("refresh:3;url='\library_management_system\administrator_page.html'");
		
		
		break;
	}
}

if($i>=$num_results)
	{echo "Wrong Password or ID!";
	header("refresh:3;url='\library_management_system\administrator_access.html'");
	echo 'loading please...<br>refresh after 3 minutes~~~';
	}





$result->free();
$db->close();

?>
</body>
</html>