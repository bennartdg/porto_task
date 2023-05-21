<?php
include('server/connection.php');
session_start();

include('layout/header.php');

if (!isset($_SESSION['logged_in'])) {
  header('location: login.php');
  exit;
}

$user_id = $_SESSION['user_id'];
$user_email = $_SESSION['user_email'];
$user_name = $_SESSION['user_name'];
$user_age = $_SESSION['user_age'];
$user_desc = $_SESSION['user_desc'];
$user_photo = $_SESSION['user_photo'];

if (isset($_GET['logout'])) {
  if (isset($_SESSION['logged_in'])) {
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    header('location: login.php');
    exit;
  }
}

//Read Query Skills
$query = "SELECT * FROM skills WHERE user_id = $user_id ORDER BY skill_year DESC";

$result = mysqli_query($conn, $query);

?>

<?php

if (isset($_POST['submit_insert'])) {
  $path = "images/skills/" . basename($_FILES['skill_photo']['name']);

  $name = $_POST['skill_name'];
  $desc = $_POST['skill_desc'];
  $year = $_POST['skill_year'];
  $photo = $_FILES['skill_photo']['name'];

  $query = "INSERT INTO skills VALUES (null, '$user_id', '$name', '$desc', '$year', '$photo')";

  $result = mysqli_query($conn, $query);

  if (move_uploaded_file($_FILES['skill_photo']['tmp_name'], $path)) {
    if ($result) {
      $success = true;
      header("location:index.php?success=$success&message=Skill Added!");
    } else {
      $success = false;
      header("location:index.php?success=$success&error=Failed to Add");
    }
  }
}

?>

<main class="py-5">
  <!-- Profile Start -->
  <div class="container-fluid border-bottom">
    <div class="container-fluid w-75 text-light my-5 d-flex flex-row align-items-center">
      <div class="p-2 border-light border border-2 rounded-circle">
        <img class="rounded-circle object-fit-cover" src="images/profiles/<?php echo $user_photo ?>" alt="" width="150px" height="150px">
      </div>
      <div class="mx-4 my-0 h-4">
        <h3 class="my-0"><?php echo $user_name ?></h3>
        <p class="my-0 text-secondary"><?php echo $user_desc ?></p>
        <p class="fw-bold mt-1 mb-0"><?php echo $user_email ?></p>
        <p class="my-0"><?php echo $user_age ?> Years Old</p>
      </div>
    </div>
  </div>
  <!-- Profile End -->

  <!-- Skills Start -->
  <div class="container menu-list text-light">
    <div class="pt-5 d-flex align-items-center justify-content-between">
      <h2 class="">Skill Lists</h2>
      <a class="text-light" href="" data-bs-toggle="modal" data-bs-target="#modalInsert"><i class="fa-regular fa-plus fa-xl"></i></a>
    </div>

    <!-- Alert Start -->
    <?php if (isset($_GET["success"]) && $_GET["success"] == true) { ?>
      <div id="alert" class="alert alert-success alert-dismissible fade show mt-4" role="alert">
        <?php echo $_GET['message'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php } ?>
    <?php if (isset($_GET["success"]) && $_GET["success"] == false) { ?>
      <div id="alert" class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
        <?php echo $_GET['error'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php } ?>
    <!-- Alert End-->

    <div class="row">
      <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <div class="col-lg-4 col-md-6 col-sm-12 d-flex flex-column align-items-center justify-content-center">
          <a class="text-light text-decoration-none" href="#">
            <div class="bg-skill d-flex flex-column">
              <div class="skill">
                <img class="skill-img object-fit-cover" src="images/skills/<?php echo $row['skill_photo'] ?>" alt="">
                <div class="text-center">
                  <div class="pt-2 fw-bold text-start">
                    <h5 class="fw-bold">
                      <?php echo $row['skill_name'] ?>
                    </h5>
                  </div>
                  <div class="pb-4 text-start">
                    <?php echo $row['skill_desc'] ?>
                  </div>
                </div>
              </div>
              <!-- Dropdown Start -->
              <div class="skill-dropdown">
                <div>
                  <a class="btn btn-primary py-2 mx-2" href="#" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['skill_id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                </div>
                <div>
                  <a class="btn btn-danger py-2" href="#" data-bs-toggle="modal" data-bs-target="#modalDelete<?= $row['skill_id'] ?>"><i class="fa-solid fa-delete-left"></i></a>
                </div>
              </div>
              <!-- Dropdown End -->
            </div>
          </a>
        </div>
        <!-- Modal Delete Start -->
        <div class="modal fade mt-5 pt-5" id="modalDelete<?= $row['skill_id'] ?>" tabindex="-1" aria-labelledby="modalLabelDelete" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content bg-blackness">
              <div class="modal-body text-light text-center">
                <div class="text-light text-end">
                  <a class="btn btn-close text-light" type="button" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                <div class="d-flex justify-content-center my-3">
                  <h1 class="exclamation"><i class="fa-solid fa-exclamation"></i></h1>
                </div>
                <div class="my-4">
                  <h4>Are you sure want to Delete this Skill?</h4>
                  <h6 class="text-light-emphasis"><?php echo $row['skill_name'] ?></h6>
                </div>
                <div class="my-2">
                  <a class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                  <a class="btn btn-danger" href="actionDelete.php?skill_id=<?= $row['skill_id'] ?>&skill_photo=<?= $row['skill_photo'] ?>">Delete</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal Delete End -->

        <!-- Modal Edit Start -->
        <div class="modal fade mt-5 pt-5" id="modalEdit<?= $row['skill_id'] ?>" tabindex="-1" aria-labelledby="modalLabelEdit" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content bg-blackness">
              <div class="modal-body text-light">
                <div class="d-flex justify-content-between mb-4">
                  <h2 class="modal-title" id="modalLabelEdit">Edit Skill</h2>
                  <button type="button" class="btn btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="actionEdit.php?skill_id=<?= $row['skill_id'] ?>&skill_photo=<?= $row['skill_photo'] ?>" method="POST" enctype="multipart/form-data">
                  <div class=" mb-3">
                    <label for="skill_name" class="form-label">Name</label>
                    <input name="skill_name" type="text" class="text-field" placeholder="<?= $row['skill_name'] ?>" required />
                  </div>
                  <div class="mb-3">
                    <label for="skill_desc" class="form-label">Description</label>
                    <input name="skill_desc" type="text" class="text-field" placeholder="<?= $row['skill_desc'] ?>" required />
                  </div>
                  <div class="mb-3">
                    <label for="skill_year" class="form-label">Year</label>
                    <input name="skill_year" type="text" class="text-field" placeholder="<?= $row['skill_year'] ?>" required />
                  </div>
                  <div class="mb-3">
                    <label class="pb-4" for="skill_photo">Photo</label>
                    <input name="skill_photo" type="file" class="form-control bg-transparent text-light" required />
                  </div>
                  <div class="py-2 text-end">
                    <input type="submit" class="btn btn-light" name="submit_edit" value="Submit">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal Edit End -->
      <?php endwhile; ?>
    </div>
  </div>
  <!-- Skills End -->

  <!-- Modals Insert Start -->
  <div class="modal fade mt-5 pt-5" id="modalInsert" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-blackness">
        <div class="modal-body text-light">
          <div class="d-flex justify-content-between mb-4">
            <h2 class="modal-title" id="modalEditLabel">Add Skill</h2>
            <button type="button" class="btn btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="POST" enctype="multipart/form-data">
            <div class=" mb-3">
              <label for="skill_name" class="form-label">Name</label>
              <input name="skill_name" type="text" class="text-field" required />
            </div>
            <div class="mb-3">
              <label for="skill_desc" class="form-label">Description</label>
              <input name="skill_desc" type="text" class="text-field" required />
            </div>
            <div class="mb-3">
              <label for="skill_year" class="form-label">Year</label>
              <input name="skill_year" type="text" class="text-field" required />
            </div>
            <div class="mb-3">
              <label class="pb-4" for="skill_photo">Photo</label>
              <input name="skill_photo" type="file" class="form-control bg-transparent text-light" required />
            </div>
            <div class="py-2 text-end">
              <input type="submit" class="btn btn-light" name="submit_insert" value="Submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Insert End -->
</main>

<script src="js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>