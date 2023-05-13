<?php
// Start the session
session_start();

// Check if user is logged in, otherwise redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Include database connection
require_once "config.php";

// Check if class_id parameter is present in POST request
if (isset($_POST["class_id"]) && !empty(trim($_POST["class_id"]))) {
    // Prepare a delete statement
    $sql = "DELETE FROM registrations WHERE class_id = ? AND student_id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "si", $param_class_id, $param_student_id);

        // Set parameters
        $param_class_id = trim($_POST["class_id"]);
        $param_student_id = $_SESSION['user_id'];

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Record deleted successfully. Redirect to course registration page
            header("Location: portal.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($conn);
} else {
    // Check if class_id parameter is not present in POST request
    // Display an error message
    echo "Invalid request";
}
?> 