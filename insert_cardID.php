<?php
session_start();
?>

<html>
<head>
	<title>Card Management</title>
</head>
<body>
<?php
require_once 'db_info.php';
$ID=$_POST['id'];

@ $db=new mysqli(admin_host,adminid,password,admin_db);
  if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
  }
  
$query = "select CardID from library_card" ;
$result=$db->query($query);

$num_results=$result->num_rows;

for ($i=0;$i<$num_results;$i++){
	$row=$result->fetch_assoc();
	if($ID===$row['CardID']){
		header("refresh:3;url='\library_management_system\card_management.html'");
		echo 'Card already exits!Create another one...<br>refresh after 3 minutes~~~';
		break;	
	}
}

if($i>=$num_results)
{header("Location:\library_management_system\create_card.html");
}	

$result->free();
$db->close();

?>
</body>
</html>