

<div class="row">
    <h3>List of Student Volunteers</h3>
</div>
<div class="row">
    <table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Onderwerp</td>
        </tr>
    </thead>
    <tbody>
    <?php
        include ("ini/connect.php");

        $sql = "SELECT * FROM sch_map.kenniskaart WHERE onderwerp LIKE '%$search%' #OR LastName LIKE '%$searchq%' ORDER BY id DESC";
        $result = pg_query($con,$sql);
        $row = pg_fetch_array($result);
        
        foreach ($pdo->query($sql) as $row) {
            echo '<tr>';
            echo '<td>'. $row['onderwerp'] . '</td>';
            echo '<td width=250>';
            echo '<a class="btn" href="read.php?id='.$row['id'].'">Read</a>';
            echo ' ';
            echo '<a class="btn" href="update.php?id='.$row['id'].'">Update</a>';
            echo ' ';
            echo '<a class="btn" href="delete.php?id='.$row['id'].'">Delete</a>';
            echo '</td>';
            echo '</tr>';
        }
        $con::disconnect();
    ?>