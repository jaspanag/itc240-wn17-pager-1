<?php
//chemistry_view.php - shows details of a single customer
?>
<?php include 'includes/config.php';?>
<?php

//process querystring here
if(isset($_GET['id']))
{//process data
    //cast the data to an integer, for security purposes
    $id = (int)$_GET['id'];
}else{//redirect to safe page
    header('Location:chemistry_list.php');
}


$sql = "select * from Chemistry where ChemistryID = $id";
//we connect to the db here
//we connect to the db here
$iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

//we extract the data here
$result = mysqli_query($iConn,$sql);

if(mysqli_num_rows($result) > 0)
{//show records

    while($row = mysqli_fetch_assoc($result))
    {
        $Element_name = stripslashes($row['Element_name']);
        $Element_symbol = stripslashes($row['Element_symbol']);
        $Atomic_number = stripslashes($row['Atomic_number']);
        $Element_uses = stripslashes($row['Element_uses']);
        $title = "Title Page for " . $Element_name;
        $pageID = $Element_name;
        $Feedback = '';//no feedback necessary
    }

}else{//inform there are no records
    $Feedback = '<p>This element does not exist</p>';
}

?>
<?php include 'includes/cleanheader.php';?>
<h1><?=$pageID?></h1>
<?php


if($Feedback == '')
{//data exists, show it

    echo '<p>';
    echo 'Element_name: <b>' . $Element_name . '</b><br> ';
    echo 'Element_symbol: <b>' . $Element_symbol . '</b><br> ';
    echo 'Atomic_number: <b>' . $Atomic_number . '</b><br> ';
    echo 'Element_uses: <b>' . $Element_uses . '</b><br> ';

    echo '</p>';
    echo '<img src="images/element' . $id . '.jpg" />';
}else{//warn user no data
    echo $Feedback;
}

echo '<p><a href="chemistry_list.php">Go Back</a></p>';

//release web server resources
@mysqli_free_result($result);

//close connection to mysql
@mysqli_close($iConn);

?>
<?php include 'includes/cleanfooter.php';?>
