	 <!-- breadcrumb -->
	 <?php $class_query = mysqli_query($conn,"select * from teacher_class
	LEFT JOIN class ON class.class_id = teacher_class.class_id
	LEFT JOIN subject ON subject.subject_id = teacher_class.subject_id
	where teacher_class_id = '$get_id'")or die(mysqli_error());
	$class_row = mysqli_fetch_array($class_query);
	?>

	 <ul class="breadcrumb">
	     <li><a href="#"><b><?php echo $class_row['class_name']; ?></b></a> <span class="divider">/</span></li>
	     <li><a href="#"><b><?php echo $class_row['subject_code']; ?></b></a> <span class="divider">/</span></li>
	     <li><a href="#"><b>School Year: <?php echo $class_row['school_year']; ?></b></a> <span class="divider">/</span>
	     </li>
	     <li><a href="#"><b>My Students</b></a></li>
	 </ul>
	 <style>
b {
    color: gainsboro;
}
	 </style>
	 <!-- end breadcrumb -->