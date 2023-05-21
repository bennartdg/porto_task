<?php

include('server/connection.php');

$id = $_GET['skill_id'];
$photo = $_GET['skill_photo'];

$query = "DELETE FROM skills WHERE skill_id = '$id'";

$result = mysqli_query($conn, $query);

$path = "images/skills/" . $photo;

if (file_exists($path)) {
  unlink($path);
}

if ($result) {
  $success = true;
  header("location:index.php?success=$success&message=Skill Deleted!");
} else {
  $success = false;
  header("location:index.php?success=$success&error=Failed to Delete!");
}
