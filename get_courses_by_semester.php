<?php
include_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['semesterId'])) {
    $semesterId = $_POST['semesterId'];

    // Retrieve courses for the selected semester from the database
    $sql = "SELECT * FROM courses WHERE semester_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $semesterId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Display the courses in the response
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#course-modal-' . $row['id'] . '">' . $row['course_code'] . " - " . $row['course_name'] .  '</a>';
            echo '<div class="modal fade" id="course-modal-' . $row['id'] . '" tabindex="-1" role="dialog" aria-labelledby="course-modal-label-' . $row['id'] . '" aria-hidden="true">';
            echo '<div class="modal-dialog" role="document">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="course-modal-label-' . $row['id'] . '">' . $row['course_name'] . '</h5>';
            echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            echo '<span aria-hidden="true">&times;</span>';
            echo '</button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<p><strong>Course Code:</strong> ' . $row['course_code'] . '</p>';
            echo '<p><strong>Instructor:</strong> ' . $row['course_instructor'] . '</p>';
            echo '<p><strong>Start Date:</strong> ' . $row['course_start_date'] . '</p>';
            echo '<p><strong>End Date:</strong> ' . $row['course_end_date'] . '</p>';
            echo '<p><strong>Capacity:</strong> ' . $row['course_capacity'] . '</p>';
            echo '<p><strong>Description:</strong> ' . $row['course_description'] . '</p>';
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>No courses available for the selected semester.</p>';
    }
} else {
    echo '<p>Invalid request.</p>';
}

mysqli_close($conn);