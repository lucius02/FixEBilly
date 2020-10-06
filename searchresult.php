<html>

<head>
<title>Search</title>
</head>

<?php
	// include ('includes/header.html');
?>	

<div align="center">

<body>

<p>&nbsp</p>


<?php
//connecting to the database
include("ini/connect.php");
?> 

<?php

//$sql = "select * from jfs where author ilike '%$search_author%' order by issue";

//$sql = "select* from jfs where author like '%searchstring%' order by issue";

$sql = "select * from sch_map.kenniskaart where onderwerp like '%$search%'" ; 

            $result_set = pg_Exec ($con, $sql);
            $rows = pg_NumRows($result_set);

            if ((!$result_set) || ($rows < 1)) {
                  echo "<H1>ERROR - no rows returned</H1><P>";
                  exit;  //exit the script
                  }

            for ($j=0; $j < $rows; $j++)
               {
               $onderwerp = pg_result($result_set, $j, "onderwerp");
               $rol = pg_result($result_set, $j, "rol");
               $competentie = pg_result($result_set, $j, "competentie");
               $wat = pg_result($result_set, $j, "wat");
               $why = pg_result($result_set, $j, "why");
               $how = pg_result($result_set, $j, "how");
               $plaatje = pg_result($result_set, $j, "plaatje");
               $bronnen = pg_result($result_set, $j, "bronnen");
               $niveau = pg_result($result_set, $j, "niveau");
               $studieduur = pg_result($result_set, $j, "studieduur");
               $rating = pg_result($result_set, $j, "rating");


		?> 
		<table table border="3" width=60%>
		<tr><th>Issue</th><th>Page</th><th>Author</th><th>Title</th><th>Format</th><th>URL</th></tr>
              <TR>
              <TD width=10%> 
			<?php echo "$onderwerp"; ?>
              </TD>
              <TD width=10%>
			<?php echo "$rol"; ?>
              </TD>
              <TD width=15%>
			<?php echo "$competentie"; ?>
              </TD>
              <TD>
			<?php echo "$wat"; ?>
              </TD>
              <TD width=10%>
			<?php echo "$why"; ?>
              </TD>
		      <TD width=30%>
              <?php echo "$how"; ?>
              </TD>
              <TD width=10%>
			<?php echo "$plaatje"; ?>
              </TD>
              <TD width=10%>
			<?php echo "$bronnen"; ?>
              </TD>
              <TD width=10%>
			<?php echo "$niveau"; ?>
              </TD>
              <TD width=10%>
			<?php echo "$studieduur"; ?>
              </TD>
              <TD width=10%>
			<?php echo "$rating"; ?>
              </TD>
              </TR>
		  
		  </table>

<?php		

               }
?>


<?php
               pg_FreeResult($result_set);
               pg_Close($con);
?> 
</TABLE>	

</body>

</div>


<?php
//include ('includes\footer.html');
?>	

</html>