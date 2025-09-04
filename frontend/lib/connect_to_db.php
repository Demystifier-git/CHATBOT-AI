<?php
// Database connection
$mysqli = new mysqli(
    "mysql",          // Host
    "myuser",         // Username
    "myuserpassword", // Password
    "AIBOT"           // Database name
);

// Check connection
if ($mysqli->connect_error) {
    die("❌ Connection failed: " . $mysqli->connect_error);
}

echo "✅ Connected successfully to database.";
