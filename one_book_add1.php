<html>
<head>
	<title>One Book Add Result</title>
</head>
<body>
	<h1><center>One Book Add Result</center></h1>
<? php
	require_once 'db_info.php';
	$book_number = $_POST['book_number'];
	$category = $_POST['category'];
	$title = $_POST['title'];
	$publisher = $_POST['publisher'];
	$pub_year = $_POST['pub_year'];
	$author = $_POST['author'];
	$price = $_POST['price'];
	$row = array();
	
	if(!$book_number|| !$category|| !$title|| !$publisher|| !$pub_year|| !$author || !$price)
	{
		echo"You have not entered all details.<br>Please go back and try again.";
		exit;
	}

	$book_number = addslashes($book_number);
	$category = addslashes($category);
	$title = addslashes($title);
	$publisher = addslashes($publisher);
	$pub_year = addslashes($pub_year);
	$author = addslashes($author);
	$price = doubleval($price);

	@ $db = mysql_connect(admin_host,adminid,password,admin_db);

	if(!$db)
	{
		echo"Error: could not connect to database.Please try again later.";
		exit;
	}

		mysql_select_db("library_management_system");
		$first_result=
			mysql_query("SELECT Total_volume,Stock
					FROM book
					WHERE BookID='".$book_number."';
		");
		$row=mysql_fetch_array($first_result);
		
		
		
		
		if(!$row)
		{
			$query= "INSERT INTO books VALUES
			('".$book_number."','".$category."','".$title."','".$publisher."','".$pub_year."','".$author."','".$price."',1,1);";
			//echo $query;
			
		}
		else
		{
			$num_results = mysql_num_rows($first_result);

			for($i=0;$i<$num_results;$i++)
			{
				$query2="DELETE FROM book WHERE BookID='".$book_number."';";
	
				$result1=mysql_query($query2);
				//echo $query2;
				$full_quan1=$row[0]+1;
				//echo $row[0];
				//echo"<br>";
				//echo $full_quan1;
				//echo"<br>";
				$quantity1=$row[1]+1;
				//echo $quantity1;
				$query= "INSERT INTO book values
				('".$book_number."','".$category."','".$title."','".$publisher."','".$pub_year."','".$author."','".$price."','".$full_quan1."','".$quantity1."');";
				//echo $query;
			}
		}
	
	$result = mysql_query($query);

	if($result)
		echo mysql_affected_rows()."book added into database";
?>

    <a href="/library_management_system/add_book.html"><center>Back</center></a>

</body>
</html>