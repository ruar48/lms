<?php
include('dbcon.php');
        
               $un = $_POST['un'];
               $fn = $_POST['fn'];
               $ln = $_POST['ln'];
               $class_id = $_POST['class_id'];

        //        mysqli_query($conn,"insert into student (username,firstname,lastname,password,location,class_id,status)
		// values ('$un','$fn','$ln','$un','uploads/NO-IMAGE-AVAILABLE.jpg','$class_id','Unregistered')                                    
		// ") or die(mysqli_error());
        
        $stmt = mysqli_prepare($conn, "INSERT INTO student (username, firstname, lastname, password, location, class_id, status) VALUES (?, ?, ?, ?, 'uploads/NO-IMAGE-AVAILABLE.jpg', ?, 'Unregistered')");
mysqli_stmt_bind_param($stmt, "ssssi", $un, $fn, $ln, $un, $class_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
        ?>
<?php    ?>