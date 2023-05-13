<?php
// Include the config file
require_once 'config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the student ID and class ID from the form
  $student_id = $_POST['student_id'];
  $class_id = $_POST['class_id'];

  // Prepare and execute the SQL query to register the student for the class
  $sql = "INSERT INTO registrations (student_id, class_id) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ii', $student_id, $class_id);
  $stmt->execute();

  // Check if the registration was successful
  if ($stmt->affected_rows > 0) {
    // Redirect to the list classes page with a success message
    header("Location: list_classes.php?msg=success");
  } else {
    // Redirect to the list classes page with an error message
    header("Location: list_classes.php?msg=error");
  }
}
?>