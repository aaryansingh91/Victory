<?php
$file = 'application/logs/test_log.txt';
if (file_put_contents($file, "test log entry\n")) {
    echo "Successfully wrote to $file\n";
    unlink($file);
} else {
    echo "FAILED to write to $file\n";
}
echo "CWD: " . getcwd() . "\n";
