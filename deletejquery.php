<?php
session_start();
include "db.php"; // Include your database connection file

if (isset($_POST['noteId'])) {
    $noteId = $_POST['noteId'];

    // Perform the deletion query
    $sql = "DELETE FROM `notes` WHERE `sno` = '$noteId'";
    $result = mysqli_query($con, $sql);
}

?>