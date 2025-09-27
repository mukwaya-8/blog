<?php
$connection = new mysqli("localhost", "root", "", "blog");

if ($connection->connect_error) {
    die("❌ Connection failed: " . $connection->connect_error);
}

?>
