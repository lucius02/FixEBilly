<?php
require_once(".\search\dbcontroller.php");
$db_handle = new DBController();

$onderwerp = "";
$wat = "";	
$why = "";
$how = "";

$queryCondition = "";
if(!empty($_POST["search"])) {
    foreach($_POST["search"] as $k=>$v){
        if(!empty($v)) {

            $queryCases = array("onderwerp","wat", "why", "how", "niveau");
            if(in_array($k,$queryCases)) {
                if(!empty($queryCondition)) {
                    $queryCondition .= " AND ";
                } else {
                    $queryCondition .= " WHERE ";
                }
            }
            switch($k) {
                case "onderwerp":
                    $onderwerp = $v;
                    $queryCondition .= "onderwerp LIKE '" . $v . "%'";
                    break;
                case "wat":
                    $wat = $v;
                    $queryCondition .= "wat LIKE '" . $v . "%'";
                    break;
                case "why":
                    $why = $v;
                    $queryCondition .= "why LIKE '" . $v . "%'";
                    break;
                case "how":
                    $how = $v;
                    $queryCondition .= "how LIKE '" . $v . "%'";
					break;
				case "niveau":
					$niveau = $v;
					$queryCondition .= "niveau LIKE '" . $v . "%'";
            }
        }
    }
}

    $orderby = " ORDER BY kenniskaart_id desc"; 
	$sql = "SELECT * FROM sch_map.kenniskaart " . $queryCondition;
   
    $query =  $sql . $orderby ; 
	$result = $db_handle->runQuery($query);

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

					<select id="Place" name="search[niveau]" multiple="multiple">
                        <?php
                        if (! empty($result)) {
                            foreach ($result as $k => $v) {
                                echo '<option value="' . $result[$k]['niveau'] . '">' . $result[$k]['niveau'] . '</option>';
                            }
                        }
                        ?>
                	</select><br> <br>

					<input type="submit" name="go" class="btnSearch" value="Search">
					<input type="reset" class="btnSearch" value="Reset" onclick="window.location='filterfunction.php'">

				<?php
                	if (! empty($_POST['niveau'])) {
            	?>					

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
                        $query = "SELECT * from sch_map.kenniskaart";
                        $i = 0;
                        $selectedOptionCount = count($_POST['niveau']);
                        $selectedOption = "";
                        while ($i < $selectedOptionCount) {
                            $selectedOption = $selectedOption . "'" . $_POST['niveau'][$i] . "'";
                            if ($i < $selectedOptionCount - 1) {
                                $selectedOption = $selectedOption . ", ";
                            }
                            
                            $i ++;
                        }
                        $query = $query . " WHERE niveau in (" . $selectedOption . ")";
                        
                        $result = $db_handle->runQuery($query);
                    }
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
					?>
				<tbody>
			</table>
			<?php
                }
            ?> 
			</form>	
		</div>
	</body>
</html>