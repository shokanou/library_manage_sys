<html>
<head>
<title>Upload Test Files</title>
</head>

<body>
<h1><center>Upload Test Files</center></h1>

<?php
if ($_FILES["file"]["size"] < 20000)
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"]. "<br />";
      }
    }
  }
else
  {
  echo "Invalid file". "<br />";
  }
  
  $file_name="upload/{$_FILES["file"]["name"]}";
  echo($file_name);
  
	$myfile = fopen($file_name,"r") or die("Unable to open file!");
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	
	//echo fread($myfile,filesize("$file_name"));
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	
	@ $db = mysql_pconnect("localhost","root");
	
	if(!$db)
	{
		echo"Error: could not connect to database.Please try again later.";
		exit;
	}

	mysql_select_db("library_management_system");
	
	while(!feof($myfile)) 
	{
			$data=array();
			$data1=array();
			$data1 =fgets($myfile);
			//trim(" ",$data1);
			$data = explode(",",$data1);
			//echo $data[0];
			//echo"<br>";
			//echo $data[1];
			//echo"<br>";
			//echo $data[2];
			//echo"<br>";
			//echo $data[3];
			//
			//echo $data[6];

		
		$first_result=
		mysql_query("SELECT Total_volume,Stock
					FROM book
					WHERE BookID='".$data[0]."';
		");
		//echo $first_result;
		$data1=mysql_fetch_array($first_result);
		//echo $data1[1];
		echo"<br>";
		if(!mysql_fetch_array($first_result))
		{
			$query= "INSERT INTO book VALUES
			('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."',1,1);";
			//echo"$query";
			$result = mysql_query($query);
				if(!$result)
				{
					echo"Adding books failed!";
					break;
				}
		}

		else
		{
			$num_results = mysql_num_rows($first_result);
			for($i=0;$i<$num_results;$i++)
			{
				$result1=mysql_query("DELETE FROM book WHERE BookID='".$data[0]."';");
				$full_quan1=$data1[0]+1;
				echo $full_quan1;
				echo"<br>";
				$quantity1=$data1[1]+1;
				echo $quantity1;
				echo"<br>";
				$query= "INSERT INTO book values
				('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$full_quan1."','".$quantity1."');";
				echo $query;
				$result = mysql_query($query);			
				if(!$result)
				{
					echo"Adding books failed!";
					break;
				}
			}
		}
		
	echo"<br>";
	echo"<br>";	
	}
	
	fclose($myfile);
  
?>

<a href="/library_management_system/some_book_add.php"><center>Back</center></a>
</body>
</html>