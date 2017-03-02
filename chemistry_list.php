<?php
//chemistry_list.php - shows a list of customer data
?>
<?php include 'includes/config.php';?>
<?php include 'includes/cleanheader.php';?>
<h1><?=$pageID?></h1>
<?php
$sql = "select * from Chemistry";
//we connect to the db here
$iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

//we extract the data here
$result = mysqli_query($iConn,$sql);

if(mysqli_num_rows($result) > 0)
{//show records

    while($row = mysqli_fetch_assoc($result))
    {
        echo '<p>';
        echo 'Element name: <b>' . $row['Element_name'] . '</b><br> ';
        echo 'Element symbol: <b>' . $row['Element_symbol'] . '</b><br> ';
        echo 'Atomic number: <b>' . $row['Atomic_number'] . '</b><br> ';
        echo 'Element uses: <b>' . $row['Element_uses'] . '</b><br> ';
        echo '<a href="chemistry_view.php?id=' . $row['ChemistryID'] . '">' . $row['Element_name'] . '</a>';

        echo '</p>';
    }

}else{//inform there are no records
    echo '<p>There are currently no elements</p>';
}

//release web server resources
@mysqli_free_result($result);

//close connection to mysql
@mysqli_close($iConn);

?>
<?php include 'includes/cleanfooter.php';?>
