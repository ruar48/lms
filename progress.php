<?php include('header_dashboard.php'); ?>
<?php include('session.php'); ?>
<?php $get_id = $_GET['id']; ?>

<body>
    <?php include('navbar_student.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php include('progress_link_student.php'); ?>
            <div class="span4" id="content">
                <div class="row-fluid">
                    <!-- breadcrumb -->

                    <?php $class_query = mysqli_query($conn,"select * from teacher_class
										LEFT JOIN class ON class.class_id = teacher_class.class_id
										LEFT JOIN subject ON subject.subject_id = teacher_class.subject_id
										where teacher_class_id = '$get_id'")or die(mysqli_error());
										$class_row = mysqli_fetch_array($class_query);
										$class_id = $class_row['class_id'];
										$school_year = $class_row['school_year'];
										?>

                    <ul class="breadcrumb">
                        <li><a href="#"><b><?php echo $class_row['class_name']; ?></b></a> <span
                                class="divider">/</span></li>
                        <li><a href="#"><b><?php echo $class_row['subject_code']; ?></b></a> <span
                                class="divider">/</span>
                        </li>
                        <li><a href="#"><b>School Year: <?php echo $class_row['school_year']; ?></b></a> <span
                                class="divider">/</span></li>
                        <li><a href="#"><b>Progress</b></a></li>
                    </ul>
                    <!-- end breadcrumb -->

                    <!-- block -->
                    <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                            <div id="" class="muted pull-left">
                                <h4> Assignment Grade Progress</h4>
                            </div>
                        </div>
                        <div class="block-content collapse in">
                            <div class="span12">
                                <table cellpadding="0" cellspacing="0" border="0" class="table" id="">

                                    <thead>
                                        <tr>
                                            <th>Date Upload</th>
                                            <th>Assignment</th>

                                            <th>Grade</th>
                                        </tr>

                                    </thead>
                                    <tbody>

                                        <?php
										$query = mysqli_query($conn,"select * FROM student_assignment 
										LEFT JOIN student on student.student_id  = student_assignment.student_id
										RIGHT JOIN assignment on student_assignment.assignment_id  = assignment.assignment_id
										WHERE student_assignment.student_id = '$session_id'
										order by fdatein DESC")or die(mysqli_error());
										while($row = mysqli_fetch_array($query)){
										$id  = $row['student_assignment_id'];
										$student_id = $row['student_id'];
									?>
                                        <tr>
                                            <td><?php echo $row['fdatein']; ?></td>
                                            <td><?php  echo $row['fname']; ?></td>

                                            <?php if ($session_id == $student_id){ ?>
                                            <td>
                                                <span class="badge badge-success"><?php echo $row['grade']; ?></span>
                                            </td>
                                            <?php }else{ ?>
                                            <td></td>
                                            <?php } ?>
                                        </tr>

                                        <?php } ?>


                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- /block -->
                </div>


            </div>



            <div class="span5" id="content">
                <div class="row-fluid">
                    <!-- breadcrumb -->



                    <ul class="breadcrumb">

                        <li><a href="#"><b>..</b></a></li>
                    </ul>
                    <!-- end breadcrumb -->

                    <!-- block -->
                    <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                            <div id="" class="muted pull-left">
                                <h4> Practice Quiz Progress</h4>
                            </div>
                        </div>
                        <div class="block-content collapse in">
                            <div class="span12">

                                <table cellpadding="0" cellspacing="0" border="0" class="table" id="">
                                    <thead>
                                        <tr>
                                            <th>Quiz Title</th>
                                            <th>Description</th>
                                            <th>Quiz Time (In Minutes)</th>
                                            <th>Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
    $query = mysqli_query($conn, "SELECT * FROM class_quiz 
        LEFT JOIN quiz ON class_quiz.quiz_id = quiz.quiz_id
        WHERE teacher_class_id = '$get_id' ORDER BY class_quiz_id DESC") or die(mysqli_error());

    while ($row = mysqli_fetch_array($query)) {
        $id = $row['class_quiz_id'];
        $quiz_id = $row['quiz_id'];
        $quiz_time = $row['quiz_time'];

        $query1 = mysqli_query($conn, "SELECT * FROM student_class_quiz WHERE class_quiz_id = '$id' AND student_id = '$session_id'") or die(mysqli_error());
        $row1 = mysqli_fetch_array($query1);

        // Check if $row1 is not null
        if ($row1 !== null) {
            // Use isset() to check for array key existence
            $grade = isset($row1['grade']) ? $row1['grade'] : "N/A";
        } else {
            $grade = "N/A";  // or any default value
        }
    ?>
                                        <?php if ($grade == "") {
             
        } else { ?>
                                        <tr>
                                            <td><?php echo $row['quiz_title']; ?></td>
                                            <td><?php echo $row['quiz_description']; ?></td>
                                            <td><?php echo $row['quiz_time'] / 60; ?></td>
                                            <td width="200">
                                                <b>Already Taken Score <?php echo $grade; ?></b>
                                            </td>
                                            <?php if ($id !== null) { ?>
                                            <script type="text/javascript">
                                            $(document).ready(function() {
                                                <?php if ($id !== null) { ?>
                                                $('#<?php echo $id; ?>TakeThisQuiz').tooltip('show');
                                                $('#<?php echo $id; ?>TakeThisQuiz').tooltip('hide');
                                                <?php } ?>
                                            });
                                            </script>
                                            <?php } ?>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>



                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- /block -->
                </div>


            </div>

            <?php /* include('downloadable_sidebar.php') */ ?>
        </div>
        <?php include('footer.php'); ?>
    </div>
    <?php include('script.php'); ?>
</body>

</html>