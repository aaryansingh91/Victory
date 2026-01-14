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

$qry = mysqli_query($con, "SELECT * FROM `lottery` WHERE lottery_status = '1' ORDER BY `lottery_id` ASC");
while ($lottery_data = mysqli_fetch_assoc($qry)) { 
     
        $lottery_id = $lottery_data['lottery_id'];

        $current_time = time();
        $formatted_time = date('Y-m-d H:i:s', $current_time);
        if ($lottery_data['total_joined'] == 0 && $formatted_time > strtotime($lottery_data['lottery_time'])) {
          
            mysqli_query($con, "UPDATE `lottery` SET `lottery_status` = '2' WHERE lottery_id = '$lottery_id'"); 
        }         
    }
?>