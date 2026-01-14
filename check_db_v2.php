<?php
$con = mysqli_connect('localhost', 'root', 'YourNewPassword123!', 'vict');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
$res2 = mysqli_query($con, "DESCRIBE telegram_support");
while ($row = mysqli_fetch_assoc($res2)) {
    echo $row['Field'] . " - " . $row['Type'] . " - " . $row['Null'] . " - " . $row['Default'] . "\n";
}
