<?php
// Include necessary files (e.g., database connection)
include "./db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noteId = $_POST['noteId'];
    $isPinned = $_POST['isPinned'];

    // Update the `pinned` status in the database
    $sql = "UPDATE `notes` SET `pinned` = " . ($isPinned ? 0 : 1) . " WHERE `sno` = $noteId";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
