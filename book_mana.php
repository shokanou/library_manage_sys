<html>
<head>
	<title>Book management system</title>
</head>
<body>
<h1><font face="微软雅黑"><center>Book Management System</center></font></h1>
<?php

require_once 'db_info.php';
//error_reporting(E_ALL & ~E_NOTICE); 
	$searchtype = $_POST['searchtype'];
	$start_year = $_POST['start_year'];
	$end_year = $_POST['end_year'];
	$start_Price = $_POST['start_price'];
	$end_Price = $_POST['end_price'];
	$BookName = $_POST['title'];
	$Author = $_POST['author'];
	$Publisher = $_POST['publisher'];
	//echo $searchtype;
	
	
	
	trim($BookName);
	trim($Author);
	trim($Publisher);

	
	
	if (!$BookName && !$Author &&!$Publisher)
	{
		echo"You have not entered search details. Please go back and try again";
		exit;
	}

	$searchtype = addslashes($searchtype);	
	$start_Price = doubleval($start_Price);
	$end_Price = doubleval($end_Price);


	$db = mysql_connect(admin_host,adminid,password,admin_db);

	if(!$db)
	{
		echo"Error: could not connect to database.Please try again later.";
		exit;
	}


	mysql_select_db("library_management_system",$db) or die(mysql_error());




	 if($start_year)
	 {
	 	if($end_year)
	 	{
	 		$query1 = 
	 		"SELECT BookID,Catagory,BookName,Publisher,PubYear,Author,Price,Total_volume,Stock FROM book 
	 		WHERE book.Catagory = '".$searchtype."' 
			AND book.BookName LIKE '%".$BookName."%' 
			AND book.Author LIKE '%".$Author."%'
			AND book.Publisher LIKE '%".$Publisher."%'
			AND book.PubYear>= $start_year
			AND book.PubYear<= $end_year
			";
	 	}
	 	else
	 	{
	 		$query1=
	 		"SELECT BookID,Catagory,BookName,Publisher,PubYear,Author,Price,Total_volume,Stock FROM book 
	 		WHERE Catagory = '".$searchtype."' 
			AND book.BookName LIKE '%".$BookName."%' 
			AND book.Author LIKE '%".$Author."%'
			AND book.Publisher LIKE '%".$Publisher."%';
			AND book.PubYear>= $start_year
			";
	 	}
	 }

	 else
	 {
	 	if($end_year)
	 	$query1=
	 	"SELECT BookID,Catagory,BookName,Publisher,PubYear,Author,Price,Total_volume,Stock FROM book
	 	WHERE book.Catagory = '".$searchtype."'
		AND book.BookName LIKE '%".$BookName."%' 
		AND book.Author LIKE '%".$Author."%'
		AND book.Publisher LIKE '%".$Publisher."%'
		AND book.PubYear<=$end_year
		";

		else
		$query1=
	 	"SELECT BookID,Catagory,BookName,Publisher,PubYear,Author,Price,Total_volume,Stock FROM book 
	 	WHERE book.Catagory ='".$searchtype."'
		AND book.BookName LIKE '%".$BookName."%' 
		AND book.Author LIKE '%".$Author."%'
		AND book.Publisher LIKE '%".$Publisher."%'
		";
	 }


	if($start_Price)
	{
		if($end_Price)
		{
			$query = "SELECT BookID,Catagory,BookName,Publisher,PubYear,Author,Price,Total_volume,Stock FROM ($query1) AS book1
					WHERE Price>=$start_Price
					AND Price<=$end_Price
					 ;
					";
		}
		else
			$query = "SELECT BookID,Catagory,BookName,Publisher,PubYear,Author,Price,Total_volume,Stock FROM ($query1) AS book1
					WHERE Price>=$start_Price;";
	}

	else
	{
		if($end_Price)
			$query = 
		"SELECT BookID,Catagory,BookName,Publisher,PubYear,Author,Price,Total_volume,Stock FROM ($query1) AS book1
		WHERE Price<=$end_Price;
		";
		else
			$query = 
		"SELECT BookID,Catagory,BookName,Publisher,PubYear,Author,Price,Total_volume,Stock FROM ($query1) AS book1
		WHERE 1;
		";
	}
		
		

	$result = mysql_query($query) or die(mysql_error());
	$num_results =mysql_num_rows($result);
	
	echo $query;
	echo $result;
	echo"<p>Number of book found: ".$num_results."</p>";


	for ($i = 0; $i <$num_results;$i++)
	{
		$row = mysql_fetch_array($result);
		echo "<p><strong>".($i+1).".BookName: ";
		echo htmlspecialchars(stripslashes($row["BookName"]));
		echo "<br>Catagory: ";
		echo htmlspecialchars(stripcslashes($row["Catagory"]));
		echo "</strong><br>Author: ";
		echo htmlspecialchars( stripslashes($row["Author"]));
		echo "<br>BookID: ";
		echo htmlspecialchars(stripcslashes($row["BookID"]));
		echo "<br>Publisher: ";
		echo htmlspecialchars(stripcslashes($row["Publisher"]));
		echo "<br>Price: ";
		echo htmlspecialchars(stripcslashes($row["Price"]));
		echo "<br>Published year: ";
		echo htmlspecialchars(stripcslashes($row["PubYear"]));
		echo "<br>Number of book available: ";
		echo htmlspecialchars(stripcslashes($row["Stock"]));
		echo "<br>Number of This Book: ";
		echo htmlspecialchars(stripcslashes($row["Total_volume"]));
		echo "</p>";

	}


	?>
    
    <a href="/library_management_system/search.php">Back</a>

</body>
</html>
