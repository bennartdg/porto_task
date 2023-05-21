<?php
include('server/connection.php');
session_start();

if (isset($_SESSION['logged_in'])) {
  header('location: index.php');
  exit;
}

if (isset($_POST['login_btn'])) {
  $email = $_POST['user_email'];
  $password = $_POST['user_password'];

  $query = "SELECT * FROM users WHERE user_email = ? AND user_password = ? LIMIT 1";

  $stmt_login = $conn->prepare($query);
  $stmt_login->bind_param('ss', $email, $password);

  if ($stmt_login->execute()) {
    $stmt_login->bind_result($user_id, $user_email, $user_password, $user_name, $user_age, $user_desc, $user_photo);
    $stmt_login->store_result();

    if ($stmt_login->num_rows() == 1) {
      $stmt_login->fetch();
      $_SESSION['user_id'] = $user_id;
      $_SESSION['user_email'] = $user_email;
      $_SESSION['user_name'] = $user_name;
      $_SESSION['user_age'] = $user_age;
      $_SESSION['user_desc'] = $user_desc;
      $_SESSION['user_photo'] = $user_photo;
      $_SESSION['logged_in'] = true;

      header('location: index.php?message=Logged in successfully!');
    } else {
      header('location: login.php?success=0&error=Cannot Verify your Account!');
    }
  } else {
    header('location: login.php?error=Something went wrong!&success=0');
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="css/main.css" />
  <link rel="icon" href="images/samples/nn.jpg" />
  <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/61f8d3e11d.js" crossorigin="anonymous"></script>
  <title>Login</title>
</head>

<body class="bg-darkness">
  <div class="container-fluid vh-100 text-light d-flex flex-column justify-content-center align-items-center">
    <div class="d-flex flex-column" style="width: 350px;">
      <h1 class="text-center">Welcome</h1>
      <form class="text-center" method="POST" action="">
        <div>
          <input class="text-field my-3" name="user_email" type="text" placeholder="Email" require>
        </div>
        <div>
          <input class="text-field my-4" name="user_password" type="password" placeholder="Password" require>
        </div>
        <div class="">
          <input class="btn btn-light my-4 form-control" type="submit" name="login_btn" value="Login">
        </div>
      </form>
      <?php if (isset($_GET["success"]) && $_GET["success"] == false) { ?>
        <div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php echo $_GET['error'] ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php } ?>
    </div>
  </div>

  <script src="js/bootstrap.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>