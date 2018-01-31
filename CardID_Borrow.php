<?php
session_start();
?>
<html>
<head>
<meta charset="utf-8">
<title> Borrow Management</title>
</head>
<body>
<h1>Borrow State Of</h1>
<?php
require_once 'db_info.php';
$id=$_POST['id'];
echo "<strong>".$id."<br/>";

 @ $db = new mysqli(admin_host,adminid,password,admin_db);

  if (mysqli_connect_errno()) {
     echo 'Error: Could not connect to database.  Please try again later.';
     exit;
  }
 
 $query="select * from book natural join borrow_record where $id=borrow_record.CardID";
 $result=$db->query($query);
 
 $num_results=$result->num_rows;
 
 echo "<p>Number of books found: ".$num_results."</p>";
 echo "<br />";
  
  for ($i=0; $i <$num_results; $i++) {
     $row = $result->fetch_assoc();
     echo "<p><strong>".($i+1).". BookID: ";
     echo htmlspecialchars(stripslashes($row['BookID']));
     echo "</strong><br />Title: ";
     echo stripslashes($row['BookName']);
     echo "<br />Catagory: ";
     echo stripslashes($row['Catagory']);
     echo "<br />Publisher: ";
     echo stripslashes($row['Publisher']);
	 echo "<br />Year: ";
     echo stripslashes($row['PubYear']);
	 echo "<br />Author: ";
     echo stripslashes($row['Author']);
	 echo "<br />Price: ";
     echo stripslashes($row['Price']);
	 echo "<br />Total Volume: ";
     echo stripslashes($row['Total_volume']);
	 echo "<br />Stock: ";
     echo stripslashes($row['Stock']);
     echo "<br />";
	 $date1=date("Y-m-d");
	 $date2 =($row['ReturnDate']); 
	 $date11  = explode("-",$date1);
	 $date22  = explode("-",$date2);
	 $date1int1 = mktime(0,0,0,$date11[1],$date11[2],$date11[0]);
	 $datelint2 = mktime(0,0,0,$date22[1],$date22[2],$date22[0]);
	 $dated=round(($date1int1-$datelint2)/3600/24);
	 if($dated>=0)
	 {echo "The book is already returned"."<br/>";}
	 else
	 { echo "Should be returned at ".$date2."<br/>";}
	  }

	  $result->free();
		$db->close(); 
		
	echo "<br/>"
	
		
?>
	<h2>Enter BookID To Borrow Book</h2>
	<form action="BookID_Borrow.php" method="post">
	BookID: <input type="text" name="BookID"><br />
	<input type="submit" name='submit' value='submit'>
	<input name="CardID" type="hidden" value="<?php echo $id ?>" >
	</form>
</body>
