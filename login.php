<?php
 include "./db.php";
session_start();
if(isset($_SESSION['USER_NAME'])){
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="CSS/loginStylee.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>

<body>
    
    <div class="main_container">
        <?php include "./lognav.php";?>
        <div class="container">
            <?php
            if(isset($_POST["login"])) {
              $dbemail =$_POST["email"];
              $dbpassword =$_POST["password"];
              $sql="SELECT * FROM users WHERE email= '$dbemail'";
              $result = mysqli_query($con, $sql);
              $num = mysqli_num_rows($result);
              if($num){
                $user = mysqli_fetch_array($result);
                if($user){
                    if(password_verify($dbpassword, $user["password"])){
                        $_SESSION['USER_ID']=$user['id'];
                        $_SESSION['USER_NAME']=$user['email'];
                        session_start();
                        header("Location: index.php");
                    }
                    
                    else{
                       echo"<div class='alert alert-danger'>Password does not match</div>";
                    }
                  }
              }
              else{
                echo "<div class='alert alert-danger'>Invalid user or password</div>";
              }
             
              
             
            }
            ?>
            <form action="login.php" method="post" class="Entryform" autocomplete="off">
                <div class="form-group">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                    <input type="text" class="form-control" id="staticEmail" name="email"
                        placeholder="Enter your Email">
                </div form-group>

                <div  class="form-group">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <input type="password" class="form-control" id="inputPassword" name="password"
                        placeholder="Enter your Password">
                </div>

                <div  class="form-group">
                <input type="submit" class="btn btn-primary" value="Login" name="login">
                </div>

                <a href="./register.php">Havent't registered yet? Register now</a>
            </form>
        </div>
    </div>
</body>

</html>