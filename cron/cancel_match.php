<?php

include('../database.php');



$con=mysqli_connect($hostname,$username,$password,$database);

mysqli_query ($con,"set character_set_results='utf8'");

mysqli_set_charset($con,'utf8');



// Check connection

if (mysqli_connect_errno()){

  die("Failed to connect to mysqli: " . mysqli_connect_error());

}


date_default_timezone_set('Asia/Kolkata');

$qry = mysqli_query($con, "SELECT * FROM `matches` WHERE match_status = '1' ORDER BY `m_id` ASC");

    while ($match_data = mysqli_fetch_assoc($qry)) { 
        $m_id = $match_data['m_id'];

    $checkQuery = mysqli_query($con, "SELECT COUNT(*) as count FROM `match_join_member` WHERE match_id = '$m_id'");
    $row = mysqli_fetch_assoc($checkQuery);
    $count = $row['count'];
    $current_time = time();
    $formatted_time = date('Y-m-d H:i:s', $current_time);
    if ($count <= 0 && $formatted_time > strtotime($match_data['match_time'])) {
            mysqli_query($con, "UPDATE `matches` SET `match_status` = '4' WHERE m_id = '$m_id'");
    }           
    }
?>