<?php

include('server/connection.php');

$id = $_GET['skill_id'];
$photo_old = $_GET['skill_photo'];



$path = "images/skills/" . basename($_FILES['skill_photo']['name']);

$skill_name = $_POST['skill_name'];
$skill_desc = $_POST['skill_desc'];
$skill_year = $_POST['skill_year'];
$skill_photo = $_FILES['skill_photo']['name'];

$query = "UPDATE skills SET 
skill_name = '$skill_name',
skill_desc = '$skill_desc',
skill_year = '$skill_year',
skill_photo = '$skill_photo'
WHERE skill_id = '$id'
";

$result = mysqli_query($conn, $query);

if (move_uploaded_file($_FILES['skill_photo']['tmp_name'], $path)) {
  if ($result) {
    $path_old = "images/skills/" . $photo_old;
    if (file_exists($path_old)) {
      unlink($path_old);
    }
    $success = true;
    header("location:index.php?success=$success&message=Skill Updated!");
  } else {
    $success = false;
    header("location:index.php?success=$success&error=Failed to Updated");
  }
}
