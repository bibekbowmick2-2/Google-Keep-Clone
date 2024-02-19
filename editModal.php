<?php 
if(isset($_POST["hidden"])){
  $title =$_POST["edittitle"];
  $desc =$_POST["editdesc"];
  $db_color=$_POST["editmyInput"];
  $db_color_name=$_POST["myeditColorName"];
  $category = $_POST["editcategory"];
  $id=$_POST["hidden"];
  $sql="UPDATE `notes` SET `title`='$title',`description`=' $desc',`bgcolor`='$db_color',`category`='$category' ,`bgcolorName`='$db_color_name' WHERE `sno`='$id'";
  $res=mysqli_query($con,$sql);
}

echo '<!-- Button trigger modal --><!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form method="POST" autocomplete="off">
         <input type="hidden" name="hidden" id="hidden">
         
         <div class="mb-3">
           <label for="title" class="form-label">Title</label>
           <input type="text" class="form-control" id="edittitle" placeholder="Enter Title..." name="edittitle">
         </div>
         
         <div class="mb-3">
           <label for="desc" class="form-label">Description</label>
           <textarea class="form-control" id="editdesc" rows="3" placeholder="Enter Description..." name="editdesc"></textarea>
          </div>
          
          <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control" id="editcategory" placeholder="Enter category..."  name="editcategory">
          </div>
          
          <div class="mb-3">
            <input type="hidden" id="editmyInput" name="editmyInput">
            <input type="hidden" id="myeditColorName" name="myeditColorName">
            <button id="editbgcolor" value="" name="editcolor">Click to Show Color Pallete</button>
            <div id="hello">
                                            <div id="div1" class="color-box">Peach</div>
                                            <div id="div2" class="color-box">Orange</div>
                                            <div id="div3" class="color-box">YB</div>
                                            <div id="div4" class="color-box">Gn</div>
                                            <div id="div5" class="color-box">Purple</div>
                                            <div id="div6" class="color-box">L-Blue</div>
                                            <div id="div7" class="color-box">Red</div>
            </div>

          </div>
          <button type="submit" class="btn btn-primary" name="submit">Update Note</button>
       </form>
      </div>
      
    </div>
  </div>
</div>';
?>