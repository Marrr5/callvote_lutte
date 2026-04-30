#!/usr/bin/php
<?php
$candidat = $argv[1];
$telephone = $argv[2];

$conn = new mysqli('localhost', 'debian-sys-maint', 'NoHKV3P9XUAUZOqt', 'votes_lutte');

if ($conn->connect_error) {
    error_log("Connexion echouee: " . $conn->connect_error);
    exit(1);
}

$stmt = $conn->prepare("INSERT INTO votes (candidat, telephone) VALUES (?, ?)");
if (!$stmt) {
    error_log("Erreur preparation: " . $conn->error);
    exit(1);
}

$stmt->bind_param("ss", $candidat, $telephone);
$stmt->execute();
$stmt->close();
$conn->close();
?>