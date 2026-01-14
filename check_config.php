<?php
$con = mysqli_connect('localhost', 'root', 'YourNewPassword123!', 'vict');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
$res = mysqli_query($con, "SELECT web_config_value FROM web_config WHERE web_config_name = 'admin_photo'");
$row = mysqli_fetch_assoc($res);
echo "admin_photo: " . $row['web_config_value'] . "\n";
