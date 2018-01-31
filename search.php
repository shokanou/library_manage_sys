<html>
<head>
	<title>Book Management System</title>
</head>

<body>
	<h1><font face="微软雅黑"><strong><center>Book Management System</center></strong></font> </h1>

	<form action="book_mana.php" method="post">
	
    Category:<br>
		<input name="searchtype" type=text>
        <br>

  
		Title:<br>
		<input name="title" type=text>
        <br>
        
        <br>
		Author:<br>
		<input name="author" type=text>
        <br>
	
        <br>
		Year Range:<br>
        <input name="start_year" type=text> to <input name= "end_year" type=text>
		<br>
        <br>
		Price Range:
        <br>
        <input name="start_price" type=text> to <input name="end_price" type=text>
		<br>
        <br>
        Publisher:
        <br>
        <input name="publisher" type=text>
		<br>	
        <br>
		<input type=submit value="Search" name="button">	
        <br>
        <br>
        <input type="reset" value="Reset" name="button"/> 
	</form>
    <a href="http://weibo.com/">Back</a>

</body>
</html>