<?php
if (!isset($_SESSION['USER_NAME'])) {
    header("Location: login.php");
}


?>
<?php
echo '
<nav class="navbar navbar-expand-lg navbar-dark" id="navbar">
  <div class="container-fluid">
    <img src="logo.png" alt="Trust bank logo" class="logo">
    <a class="navbar-brand" href="#">Trust Note</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <select id="category" class="nav-link active" style="background-color:black;" >
          <option value="">Category</option>';
          ?>
          <?php
          include "./db.php";
          $user = $_SESSION["USER_NAME"];
          $sql1 = "SELECT * FROM `users` where email = '$user'";
          $query = mysqli_query($con, $sql1);
          $row = mysqli_fetch_array($query);
          $id = $row['id'];
          $sql = "SELECT DISTINCT category FROM `notes` where user_id = '$id'";
          $res = mysqli_query($con, $sql);

          while ($fetch = mysqli_fetch_assoc($res)) {
              echo '<option value="' . $fetch["category"] . '">' . $fetch["category"] . '</option>';
          }
          ?>
          <?php
          echo '
          </select>
        </li>
        <li class="nav-item">
        <select id="colorDropdown" class="nav-link active" style="background-color:black;">
          <option value="">Sort by Color</option>';
          include "./db.php";
          $user = $_SESSION["USER_NAME"];
          $sql1 = "SELECT * FROM `users` where email = '$user'";
          $query = mysqli_query($con, $sql1);
          $row = mysqli_fetch_array($query);
          $id = $row['id'];
          $sql = "SELECT DISTINCT bgcolor,bgcolorName FROM `notes` where user_id = '$id'";
          $res = mysqli_query($con, $sql);

          while ($fetch = mysqli_fetch_assoc($res)) {
              echo '<option value="' . $fetch["bgcolor"] . '"style="background-color:' . $fetch["bgcolor"] . ';">' . $fetch["bgcolorName"] . '</option>';
          }
          ?>
          <?php
          echo '
         </select>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Log Out</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
';


?>
