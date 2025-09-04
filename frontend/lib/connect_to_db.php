<?php
// Database connection (using demo credentials for SonarQube test)
$mysqli = new mysqli(
    "mysql",              // Host
    "demo_user",          // Username
    "DEMO_SECRET_PASS_123", // Password (fake secret for demo)
    "AIBOT"               // Database name
);

// Check connection
if ($mysqli->connect_error) {
    die("❌ Connection failed: " . $mysqli->connect_error);
}

echo "✅ Connected successfully to database (demo).";
