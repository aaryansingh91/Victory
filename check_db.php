<?php
$con = mysqli_connect('localhost', 'root', 'YourNewPassword123!', 'vict');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
$res = mysqli_query($con, "SHOW TABLES LIKE 'telegram_support'");
if (mysqli_num_rows($res) > 0) {
    echo "Table 'telegram_support' exists.\n";
    $res2 = mysqli_query($con, "DESCRIBE telegram_support");
    while ($row = mysqli_fetch_assoc($res2)) {
        print_r($row);
    }
} else {
    echo "Table 'telegram_support' DOES NOT exist.\n";
}
