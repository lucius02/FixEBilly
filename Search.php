<html>
<head>
	<title>Search</title>
</head>

<div align="center">

<?php
	// include ('includes/header.html')
?>

<body>
<p>&nbsp </p>
<p>Enter a onderwerp to begin searching</p>
<p>&nbsp </p>

<form name="form" action="searchresult.php" method="post">
<input type="text" name="$_POST['onderwerp']" />
<input type="submit" name="Submit" value="Search" />
</form>

<p></p>
<p>&nbsp </p>
</body>

	<?php
	//include ('includes/footer.html')
?>

</div>

</html>