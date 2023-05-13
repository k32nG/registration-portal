<?php
// Include database connection
require_once "config.php";

// Define variables and initialize with empty values
$student_id = $class_id = "";
$student_id_err = $class_id_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate student id
    if (empty(trim($_POST["student_id"]))) {
        $student_id_err = "Please select a student.";
    } else {
        $student_id = trim($_POST["student_id"]);
    }

    // Validate class id
    if (empty(trim($_POST["class_id"]))) {
        $class_id_err = "Please select a class.";
    } else {
        $class_id = trim($_POST["class_id"]);
    }

    // Check input errors before inserting in database
    if (empty($student_id_err) && empty($class_id_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO registrations (student_id, class_id) VALUES (?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ii", $param_student_id, $param_class_id);

            // Set parameters
            $param_student_id = $student_id;
            $param_class_id = $class_id;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Registration added successfully. Redirect to portal page
                header("location: portal.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
}
?>