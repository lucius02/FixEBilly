<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat pgsql function
    $query = "SELECT onderwerp, rol, competentie, wat, why, how, plaatje, bronnen, niveau, studieduur, rating FROM sch_map.kenniskaart WHERE CONCAT(onderwerp, rol, competentie, wat, why, how, plaatje, bronnen, niveau, studieduur) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM sch_map.kenniskaart";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = pg_connect("host=localhost dbname=EBilly user=postgres password=WelKom7993");
    $filter_Result = pg_query($connect, $query);
    return $filter_Result;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>PHP HTML TABLE DATA SEARCH</title>
        <style>
            table,tr,th,td
            {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        
        <form action="test.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
            <input type="submit" name="search" value="Filter"><br><br>
            
            <table>
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

      <!-- populate table from mysql database -->
                <?php while($row = pg_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row["onderwerp"]; ?></td>
					<td><?php echo $row["rol"]; ?></td>
					<td><?php echo $row["competentie"]; ?></td>
					<td><?php echo $row["wat"]; ?></td>
					<td><?php echo $row["why"]; ?></td>
					<td><?php echo $row["how"]; ?></td>
                    <td><img src='<?php echo $row["plaatje"]; ?>' ></td> 
                    <td><?php echo $row["bronnen"]; ?></td>
					<td><?php echo $row["niveau"]; ?></td>
					<td><?php echo $row["studieduur"]; ?></td>
					<td><?php echo $row["rating"]; ?></td>
                </tr>
                <?php endwhile;?>
            </table>
        </form>
        
    </body>
</html>