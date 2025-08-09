<?php
if (function_exists('mysqli_connect')) {
    echo "✅ MySQLi sudah aktif!";
} else {
    echo "❌ MySQLi belum aktif!";
}
?>