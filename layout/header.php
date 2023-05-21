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
  <title>porto</title>
</head>

<body class="bg-darkness">
  <header>
    <nav class="navbar w-100 bg-darkness align-center position-fixed scale-100">
      <div class="container-fluid w-75">
        <a href="index.php" class="navbar-brand text-light">
          <img src="images/samples/nn.jpg" alt="" width="40px" height="40%">
          <span class="text-sm-end ">
            my<span class="fw-bold">porto</span>
          </span>
        </a>
        <a class="nav-item text-light" href="" data-bs-toggle="modal" data-bs-target="#modalLogout"><i class="fa-solid fa-power-off"></i></a>
      </div>
    </nav>
  </header>
  <!-- Modal Logout Start -->
  <div class="modal fade mt-5 pt-5" id="modalLogout" tabindex="-1" aria-labelledby="modalLabelLogout" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-blackness">
        <div class="modal-body text-light text-center">
          <div class="text-light text-end">
            <a class="btn btn-close text-light" type="button" data-bs-dismiss="modal" aria-label="Close"></a>
          </div>
          <div class="d-flex justify-content-center my-3">
            <h1 class="exclamation"><i class="fa-solid fa-question"></i></h1>
          </div>
          <div class="my-4">
            <h4>Are you sure want to Logout</h4>
          </div>
          <div class="my-2">
            <a class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
            <a class="btn btn-danger" href="index.php?logout=1">Logout</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Logout End -->