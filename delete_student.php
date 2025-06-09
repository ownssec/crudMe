<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'connection.php';

$id  = $_GET['id'] ?? 0;
$conn->query("DELETE FROM students_table WHERE student_id=$id");
header('Location: index.php');
exit;
?>
