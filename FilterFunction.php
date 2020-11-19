<?php
include("ini/classes.php");
//require_once(".\search\dbcontroller.php");
//$db_handle = new DBController();


$onderwerp = "";
$wat = "";	
$why = "";
$how = "";
$niveau = "";

if(isset($_POST['Search']) 
	//er moet wel ergens op gezocht worden....
	and !(empty($_POST["onderwerp"]) and empty($_POST["wat"]) and empty($_POST["why"]) and empty($_POST["how"]) and empty($_POST['niveau']))) {

	$onderwerp = $_POST["onderwerp"];
	$wat = $_POST["wat"];	
	$why = $_POST["why"];
	$how = $_POST["how"];
	if (! empty($_POST['niveau'])) {
						$selectedOption="";
                        foreach ($_POST['niveau'] as $niveau) {
                            $selectedOption = $selectedOption . $niveau ;
								if ( next( $_POST['niveau'] ) ) {
                                $selectedOption = $selectedOption . "|";
								}
                        }
						$niveau =$selectedOption;
		} else {$niveau = "";}

	$query = "SELECT * FROM sch_map.kenniskaart 
			WHERE	onderwerp ~* '".$onderwerp."'
				AND	wat ~* '".$wat."'
				AND	why ~* '".$why."'
				AND	how ~* '".$how."'
				AND	niveau ~* '".$niveau."'
			ORDER BY kenniskaart_id desc";

//echo $query;
//	$result = $db_handle->runQuery($query);
	$result=Connection::get()->connect()->query($query)->fetchAll(PDO::FETCH_ASSOC);

}

// ter voorbereiding van de opbouw van de combobox..
 	$comboquery = "SELECT lower(niveau) niveau FROM sch_map.kenniskaart group by niveau order by 1";
	$comboresult=Connection::get()->connect()->query($comboquery)->fetchAll(PDO::FETCH_ASSOC);
	                      if (! empty($comboresult)) {
                            foreach ($comboresult as $k => $v) {
                                echo '<option value="' . $comboresult[$k]['niveau'] . '">' . $comboresult[$k]['niveau'] . '</option>';
                            }
					  }
					  
?>

<html>
	<head>
		<title>Zoeken</title>
		<link href="style.css" type="text/css" rel="stylesheet"/>
	</head>
	<body>
		<h2>PHP CRUD with Search and Pagination</h2>
		<div id="toys-grid">      
			<form name="frmSearch" method="post" action="filterfunction.php">
			<div class="search-box">
				<p>
					<input type="text" id="mysearch" placeholder="onderwerp" name="search[onderwerp]" class="demoInputBox" value="<?php echo $onderwerp; ?>"/>
					<input type="text" id="mysearch" placeholder="wat" name="search[wat]" class="demoInputBox" value="<?php echo $wat; ?>"/>
					<input type="text" id="mysearch" placeholder="why" name="search[why]" class="demoInputBox" value="<?php echo $why; ?>"/>
					<input type="text" id="mysearch" placeholder="how" name="search[how]" class="demoInputBox" value="<?php echo $how; ?>"/>
					<select id="Place" name="search[niveau]" multiple="multiple" SIZE="5">
                        
						<?php
							//echo display_sql_table($query,400);
						?>			
			</select><br> <br>

			<input type="submit" name="Search" id="Search" value="Search">
			<input type="reset" class="btnSearch" value="Reset" onclick="window.location='filterfunction.php'">

			<table cellpadding="10" cellspacing="1">
				<thead>
					<tr>
						<th><strong>Onderwerp</strong></th>
						<th><strong>Rol</strong></th>          
						<th><strong>Competentie</strong></th>
						<th><strong>Wat</strong></th>
						<th><strong>Why</strong></th>
						<th><strong>How</strong></th>
						<th><strong>Plaatje</strong></th>
						<th><strong>Bronnen</strong></th>
						<th><strong>Niveau</strong></th>
						<th><strong>Studieduur</strong></th>
						<th><strong>Rating</strong></th>
					</tr>
				</thead>
					<tbody>
						<?php
						if (! empty($result)) {
						foreach ($result as $k => $v) {
								if(is_numeric($k)) {
						?>
						<tr>
							<td><?php echo $result[$k]["onderwerp"]; ?></td>
							<td><?php echo $result[$k]["rol"]; ?></td>
							<td><?php echo $result[$k]["competentie"]; ?></td>
							<td><?php echo $result[$k]["wat"]; ?></td>
							<td><?php echo $result[$k]["why"]; ?></td>
							<td><?php echo $result[$k]["how"]; ?></td>
							<td><img src='<?php echo $result[$k]["plaatje"]; ?>' ></td> 
							<td><?php echo $result[$k]["bronnen"]; ?></td>
							<td><?php echo $result[$k]["niveau"]; ?></td>
							<td><?php echo $result[$k]["studieduur"]; ?></td>
							<td><?php echo $result[$k]["rating"]; ?></td>
						</tr>
						<?php	
							}				   
						}
						}	
						?>
					<tbody>
				</table>
			</form>	
		</div>
	</body>
</html>