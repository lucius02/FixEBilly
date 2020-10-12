<?php
	require_once("perpage.php");	
	require_once("dbcontroller.php");
	$db_handle = new DBController();
	
	$onderwerp = "";
	$wat = "";	
	$why = "";
	$how = "";
	$niveau = "";

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
							break;
				}
			}
		}
	}

	$queryCondition = "";
	if(!empty($_POST["search"])) {
		$advance_search_submit = $_POST["advance_search_submit"];
		foreach($_POST["search"] as $k=>$v){
			if(!empty($v)) {

				$queryCases = array("onderwerp","wat","why","how");
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
						$wordsAry = explode(" ", $v);
						$wordsCount = count($wordsAry);
						for($i=0;$i<$wordsCount;$i++) {
							if(!empty($_POST["search"]["search_in"])) {
								$queryCondition .= $_POST["search"]["search_in"] . " LIKE '%" . $wordsAry[$i] . "%'";
							} else {
								$queryCondition .= "onderwerp LIKE '" . $wordsAry[$i] . "%'";
							}
							if($i!=$wordsCount-1) {
								$queryCondition .= " OR ";
							}
						}
						break;
					case "wat":
						$wat = $v;
						if(!empty($_POST["search"]["search_in"])) {
							$queryCondition .= $_POST["search"]["search_in"] . " LIKE '%" . $v . "%'";
						} else {
							$queryCondition .= "wat LIKE '%" . $v . "%'";
						}
						break;
					case "why":
						$why = $v;
						if(!empty($_POST["search"]["search_in"])) {
							$queryCondition .= $_POST["search"]["search_in"] . " NOT LIKE '%" . $v . "%'";
						} else {
							$queryCondition .= "why LIKE '%" . $v . "%'";
						}
						break;
					case "how":
						$starts_with = $v;
						if(!empty($_POST["search"]["search_in"])) {
							$queryCondition .= $_POST["search"]["search_in"] . " LIKE '" . $v . "%'";
						} else {
							$queryCondition .= "how LIKE '" . $v . "%'";
						}
						break;
					case "filter":
						$search_in = $_POST["search"]["search_in"];
						break;
				}
			}
		}
	}

	$orderby = " ORDER BY kenniskaart_id desc"; 
	$sql = "SELECT * FROM sch_map.kenniskaart " . $queryCondition;
	$href = 'index.php';					
		
	$perPage = 2; 
	$page = 1;
	if(isset($_POST['page'])){
		$page = $_POST['page'];
	}
	$start = ($page-1)*$perPage;
	if($start < 0) $start = 0;
		
	$query =  $sql . $orderby .  " limit " . $start . $perPage; 
	$result = $db_handle->runQuery($query);
	
	if(!empty($result)) {
		$result["perpage"] = perpage($sql, $perPage, $href);
	}
?>

<html>
	<head>
		<title>Zoeken</title>
		<link href="style.css" type="text/css" rel="stylesheet"/>
		<script>
		function showHideAdvanceSearch() {
			if(document.getElementById("advanced-search-box").style.display=="none") {
				document.getElementById("advanced-search-box").style.display = "block";
				document.getElementById("advance_search_submit").value= "1";
			} else {
				document.getElementById("advanced-search-box").style.display = "none";
				document.getElementById("with_the_exact_of").value= "";
				document.getElementById("without").value= "";
				document.getElementById("starts_with").value= "";
				document.getElementById("search_in").value= "";
				document.getElementById("advance_search_submit").value= "";
			}
		}
	</script>
	</head>
	<body>
		<h2>PHP CRUD with Search and Pagination</h2>
		<div id="toys-grid">      
			<form name="frmSearch" method="post" action="index.php">
			<div class="search-box">
				<p>
					<input type="text" id="mysearch" placeholder="onderwerp" name="search[onderwerp]" class="demoInputBox" value="<?php echo $onderwerp; ?>"/>
					<input type="text" id="mysearch" placeholder="wat" name="search[wat]" class="demoInputBox" value="<?php echo $wat; ?>"/>
					<input type="text" id="mysearch" placeholder="why" name="search[why]" class="demoInputBox" value="<?php echo $why; ?>"/>
					<input type="text" id="mysearch" placeholder="how" name="search[how]" class="demoInputBox" value="<?php echo $how; ?>"/>
					<div>
						<select name="search[search_in]" id="search_in" class="demoInputBox">
							<option value="">Select Column</option>
							<option value="niveau" <?php if($search_in=="niveau") { echo "selected"; } ?>>Title</option>
						</select>
					</div>
					<input type="submit" name="go" class="btnSearch" value="Search">
					<input type="reset" class="btnSearch" value="Reset" onclick="window.location='index.php'">
				</p>
				<div class="dropdown">
						<button onclick="myFunction()" name="filter[niveau]" placeholder="niveau" class="dropbtn">Niveau</button>
						<div id="myDropdown" class="dropdown-content">
							<a value="<?php echo $niveau?>">beginner</a>
							<a value="<?php echo $niveau?>">Gevorderde</a>
							<a value="<?php echo $niveau?>">Expert</a>
						</div>
					</div>

					<script>
						/* When the user clicks on the button,
						toggle between hiding and showing the dropdown content */
						function myFunction() {
						document.getElementById("myDropdown").classList.toggle("show");
						}

						function filterFunction() {
						var input, filter, ul, li, a, i;
						input = document.getElementById("mysearch");
						filter = input.value.toUpperCase();
						div = document.getElementById("myDropdown");
						a = div.getElementsByTagName("a");
						for (i = 0; i < a.length; i++) {
							txtValue = a[i].textContent || a[i].innerText;
							if (txtValue.toUpperCase().indexOf(filter) > -1) {
							a[i].style.display = "";
							} else {
							a[i].style.display = "none";
							}
						}
						}
					</script>
				</div>
			
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
					if(!empty($result)) {
						foreach($result as $k=>$v) {
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
					if(isset($result["perpage"])) {
					?>
					<tr>
					<td colspan="6" align=right> <?php echo $result["perpage"]; ?></td>
					</tr>
					<?php } ?>
				<tbody>
			</table>
			</form>	
		</div>
	</body>
</html>