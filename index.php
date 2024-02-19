<?php
session_start();
if(!isset($_SESSION['USER_NAME'])){
   header("Location: login.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/indexStylee.css">
    <link rel="stylesheet" href="jqueryui/jquery-ui.css">
    <link rel="stylesheet" href="jqueryui/jquery-ui.structure.css">
    <link rel="stylesheet" href="jqueryui/jquery-ui.theme.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>Trust Note</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <!-- Awesome Font  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
        integrity="sha512-PgQMlq+nqFLV4ylk1gwUOgm6CtIIXkKwaIHp/PAIWHzig/lKZSEGKEysh0TCVbHJXCLN7WetD8TFecIky75ZfQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>
</head>

<body>
    <?php include "./navbar.php";?>
    <?php include "./db.php";?>
    <?php include "./editModal.php";?>

    <?php
      $user = $_SESSION["USER_NAME"];
      $sql1 = "SELECT * FROM `users` where email = '$user'";
      $query = mysqli_query($con,$sql1);
      $row = mysqli_fetch_array( $query);
      $id = $row['id'];
      
      if(isset($_REQUEST["submit"])){
        if(!isset($_REQUEST["hidden"])){
            $title=$_REQUEST["title"];
            $description =$_REQUEST["desc"];
            $db_color =$_REQUEST['myInput'];
            $db_color_name =$_REQUEST['myColorName'];
            $category = $_REQUEST["category"];
            $sql="INSERT INTO `notes`( `title`, `description` , `bgcolor`,`category`,`bgcolorName`, `user_id`) VALUES ('$title','$description','$db_color','$category','$db_color_name','$id')";
            $res=mysqli_query($con,$sql);
        }
      }
    ?>
    <div class="main_container">
        <div class="container ">
            <div class="row justify-content-center" id="addition">
                <div class="col-lg-10">
                    <!-- Button trigger modal -->
                    <button type="button" class="addnote" data-bs-toggle="modal" data-bs-target="#AddModal">
                        Take a note
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#81d643d3;">
                                    <h5 class="modal-title" id="exampleModalLabel">Add note</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form class="form" method="POST" autocomplete="off">
                                        <input type="text" class="form-control" style="border:none;" id="title"
                                            placeholder="Enter Title..." name="title">
                                        <textarea class="form-control" id="desc" style="border:none;" rows="3"
                                            placeholder="Enter Description..." name="desc" notes-body></textarea>
                                        <input type="text" class="form-control" style="border:none;" id="category"
                                            placeholder="Enter category..." name="category">

                                        <input type="hidden" id="myInput" name="myInput">
                                        <input type="hidden" id="myColorName" name="myColorName">
                                        <button id="myButton" value="" name="color">Click to Show Color Pallete</button>
                                        <div id="add-hello">
                                            <div id="add-div1" class="add-color-box">Peach</div>
                                            <div id="add-div2" class="add-color-box">Orange</div>
                                            <div id="add-div3" class="add-color-box">YB</div>
                                            <div id="add-div4" class="add-color-box">Gn</div>
                                            <div id="add-div5" class="add-color-box">Purple </div>
                                            <div id="add-div6" class="add-color-box">L-Blue</div>
                                            <div id="add-div7" class="add-color-box">Red</div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="submit">Add Note</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justified-content-center">
                <h1>My Notes</h1>
                <form action="multipledelete.php" method="POST">
                    <button class="deleteall" name="stud_delete_multiple_btn" type="submit"> <i
                            class="fas fa-trash-alt"></i> Trash</button>
                    <div class="col-lg-10" id="notes-body">
                        <?php
                       
                       $colorFilter = "";
                       if (isset($_GET['color'])) {
                           $selectedColor = $_GET['color'];
                           $colorFilter = "AND bgcolor = '$selectedColor'";
                       }
                       
                       $sql ="SELECT * FROM `notes` WHERE user_id = '$id' $colorFilter ORDER BY `pinned` DESC, `position` ASC";
                       $res = mysqli_query($con, $sql);
                       $noNotes = true;

                       while ($fetch = mysqli_fetch_assoc($res)) {
                        $noNotes = false;
                    
                        $cardClass = 'card m-3';
                        if ($fetch['pinned'] == 1) {
                            $cardClass .= ' pinned-note';
                        }
                    
                        echo '<div class="' . $cardClass . '" id="p_' . $fetch["sno"] . '" data-position="' . $fetch["position"] . '"
                            style="background-color:' . $fetch["bgcolor"] . ';">
                            <div class="card-body my-3">  
                          <div class = "select">
                          <input type="checkbox" class="input" name="stud_delete_id[]" value="' . $fetch["sno"] . '">
                          <button class="pin-button" data-note-id="' . $fetch["sno"] . '" data-pinned="' . $fetch["pinned"] . '">
                          ' . ($fetch["pinned"] ? "Unpin" : "Pin") . '
                          </button>
                          </div>
                             <h5 class="card-title">' . $fetch["title"] . ' </h5>
                             <p class="card-text my-3" >' . $fetch["description"] . '</p>
                             <p class="card-category" style=" color: #dc3545;font-weight: 600;background-color: #fbfdff;display:inline; padding:5px; border-radius:20px;
                             text-align: center;">  ' . $fetch["category"] . '  </p><br>
                             <div class = "AddDeletebuttons">
                              <button class="deletebutton" type="button" value="' . $fetch["sno"] . '" data-category="' . $fetch["category"] . '">
                              <i class="fas fa-trash-alt"></i></button>
                              </div>
                              <button class="edit"  type="button" data-bs-toggle="modal"
                              data-bs-target="#exampleModal" id="' . $fetch["sno"] . '"><i class="fas fa-edit" ></i></button>
                              
                         </div>
                     </div>';
                     }

                     if ($noNotes) {
                          echo 
                          '<div class="card my-3 p-2">
                             <div class="card-body">
                                 <h5 class="card-title p-2">Notes </h5>
                                 <p class="card-text p-2">No Notes are available for reading</p>
                             </div>
                         </div>';}
                    ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="jquery/jquery.js" type="text/javascript"></script>
    <script src="jqueryui/jquery-ui.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    // Add this inside the document ready function
    $(document).ready(function(e) {
        $(".edit, .deletebutton").hide();

        // Show the edit and delete buttons when hovering over a card
        $(".card").hover(function() {
                $(this).find(".edit, .deletebutton").show();
            },
            function() {
                $(this).find(".edit, .deletebutton").hide();
            });
    });

    //delete function

    $('.deletebutton').click(function(e) {
        e.preventDefault();
        var noteId = $(this).val();
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to retrieve this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "deletejquery.php", // Change this to the actual PHP file handling deletion
                    data: {
                        'noteId': noteId,
                    },
                    success: function(response) {
                        // Handle the response if needed
                    }
                })
                Swal.fire({
                    title: "Deleted!",
                    text: "Your note has been deleted.",
                    icon: "success"
                })
                $('#p_' + noteId).hide(1000);
            }
        });
    })

    //edit function
    const edit = document.querySelectorAll(".edit");
    const editTitle = document.getElementById("edittitle");
    const editdesc = document.getElementById("editdesc");
    const editCategory = document.getElementById("editcategory");
    const hiddeninput = document.getElementById("hidden");
    const cardBody = document.querySelectorAll(".card-body");
    edit.forEach(element => {
        element.addEventListener("click", () => {
            console.log(element.parentElement.children);
            const titleText = element.parentElement.children[1].innerText;
            const descText = element.parentElement.children[2].innerText;
            const categoryText = element.parentElement.children[3].innerText;
            editTitle.value = titleText;
            editdesc.value = descText;
            editCategory.value = categoryText;
            hiddeninput.value = element.id;
        });
    });

    //searching function
    const search = document.getElementById("search");
    search.addEventListener("input", () => {
        const value = search.value;
        cardBody.forEach(element => {
            const titleText = element.children[1].innerText;
            const descText = element.children[2].innerText;
            const categoryText = element.children[3].innerText;
            if (titleText.includes(value) || descText.includes(value) || categoryText.includes(value)) {
                element.parentElement.style.display = "block";
            } else {
                element.parentElement.style.display = "none";
            }
        });

    });

    //category function
    $("#category").change(function() {
        var selectedCategory = $(this).val();
        var notes = $(".card");
        notes.sort(function(a, b) {
            var categoryA = $(a).find(".card-category").text();
            var categoryB = $(b).find(".card-category").text();
            return categoryA.localeCompare(categoryB);
        });
        $("#notes-body").html(notes);
    });




    //showing color palate
    $(document).ready(function(e) {
        $("#myButton").click(function() {
            event.preventDefault();
            $("#add-div1").fadeIn();
            $("#add-div2").fadeIn();
            $("#add-div3").fadeIn();
            $("#add-div4").fadeIn();
            $("#add-div5").fadeIn();
            $("#add-div6").fadeIn();
            $("#add-div7").fadeIn();
            $("#add-hello").toggle();
        });

        //showing color palate in edit modal
        $("#editbgcolor").click(function() {
            event.preventDefault();
            $("#div1").fadeIn();
            $("#div2").fadeIn();
            $("#div3").fadeIn();
            $("#div4").fadeIn();
            $("#div5").fadeIn();
            $("#div6").fadeIn();
            $("#div7").fadeIn();
            $("#hello").toggle();
        });

        //adding color in cards
        $(".add-color-box").click(function() {
            event.preventDefault();
            var selectedColor = $(this).css("background-color");
            var colorname = $(this).text()
            $('#myButton').text(colorname);
            //         $("body").css("background-color", selectedColor);
            $('#myInput').val(selectedColor);
            $('#myColorName').val(colorname);

        });

        $(".color-box").click(function() {
            event.preventDefault();
            var selectedColor = $(this).css("background-color");
            var colorname = $(this).text()

            $('#editbgcolor').text(colorname);
            //         $("body").css("background-color", selectedColor);
            $('#editmyInput').val(selectedColor);
            $('#myeditColorName').val(colorname);

        });

        //saving the sorting position
        $("#notes-body").sortable({
            //event callback (update)
            update: function(event, ui) {
                // Get the sorted notes
                const sortedNotes = $(this).sortable("toArray", {
                    attribute: "id"
                });

                // Update positions and send to the server
                $.ajax({
                    type: "POST",
                    url: "update_positions.php", // Replace with your server-side script
                    data: {
                        sortedNotes: sortedNotes
                    },
                    success: function(response) {
                        // Handle success
                    }
                });
            }
        });


    });

    //category function
    /* document.addEventListener("DOMContentLoaded", function() {
        const categorySelect = document.getElementById("category");
        const notesBody = document.getElementById("notes-body");

        categorySelect.addEventListener("change", function() {
            const selectedCategory = categorySelect.value;
            console.log(selectedCategory);
            // Loop through all notes and hide/show based on the selected category
            const notes = notesBody.querySelectorAll(".card");
            notes.forEach(note => {
                const noteCategory = note.querySelector(".card-category").innerText.trim();
                if (selectedCategory === "" || noteCategory === selectedCategory) {
                    note.style.display = "block";
                } else {
                    note.style.display = "none";
                }
            });
        });
    });  */

    // Category function
    document.addEventListener("DOMContentLoaded", function() {
        const categorySelect = document.getElementById("category");
        const colorDropdown = document.getElementById("colorDropdown");
        const notesBody = document.getElementById("notes-body");

        categorySelect.addEventListener("change", function() {
            const selectedCategory = categorySelect.value;
            const selectedColor = colorDropdown.value;

            // Loop through all notes and hide/show based on the selected category and color
            const notes = notesBody.querySelectorAll(".card");
            notes.forEach(note => {
                const noteCategory = note.querySelector(".card-category").innerText.trim();
                const noteColor = note.style.backgroundColor;

                const categoryMatch = selectedCategory === "" || noteCategory ===
                    selectedCategory;
                const colorMatch = selectedColor === "" || noteColor === selectedColor;

                if (categoryMatch && colorMatch) {
                    note.style.display = "block";
                } else {
                    note.style.display = "none";
                }
            });
        });
    });
    // Dropdown change event
    $("#colorDropdown").change(function() {
        var selectedColor = $(this).val();

        // Loop through all notes and hide/show based on the selected color
        const notes = $(".card");
        notes.each(function() {
            const noteColor = $(this).css("background-color");
            if (selectedColor === "" || noteColor === selectedColor) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    $("#colorButton").click(function() {
        var selectedColor = prompt("Enter color to sort by:");
        if (selectedColor) {
            // Redirect to index.php with the selectedColor as a query parameter
            window.location.href = "index.php?color=" + selectedColor;
        }
    });

    $(".pin-button").click(function(e) {
        e.preventDefault();

        var noteId = $(this).data("note-id");
        var isPinned = $(this).data("pinned");
        console.log(noteId);
        console.log(isPinned);
        // Make an AJAX request to update the pinned status
        $.ajax({
            type: "POST",
            url: "update_pin_status.php", // Replace with your server-side script
            data: {
                'noteId': noteId,
                'isPinned': isPinned
            },
            success: function(response) {
                // Handle success, if needed
                // Reload the page or update the UI as necessary
                location.reload();
            }
        });
    });
    </script>



</body>

</html>