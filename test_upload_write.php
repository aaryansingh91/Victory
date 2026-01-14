<?php
$file = 'uploads/telegram_support_image/test_write.txt';
if (file_put_contents($file, "test write\n")) {
    echo "Successfully wrote to $file\n";
    unlink($file);
} else {
    echo "FAILED to write to $file\n";
}
