<?php
    include_once('config.php');

    // Get the course description from the database
    if(isset($_GET['id'])) {
        $course_id = $_GET['id'];

        $sql = "SELECT course_description FROM courses WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $course_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $description = $row['course_description'];
            echo $description;
        } else {
            echo "No description available.";
        }
    }

    mysqli_close($conn);
?>