<?php
$con = mysqli_connect('localhost', 'root', 'YourNewPassword123!', 'vict');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
$data = array(
    'image' => 'test.jpg',
    'name' => 'Test Name',
    'url' => 'https://t.me/test',
    'status' => '1',
    'date_created' => date('Y-m-d H:i:s')
);
$keys = implode(", ", array_keys($data));
$values = "'" . implode("', '", array_values($data)) . "'";
$sql = "INSERT INTO telegram_support ($keys) VALUES ($values)";
if (mysqli_query($con, $sql)) {
    echo "Insert successful!\n";
} else {
    echo "Insert failed: " . mysqli_error($con) . "\n";
}
