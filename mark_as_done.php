<?php
include 'dbcon.php';
include 'session.php';
if (isset($_POST['btn_markdone'])) {
    $assignmentId = $_POST['id'];
    $get_id = $_POST['get_id'];
    $student_id = $_POST['student_id']; // Assuming student_id is part of the form data
    $m = "marked as done";

    $stmt = $conn->prepare("INSERT INTO student_assignment (fdesc, floc, assignment_fdatein, fname, assignment_id, student_id) VALUES (?, ?, NOW(), ?, ?, ?)");
    $stmt->bind_param("sssss", $m, $m, $m, $assignmentId, $student_id);
    $stmt->execute();

    if ($stmt->error) {
        echo "SQL Error: " . $stmt->error;
    } else {
        // Insert a notification
        $name_notification = 'Marked Assignment as Done';
        $insert_query = "INSERT INTO teacher_notification (teacher_class_id, notification, date_of_notification, link, student_id, assignment_id) VALUES (?, ?, NOW(), 'view_submit_assignment.php', ?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("ssss", $get_id, $name_notification, $student_id, $assignmentId);
        $insert_stmt->execute();

        if ($insert_stmt->error) {
            echo "Notification Insert Error: " . $insert_stmt->error;
        } else {
            header("Location: assignment_student.php?id=" . $_POST['get_id']);
            exit();
        }
        $insert_stmt->close();
    }
}
?>