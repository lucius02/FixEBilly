<?php
include ("ini/connect.php");

$con or die("could not connect");
$output ='';
print_r($_POST);

//collect
if (isset($_POST['search'])){
    $searchq = $_POST['search'];
    $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
	$query = pg_query("SELECT * FROM sch_map.kenniskaart WHERE onderwerp LIKE '%$search%' #OR SurName LIKE '%$searchq%'") or die("could not search");
    $count = pg_num_rows($query);
    if($count == 0){
        $output = 'There was no search results!';
    }else{
        while($row = pg_fetch_array($query)){
            $onderwerp = $row['onderwerp'];
            //$lname = $row['SurName'];
            //$id = $row['id'];

			$output .= '<div>'.$onderwerp.#''.$lname.
			'</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Search</title>
</head>
<body>
    <form method="post" action="searchresult.php">
        <input type="text" name="search" placeholder="Zoeken voor Onderwerpen">
		<input type="submit" value="Submit">
	</form>
</body>
</html>

<?php print("$output");?>