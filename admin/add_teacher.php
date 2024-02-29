   <div class="row-fluid">
       <!-- block -->
       <div class="block">
           <div class="navbar navbar-inner block-header">
               <div class="muted pull-left">Add Teacher</div>
           </div>
           <div class="block-content collapse in">
               <div class="span12">
                   <form method="post">
                       <!--
										<label>Photo:</label>
										<div class="control-group">
                                          <div class="controls">
                                               <input class="input-file uniform_on" id="fileInput" type="file" required>
                                          </div>
                                        </div>
									-->

                       <div class="control-group">
                           <div class="control-group">
                               <div class="controls">
                                   <input name="un" class="input focused" id="focusedInput" type="text"
                                       placeholder="ID Number" required>
                               </div>
                           </div>
                           <label>Department:</label>
                           <div class="controls">
                               <select name="department" class="" required>
                                   <option></option>
                                   <?php
											$query = mysqli_query($conn,"select * from department order by department_name");
											while($row = mysqli_fetch_array($query)){
											
											?>
                                   <option value="<?php echo $row['department_id']; ?>">
                                       <?php echo $row['department_name']; ?></option>
                                   <?php } ?>
                               </select>
                           </div>
                       </div>

                       <div class="control-group">
                           <div class="controls">
                               <input class="input focused" name="firstname" id="focusedInput" type="text"
                                   placeholder="Firstname">
                           </div>
                       </div>

                       <div class="control-group">
                           <div class="controls">
                               <input class="input focused" name="lastname" id="focusedInput" type="text"
                                   placeholder="Lastname">
                           </div>
                       </div>



                       <div class="control-group">
                           <div class="controls">
                               <button name="save" class="btn btn-info"><i
                                       class="icon-plus-sign icon-large"></i></button>

                           </div>
                       </div>
                   </form>
               </div>
           </div>
       </div>
       <!-- /block -->
   </div>


   <?php
include('dbcon.php');

if (isset($_POST['save'])) {
    $uname = mysqli_real_escape_string($conn, $_POST['un']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $department_id = mysqli_real_escape_string($conn, $_POST['department']);

    $query = mysqli_query($conn, "SELECT * FROM teacher WHERE firstname = '$firstname' AND lastname = '$lastname'") or die(mysqli_error());
    $count = mysqli_num_rows($query);

    if ($count > 0) {
        echo '<script>alert("Data Already Exist");</script>';
    } else {
        // Assuming you have a function to generate a secure password
       
        mysqli_query($conn, "INSERT INTO teacher (username, password, firstname, lastname, location, department_id)
                            VALUES ('$uname', '$uname', '$firstname', '$lastname', 'uploads/NO-IMAGE-AVAILABLE.jpg', '$department_id')")
        or die(mysqli_error());

        echo '<script>window.location = "teachers.php";</script>';
    }
}


?>