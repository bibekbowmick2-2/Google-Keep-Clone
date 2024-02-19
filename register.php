<?php
session_start();
if(isset($_SESSION["user"])){
   header("Location: index.php");}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="CSS/registerStyle.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php include "./db.php";?>
   
    
    <div class="main_container">
      <?php include "./lognav.php";?>
        <div class="container">
        <?php
           if(isset($_POST["submit"])){{
       
            $dbname=$_POST["fullname"];
            $dbemail=$_POST["email"];
            $dbpassword =$_POST["password"];
            $dbrepeatpassword =$_POST["Repeat_password"];
            
            $passwordHash = password_hash( $dbpassword, PASSWORD_DEFAULT );
            $error = array();
            if(empty($dbname) OR empty($dbemail) OR empty($dbpassword)OR empty($dbrepeatpassword)){
             array_push($error,"All fields are required");
            }
            if (!filter_var($dbemail,FILTER_VALIDATE_EMAIL)){
             array_push($error,"Email is not valid"); 
            }
            if (strlen($dbpassword)<8){
             array_push($error,"Password must be at least 8 characters long"); 
            }
            if ($dbpassword!==  $dbrepeatpassword ){
             array_push($error,"Password does not match"); 
            }
            $sql = "SELECT * FROM users WHERE email= '$dbemail'";
            $result = mysqli_query($con,$sql);
            $rowCount = mysqli_num_rows($result);
            if($rowCount>0){
                array_push($error,"Email already exists!"); 
            }
            if(count($error)>0){
                foreach($error as $error){
                    echo "<div class= 'alert alert-danger'>$error</div>";
                }
            }
            else{
            $sql="INSERT INTO users ( FullName, email, password) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($con);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if($prepareStmt){
            mysqli_stmt_bind_param($stmt,"sss",$dbname,$dbemail,$passwordHash);
            mysqli_stmt_execute($stmt);
            echo"<div class='alert alert-succes'>You are registered successfully</div>";
            }
            else{
                die("Something went wrong");
            }
           
            }
        }
      }
      ?>
        <form action="register.php" method="post" class="Entryform" autocomplete="off">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="FullName">
            </div>
            <div class="form-group">
                <input type="email"  class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password"  class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password"  class="form-control" name="Repeat_password" placeholder="Repeat Password">
            </div>
            <div class="form-group">
                <input type="submit"  class="btn btn-primary" name="submit" value="Register">
            </div>
            <div class="form-group">
            <a href="./login.php">Login now?</a>
            </div>

        </div>
    </div>

</body>

</html>