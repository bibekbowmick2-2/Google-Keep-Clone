<?php include "./db.php";


if (isset($_POST['stud_delete_multiple_btn'])) {
    $all_id = $_POST['stud_delete_id'];
    $extract_id = implode(',', $all_id);
    // echo $extract_id;

    $query = "DELETE FROM notes WHERE sno IN($extract_id) ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {

        echo '<script> alert("Data Deleted");
         window.location.href = "index.php"; </script>';
    } else {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}
