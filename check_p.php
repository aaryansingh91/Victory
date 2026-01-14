<?php
$con = mysqli_connect('localhost', 'root', '', 'vict');
$res = mysqli_query($con, "SELECT * FROM telegram_support");
while ($row = mysqli_fetch_assoc($res)) {
    print_r($row);
}
if (mysqli_num_rows($res) == 0) {
    echo "No records found.";
}
