<?php
include "./db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['sortedNotes'])) {
        $sortedNotes = $_POST['sortedNotes'];

        // Loop through sorted notes and update positions in the database
        foreach ($sortedNotes as $position => $noteId) {
            $noteId = substr($noteId, 2); // Remove the "p_" prefix
            $position = $position + 1; // Adjust position (1-based index)

            $sql = "UPDATE notes SET position = $position WHERE sno = $noteId";
            mysqli_query($con, $sql);
        }

        echo "Positions updated successfully";
    }
}
?>
